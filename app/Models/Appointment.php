<?php

namespace App\Models;

use App\Notifications\AppointmentBooked;
use App\Notifications\AppointmentStatusChanged;
use App\Notifications\NewAppointmentAdmin;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Notification;

class Appointment extends Model
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'preferred_contact',
        'appointment_date',
        'appointment_time',
        'notes',
        'status',
        'admin_notes',
        'confirmed_at',
        'cancelled_at',
        'cancellation_reason',
        'reminder_sent_at',
    ];

    protected $casts = [
        'appointment_date' => 'date',
        'confirmed_at' => 'datetime',
        'cancelled_at' => 'datetime',
        'reminder_sent_at' => 'datetime',
    ];

    protected static array $oldStatusCache = [];

    protected static function booted(): void
    {
        static::created(function (Appointment $appointment) {
            $appointment->sendBookingNotifications();
        });

        static::updating(function (Appointment $appointment) {
            if ($appointment->isDirty('status')) {
                static::$oldStatusCache[$appointment->id] = $appointment->getOriginal('status');
            }
        });

        static::updated(function (Appointment $appointment) {
            if (isset(static::$oldStatusCache[$appointment->id])) {
                $oldStatus = static::$oldStatusCache[$appointment->id];
                unset(static::$oldStatusCache[$appointment->id]);

                if ($oldStatus !== $appointment->status) {
                    $appointment->sendStatusChangeNotification($oldStatus);
                }
            }
        });
    }

    public function sendBookingNotifications(): void
    {
        $this->notify(new AppointmentBooked($this));

        $adminEmail = SiteSetting::get('email');
        if ($adminEmail) {
            Notification::route('mail', $adminEmail)
                ->notify(new NewAppointmentAdmin($this));
        }
    }

    public function sendStatusChangeNotification(string $oldStatus): void
    {
        $this->notify(new AppointmentStatusChanged($this, $oldStatus));
    }

    public function routeNotificationForMail(): string
    {
        return $this->email;
    }

    public const STATUS_PENDING = 'pending';

    public const STATUS_CONFIRMED = 'confirmed';

    public const STATUS_COMPLETED = 'completed';

    public const STATUS_CANCELLED = 'cancelled';

    public const STATUS_NO_SHOW = 'no_show';

    public static function getStatuses(): array
    {
        return [
            self::STATUS_PENDING => 'Pending',
            self::STATUS_CONFIRMED => 'Confirmed',
            self::STATUS_COMPLETED => 'Completed',
            self::STATUS_CANCELLED => 'Cancelled',
            self::STATUS_NO_SHOW => 'No Show',
        ];
    }

    public static function getContactMethods(): array
    {
        return [
            'phone' => 'Phone',
            'email' => 'Email',
            'either' => 'Either',
        ];
    }

    public function getFormattedDateAttribute(): string
    {
        return $this->appointment_date->format('l, F j, Y');
    }

    public function getFormattedTimeAttribute(): string
    {
        return Carbon::parse($this->appointment_time)->format('g:i A');
    }

    public function getFormattedDateTimeAttribute(): string
    {
        return $this->formatted_date.' at '.$this->formatted_time;
    }

    public function getStatusBadgeColorAttribute(): string
    {
        return match ($this->status) {
            self::STATUS_PENDING => 'amber',
            self::STATUS_CONFIRMED => 'blue',
            self::STATUS_COMPLETED => 'emerald',
            self::STATUS_CANCELLED => 'red',
            self::STATUS_NO_SHOW => 'slate',
            default => 'slate',
        };
    }

    public function scopeUpcoming(Builder $query): Builder
    {
        return $query->where(function ($q) {
            $q->where('appointment_date', '>', Carbon::today())
                ->orWhere(function ($q2) {
                    $q2->where('appointment_date', Carbon::today())
                        ->where('appointment_time', '>=', Carbon::now()->format('H:i:s'));
                });
        })->orderBy('appointment_date')->orderBy('appointment_time');
    }

    public function scopePast(Builder $query): Builder
    {
        return $query->where(function ($q) {
            $q->where('appointment_date', '<', Carbon::today())
                ->orWhere(function ($q2) {
                    $q2->where('appointment_date', Carbon::today())
                        ->where('appointment_time', '<', Carbon::now()->format('H:i:s'));
                });
        })->orderByDesc('appointment_date')->orderByDesc('appointment_time');
    }

    public function scopeToday(Builder $query): Builder
    {
        return $query->where('appointment_date', Carbon::today())
            ->orderBy('appointment_time');
    }

    public function scopeThisWeek(Builder $query): Builder
    {
        return $query->whereBetween('appointment_date', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek(),
        ])->orderBy('appointment_date')->orderBy('appointment_time');
    }

    public function scopeByStatus(Builder $query, string $status): Builder
    {
        return $query->where('status', $status);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->whereNotIn('status', [self::STATUS_CANCELLED]);
    }

    public function confirm(): void
    {
        $this->update([
            'status' => self::STATUS_CONFIRMED,
            'confirmed_at' => now(),
        ]);
    }

    public function cancel(?string $reason = null): void
    {
        $this->update([
            'status' => self::STATUS_CANCELLED,
            'cancelled_at' => now(),
            'cancellation_reason' => $reason,
        ]);
    }

    public function complete(): void
    {
        $this->update([
            'status' => self::STATUS_COMPLETED,
        ]);
    }

    public function markNoShow(): void
    {
        $this->update([
            'status' => self::STATUS_NO_SHOW,
        ]);
    }

    public function isPast(): bool
    {
        $appointmentDateTime = Carbon::parse($this->appointment_date->format('Y-m-d').' '.$this->appointment_time);

        return $appointmentDateTime->lt(Carbon::now());
    }

    public function isToday(): bool
    {
        return $this->appointment_date->isToday();
    }
}
