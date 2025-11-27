<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class BookingSetting extends Model
{
    protected $fillable = [
        'working_days',
        'start_time',
        'end_time',
        'slot_duration',
        'buffer_time',
        'max_appointments_per_slot',
        'max_appointments_per_day',
        'advance_booking_days',
        'minimum_notice_hours',
        'is_active',
    ];

    protected $casts = [
        'working_days' => 'array',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
        'is_active' => 'boolean',
    ];

    protected $attributes = [
        'slot_duration' => 30,
        'buffer_time' => 0,
        'max_appointments_per_slot' => 1,
        'advance_booking_days' => 30,
        'minimum_notice_hours' => 24,
        'is_active' => true,
    ];

    public static function getSettings(): self
    {
        $settings = self::first();

        if (! $settings) {
            $settings = self::create([
                'working_days' => ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'],
                'start_time' => '09:00',
                'end_time' => '17:00',
            ]);
        }

        return $settings;
    }

    public function getWorkingDaysAttribute($value): array
    {
        if (is_string($value)) {
            return json_decode($value, true) ?? ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'];
        }

        return $value ?? ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'];
    }

    public function isWorkingDay(Carbon $date): bool
    {
        $dayName = strtolower($date->format('l'));

        return in_array($dayName, $this->working_days);
    }

    public function getTimeSlots(): array
    {
        $slots = [];
        $start = Carbon::parse($this->start_time);
        $end = Carbon::parse($this->end_time);
        $duration = $this->slot_duration + $this->buffer_time;

        while ($start->copy()->addMinutes($this->slot_duration)->lte($end)) {
            $slots[] = $start->format('H:i');
            $start->addMinutes($duration);
        }

        return $slots;
    }

    public function getAvailableDates(?int $days = null): array
    {
        $days = $days ?? $this->advance_booking_days;
        $dates = [];
        $date = Carbon::today();
        $endDate = Carbon::today()->addDays($days);

        // Apply minimum notice
        $minimumDate = Carbon::now()->addHours($this->minimum_notice_hours);
        if ($date->lt($minimumDate->startOfDay())) {
            $date = $minimumDate->copy()->startOfDay();
        }

        while ($date->lte($endDate)) {
            if ($this->isWorkingDay($date) && ! BlockedDate::isBlocked($date)) {
                $dates[] = $date->format('Y-m-d');
            }
            $date->addDay();
        }

        return $dates;
    }

    public function getAvailableSlots(string $date): array
    {
        $allSlots = $this->getTimeSlots();
        $dateCarbon = Carbon::parse($date);
        $now = Carbon::now();

        // Get booked slots for this date
        $bookedSlots = Appointment::where('appointment_date', $date)
            ->whereNotIn('status', ['cancelled'])
            ->selectRaw('appointment_time, COUNT(*) as count')
            ->groupBy('appointment_time')
            ->pluck('count', 'appointment_time')
            ->toArray();

        $availableSlots = [];

        foreach ($allSlots as $slot) {
            $slotTime = Carbon::parse("$date $slot");

            // Skip if slot is in the past (including minimum notice)
            if ($slotTime->lt($now->copy()->addHours($this->minimum_notice_hours))) {
                continue;
            }

            // Check if slot is available
            $bookedCount = $bookedSlots[$slot] ?? 0;
            if ($bookedCount < $this->max_appointments_per_slot) {
                $availableSlots[] = $slot;
            }
        }

        // Check max appointments per day
        if ($this->max_appointments_per_day) {
            $totalBooked = Appointment::where('appointment_date', $date)
                ->whereNotIn('status', ['cancelled'])
                ->count();

            if ($totalBooked >= $this->max_appointments_per_day) {
                return [];
            }
        }

        return $availableSlots;
    }
}
