<?php

use App\Models\Appointment;
use App\Models\BlockedDate;
use App\Models\BookingSetting;
use App\Models\SiteSetting;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new
#[Layout('components.layouts.public')]
#[Title('Book an Appointment')]
class extends Component {
    // Step management
    public int $step = 1;

    // Date and time selection
    public ?string $selectedDate = null;
    public ?string $selectedTime = null;
    public int $currentMonth;
    public int $currentYear;

    // Form fields
    public string $name = '';
    public string $email = '';
    public string $phone = '';
    public string $preferred_contact = 'either';
    public string $notes = '';

    // State
    public bool $submitted = false;
    public ?Appointment $appointment = null;

    public function mount(): void
    {
        $this->currentMonth = (int) now()->format('n');
        $this->currentYear = (int) now()->format('Y');
    }

    public function rules(): array
    {
        return [
            'selectedDate' => ['required', 'date', 'after_or_equal:today'],
            'selectedTime' => ['required', 'string'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'preferred_contact' => ['required', 'in:phone,email,either'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ];
    }

    public function getSettingsProperty(): BookingSetting
    {
        return BookingSetting::getSettings();
    }

    public function getAvailableDatesProperty(): array
    {
        return $this->settings->getAvailableDates();
    }

    public function getAvailableSlotsProperty(): array
    {
        if (!$this->selectedDate) {
            return [];
        }

        return $this->settings->getAvailableSlots($this->selectedDate);
    }

    public function getCalendarDaysProperty(): array
    {
        $firstDay = Carbon::createFromDate($this->currentYear, $this->currentMonth, 1);
        $lastDay = $firstDay->copy()->endOfMonth();
        $startOfCalendar = $firstDay->copy()->startOfWeek(Carbon::SUNDAY);
        $endOfCalendar = $lastDay->copy()->endOfWeek(Carbon::SATURDAY);

        $days = [];
        $current = $startOfCalendar->copy();

        while ($current <= $endOfCalendar) {
            $dateStr = $current->format('Y-m-d');
            $isCurrentMonth = $current->month === $this->currentMonth;
            $isAvailable = in_array($dateStr, $this->availableDates);
            $isSelected = $this->selectedDate === $dateStr;
            $isPast = $current->lt(Carbon::today());
            $isToday = $current->isToday();

            $days[] = [
                'date' => $dateStr,
                'day' => $current->day,
                'isCurrentMonth' => $isCurrentMonth,
                'isAvailable' => $isAvailable && $isCurrentMonth && !$isPast,
                'isSelected' => $isSelected,
                'isPast' => $isPast,
                'isToday' => $isToday,
            ];

            $current->addDay();
        }

        return $days;
    }

    public function getMonthNameProperty(): string
    {
        return Carbon::createFromDate($this->currentYear, $this->currentMonth, 1)->format('F Y');
    }

    public function previousMonth(): void
    {
        $date = Carbon::createFromDate($this->currentYear, $this->currentMonth, 1)->subMonth();
        $this->currentMonth = (int) $date->format('n');
        $this->currentYear = (int) $date->format('Y');
    }

    public function nextMonth(): void
    {
        $date = Carbon::createFromDate($this->currentYear, $this->currentMonth, 1)->addMonth();
        $this->currentMonth = (int) $date->format('n');
        $this->currentYear = (int) $date->format('Y');
    }

    public function selectDate(string $date): void
    {
        if (in_array($date, $this->availableDates)) {
            $this->selectedDate = $date;
            $this->selectedTime = null;
        }
    }

    public function selectTime(string $time): void
    {
        if (in_array($time, $this->availableSlots)) {
            $this->selectedTime = $time;
        }
    }

    public function goToStep(int $step): void
    {
        if ($step === 2 && (!$this->selectedDate || !$this->selectedTime)) {
            return;
        }

        $this->step = $step;
    }

    public function proceedToForm(): void
    {
        if ($this->selectedDate && $this->selectedTime) {
            $this->step = 2;
        }
    }

    public function submit(): void
    {
        $this->validate();

        // Double-check slot availability
        $availableSlots = $this->settings->getAvailableSlots($this->selectedDate);
        if (!in_array($this->selectedTime, $availableSlots)) {
            $this->addError('selectedTime', 'This time slot is no longer available. Please select another.');
            $this->step = 1;
            return;
        }

        $this->appointment = Appointment::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'preferred_contact' => $this->preferred_contact,
            'appointment_date' => $this->selectedDate,
            'appointment_time' => $this->selectedTime,
            'notes' => $this->notes,
            'status' => Appointment::STATUS_PENDING,
        ]);

        $this->submitted = true;
    }

    public function getFormattedSelectedDateProperty(): string
    {
        if (!$this->selectedDate) {
            return '';
        }

        return Carbon::parse($this->selectedDate)->format('l, F j, Y');
    }

    public function getFormattedSelectedTimeProperty(): string
    {
        if (!$this->selectedTime) {
            return '';
        }

        return Carbon::parse($this->selectedTime)->format('g:i A');
    }
}; ?>

<div class="overflow-hidden">
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 py-24 lg:py-32">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-[0.03]">
            <svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="booking-hero-pattern" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                        <circle cx="20" cy="20" r="1" fill="white"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#booking-hero-pattern)"/>
            </svg>
        </div>

        <!-- Gradient Orbs -->
        <div class="absolute left-1/4 top-0 h-96 w-96 -translate-x-1/2 rounded-full bg-blue-500/20 blur-3xl"></div>
        <div class="absolute bottom-0 right-1/4 h-96 w-96 translate-x-1/2 rounded-full bg-cyan-500/20 blur-3xl"></div>

        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div
                x-data="{ shown: false }"
                x-init="setTimeout(() => shown = true, 100)"
                class="mx-auto max-w-3xl text-center"
            >
                <p
                    x-show="shown"
                    x-transition:enter="transition ease-out duration-700"
                    x-transition:enter-start="opacity-0 -translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="text-sm font-semibold uppercase tracking-widest text-blue-400"
                >{{ __('Schedule Your Consultation') }}</p>
                <h1
                    x-show="shown"
                    x-transition:enter="transition ease-out duration-700 delay-150"
                    x-transition:enter-start="opacity-0 -translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="mt-4 text-4xl font-bold tracking-tight text-white sm:text-5xl lg:text-6xl"
                >{{ __('Book an Appointment') }}</h1>
                <p
                    x-show="shown"
                    x-transition:enter="transition ease-out duration-700 delay-300"
                    x-transition:enter-start="opacity-0 -translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="mt-6 text-lg leading-relaxed text-slate-300"
                >{{ __('Schedule a free, confidential consultation with one of our certified housing counselors. Select a date and time that works for you.') }}</p>
            </div>
        </div>
    </section>

    <!-- Booking Content -->
    <section class="bg-white py-24 dark:bg-slate-900 lg:py-32">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @if(!$this->settings->is_active)
                <!-- Booking Disabled Message -->
                <div class="mx-auto max-w-2xl">
                    <div class="rounded-2xl border border-amber-200 bg-amber-50 p-8 text-center dark:border-amber-800 dark:bg-amber-900/30">
                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-amber-100 dark:bg-amber-900/50">
                            <svg class="h-8 w-8 text-amber-600 dark:text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                        <h2 class="mt-6 text-xl font-bold text-slate-900 dark:text-white">{{ __('Online Booking Temporarily Unavailable') }}</h2>
                        <p class="mt-4 text-slate-600 dark:text-slate-400">{{ __('Our online appointment booking is currently disabled. Please contact us directly to schedule an appointment.') }}</p>
                        @php $phonePrimary = SiteSetting::get('phone_primary'); @endphp
                        @if($phonePrimary)
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phonePrimary) }}" class="mt-6 inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 to-cyan-600 px-6 py-3 font-semibold text-white shadow-lg transition-all duration-300 hover:scale-105">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                {{ __('Call Us') }}: {{ $phonePrimary }}
                            </a>
                        @endif
                    </div>
                </div>
            @elseif($submitted && $appointment)
                <!-- Success State -->
                <div
                    x-data="{ shown: false }"
                    x-init="setTimeout(() => shown = true, 100)"
                    x-show="shown"
                    x-transition:enter="transition ease-out duration-700"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    class="mx-auto max-w-2xl"
                >
                    <div class="rounded-2xl border border-slate-200 bg-white p-8 text-center shadow-xl dark:border-slate-700 dark:bg-slate-800 lg:p-12">
                        <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-gradient-to-br from-green-400 to-emerald-500 shadow-lg shadow-green-500/30">
                            <svg class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>

                        <h2 class="mt-8 text-2xl font-bold text-slate-900 dark:text-white">{{ __('Appointment Request Submitted!') }}</h2>
                        <p class="mx-auto mt-4 max-w-md leading-relaxed text-slate-600 dark:text-slate-400">{{ __('Thank you for scheduling an appointment. We\'ll review your request and confirm within 24 hours.') }}</p>

                        <!-- Appointment Summary -->
                        <div class="mt-8 rounded-xl border border-slate-200 bg-slate-50 p-6 text-left dark:border-slate-700 dark:bg-slate-900">
                            <h3 class="font-semibold text-slate-900 dark:text-white">{{ __('Appointment Details') }}</h3>
                            <div class="mt-4 space-y-3">
                                <div class="flex items-center gap-3">
                                    <svg class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span class="text-slate-700 dark:text-slate-300">{{ $appointment->formatted_date }}</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <svg class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span class="text-slate-700 dark:text-slate-300">{{ $appointment->formatted_time }}</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <svg class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    <span class="text-slate-700 dark:text-slate-300">{{ $appointment->name }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 flex flex-col items-center gap-4 sm:flex-row sm:justify-center">
                            <a
                                href="{{ route('home') }}"
                                class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 to-cyan-600 px-6 py-3 font-semibold text-white shadow-lg transition-all duration-300 hover:scale-105"
                            >
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                                {{ __('Return Home') }}
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <!-- Step Indicator -->
                <div class="mx-auto mb-12 max-w-md">
                    <div class="flex items-center justify-center">
                        <div class="flex items-center">
                            <div class="flex h-10 w-10 items-center justify-center rounded-full {{ $step >= 1 ? 'bg-gradient-to-br from-blue-600 to-cyan-600 text-white' : 'bg-slate-200 text-slate-600 dark:bg-slate-700 dark:text-slate-400' }} font-semibold shadow-lg transition-all duration-300">
                                @if($step > 1)
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                @else
                                    1
                                @endif
                            </div>
                            <span class="ml-3 text-sm font-medium {{ $step >= 1 ? 'text-slate-900 dark:text-white' : 'text-slate-500 dark:text-slate-400' }}">{{ __('Select Date & Time') }}</span>
                        </div>

                        <div class="mx-6 h-px w-16 {{ $step >= 2 ? 'bg-blue-600' : 'bg-slate-300 dark:bg-slate-600' }} transition-colors duration-300"></div>

                        <div class="flex items-center">
                            <div class="flex h-10 w-10 items-center justify-center rounded-full {{ $step >= 2 ? 'bg-gradient-to-br from-blue-600 to-cyan-600 text-white' : 'bg-slate-200 text-slate-600 dark:bg-slate-700 dark:text-slate-400' }} font-semibold shadow-lg transition-all duration-300">
                                2
                            </div>
                            <span class="ml-3 text-sm font-medium {{ $step >= 2 ? 'text-slate-900 dark:text-white' : 'text-slate-500 dark:text-slate-400' }}">{{ __('Your Details') }}</span>
                        </div>
                    </div>
                </div>

                @if($step === 1)
                    <!-- Step 1: Date and Time Selection -->
                    <div
                        x-data="{ shown: false }"
                        x-init="setTimeout(() => shown = true, 200)"
                        x-show="shown"
                        x-transition:enter="transition ease-out duration-700"
                        x-transition:enter-start="opacity-0 translate-y-8"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="grid gap-8 lg:grid-cols-2"
                    >
                        <!-- Calendar -->
                        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-xl dark:border-slate-700 dark:bg-slate-800 lg:p-8">
                            <h2 class="text-xl font-bold text-slate-900 dark:text-white">{{ __('Select a Date') }}</h2>
                            <p class="mt-2 text-slate-600 dark:text-slate-400">{{ __('Choose an available date for your appointment.') }}</p>

                            <!-- Calendar Navigation -->
                            <div class="mt-6 flex items-center justify-between">
                                <button
                                    wire:click="previousMonth"
                                    class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-300 bg-white text-slate-600 transition-all duration-200 hover:bg-slate-50 hover:text-slate-900 dark:border-slate-600 dark:bg-slate-700 dark:text-slate-400 dark:hover:bg-slate-600 dark:hover:text-white"
                                >
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                    </svg>
                                </button>
                                <h3 class="text-lg font-semibold text-slate-900 dark:text-white">{{ $this->monthName }}</h3>
                                <button
                                    wire:click="nextMonth"
                                    class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-300 bg-white text-slate-600 transition-all duration-200 hover:bg-slate-50 hover:text-slate-900 dark:border-slate-600 dark:bg-slate-700 dark:text-slate-400 dark:hover:bg-slate-600 dark:hover:text-white"
                                >
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </button>
                            </div>

                            <!-- Calendar Grid -->
                            <div class="mt-6">
                                <!-- Weekday Headers -->
                                <div class="mb-2 grid grid-cols-7 gap-1 text-center text-xs font-medium uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                    <div class="py-2">{{ __('Sun') }}</div>
                                    <div class="py-2">{{ __('Mon') }}</div>
                                    <div class="py-2">{{ __('Tue') }}</div>
                                    <div class="py-2">{{ __('Wed') }}</div>
                                    <div class="py-2">{{ __('Thu') }}</div>
                                    <div class="py-2">{{ __('Fri') }}</div>
                                    <div class="py-2">{{ __('Sat') }}</div>
                                </div>

                                <!-- Days Grid -->
                                <div class="grid grid-cols-7 gap-1">
                                    @foreach($this->calendarDays as $day)
                                        <button
                                            wire:click="selectDate('{{ $day['date'] }}')"
                                            @class([
                                                'relative flex h-10 w-full items-center justify-center rounded-lg text-sm font-medium transition-all duration-200',
                                                'opacity-30 cursor-not-allowed' => !$day['isCurrentMonth'] || $day['isPast'],
                                                'bg-gradient-to-br from-blue-600 to-cyan-600 text-white shadow-lg shadow-blue-500/30' => $day['isSelected'],
                                                'bg-blue-100 text-blue-700 dark:bg-blue-900/50 dark:text-blue-300 hover:bg-blue-200 dark:hover:bg-blue-900' => $day['isAvailable'] && !$day['isSelected'],
                                                'text-slate-400 dark:text-slate-600 cursor-not-allowed' => !$day['isAvailable'] && $day['isCurrentMonth'] && !$day['isPast'],
                                                'ring-2 ring-blue-500 ring-offset-2 dark:ring-offset-slate-800' => $day['isToday'] && !$day['isSelected'],
                                            ])
                                            @if(!$day['isAvailable'] || !$day['isCurrentMonth'] || $day['isPast'])
                                                disabled
                                            @endif
                                        >
                                            {{ $day['day'] }}
                                        </button>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Legend -->
                            <div class="mt-6 flex flex-wrap items-center gap-4 text-xs text-slate-600 dark:text-slate-400">
                                <div class="flex items-center gap-2">
                                    <div class="h-4 w-4 rounded bg-blue-100 dark:bg-blue-900/50"></div>
                                    <span>{{ __('Available') }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="h-4 w-4 rounded bg-gradient-to-br from-blue-600 to-cyan-600"></div>
                                    <span>{{ __('Selected') }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="h-4 w-4 rounded bg-slate-200 dark:bg-slate-700"></div>
                                    <span>{{ __('Unavailable') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Time Slots -->
                        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-xl dark:border-slate-700 dark:bg-slate-800 lg:p-8">
                            <h2 class="text-xl font-bold text-slate-900 dark:text-white">{{ __('Select a Time') }}</h2>
                            <p class="mt-2 text-slate-600 dark:text-slate-400">
                                @if($selectedDate)
                                    {{ __('Available times for') }} <span class="font-medium text-blue-600 dark:text-blue-400">{{ $this->formattedSelectedDate }}</span>
                                @else
                                    {{ __('Please select a date first.') }}
                                @endif
                            </p>

                            @if($selectedDate)
                                <div class="mt-6 grid grid-cols-3 gap-3 sm:grid-cols-4">
                                    @forelse($this->availableSlots as $slot)
                                        <button
                                            wire:click="selectTime('{{ $slot }}')"
                                            @class([
                                                'flex items-center justify-center rounded-xl px-4 py-3 text-sm font-medium transition-all duration-200',
                                                'bg-gradient-to-br from-blue-600 to-cyan-600 text-white shadow-lg shadow-blue-500/30' => $selectedTime === $slot,
                                                'border border-slate-300 bg-white text-slate-700 hover:border-blue-500 hover:bg-blue-50 hover:text-blue-600 dark:border-slate-600 dark:bg-slate-700 dark:text-slate-300 dark:hover:border-blue-500 dark:hover:bg-blue-900/50 dark:hover:text-blue-400' => $selectedTime !== $slot,
                                            ])
                                        >
                                            {{ \Carbon\Carbon::parse($slot)->format('g:i A') }}
                                        </button>
                                    @empty
                                        <div class="col-span-full py-8 text-center">
                                            <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            <p class="mt-4 text-slate-600 dark:text-slate-400">{{ __('No available time slots for this date.') }}</p>
                                        </div>
                                    @endforelse
                                </div>
                            @else
                                <div class="mt-6 flex flex-col items-center justify-center py-12 text-center">
                                    <svg class="h-16 w-16 text-slate-300 dark:text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <p class="mt-4 text-slate-500 dark:text-slate-400">{{ __('Select a date from the calendar to view available times.') }}</p>
                                </div>
                            @endif

                            <!-- Selection Summary & Continue Button -->
                            @if($selectedDate && $selectedTime)
                                <div class="mt-8 rounded-xl border border-blue-200 bg-gradient-to-br from-blue-50 to-cyan-50 p-4 dark:border-blue-800 dark:from-blue-900/30 dark:to-cyan-900/30">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-600">
                                            <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-slate-900 dark:text-white">{{ $this->formattedSelectedDate }}</p>
                                            <p class="text-sm text-slate-600 dark:text-slate-400">{{ __('at') }} {{ $this->formattedSelectedTime }}</p>
                                        </div>
                                    </div>
                                </div>

                                <button
                                    wire:click="proceedToForm"
                                    class="group mt-6 flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 to-cyan-600 px-8 py-4 font-semibold text-white shadow-lg shadow-blue-500/30 transition-all duration-300 hover:scale-[1.02] hover:shadow-xl"
                                >
                                    {{ __('Continue') }}
                                    <svg class="h-5 w-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                    </svg>
                                </button>
                            @endif
                        </div>
                    </div>
                @else
                    <!-- Step 2: Contact Details Form -->
                    <div
                        x-data="{ shown: false }"
                        x-init="setTimeout(() => shown = true, 100)"
                        x-show="shown"
                        x-transition:enter="transition ease-out duration-700"
                        x-transition:enter-start="opacity-0 translate-y-8"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="mx-auto max-w-2xl"
                    >
                        <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-xl dark:border-slate-700 dark:bg-slate-800 lg:p-10">
                            <!-- Selected Date/Time Summary -->
                            <div class="mb-8 rounded-xl border border-blue-200 bg-gradient-to-br from-blue-50 to-cyan-50 p-4 dark:border-blue-800 dark:from-blue-900/30 dark:to-cyan-900/30">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-600">
                                            <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-slate-900 dark:text-white">{{ $this->formattedSelectedDate }}</p>
                                            <p class="text-sm text-slate-600 dark:text-slate-400">{{ __('at') }} {{ $this->formattedSelectedTime }}</p>
                                        </div>
                                    </div>
                                    <button
                                        wire:click="goToStep(1)"
                                        class="text-sm font-medium text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300"
                                    >{{ __('Change') }}</button>
                                </div>
                            </div>

                            <div class="mb-8">
                                <h2 class="text-2xl font-bold text-slate-900 dark:text-white">{{ __('Your Information') }}</h2>
                                <p class="mt-2 text-slate-600 dark:text-slate-400">{{ __('Please provide your contact details so we can confirm your appointment.') }}</p>
                            </div>

                            <form wire:submit="submit" class="space-y-6">
                                @if ($errors->any())
                                    <div class="rounded-xl border border-red-200 bg-red-50 p-4 dark:border-red-800 dark:bg-red-900/30">
                                        <div class="flex items-center gap-2 text-red-600 dark:text-red-400">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                            </svg>
                                            <span class="font-medium">{{ __('Please correct the errors below.') }}</span>
                                        </div>
                                    </div>
                                @endif

                                <div>
                                    <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">
                                        {{ __('Full Name') }} <span class="text-red-500">*</span>
                                    </label>
                                    <input
                                        type="text"
                                        wire:model="name"
                                        required
                                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 transition-all duration-200 placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/20 dark:border-slate-600 dark:bg-slate-700 dark:text-white dark:placeholder:text-slate-500 dark:focus:border-blue-400 dark:focus:ring-blue-400/20"
                                        placeholder="{{ __('John Doe') }}"
                                    />
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="grid gap-6 sm:grid-cols-2">
                                    <div>
                                        <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">
                                            {{ __('Email Address') }} <span class="text-red-500">*</span>
                                        </label>
                                        <input
                                            type="email"
                                            wire:model="email"
                                            required
                                            class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 transition-all duration-200 placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/20 dark:border-slate-600 dark:bg-slate-700 dark:text-white dark:placeholder:text-slate-500 dark:focus:border-blue-400 dark:focus:ring-blue-400/20"
                                            placeholder="{{ __('john@example.com') }}"
                                        />
                                        @error('email')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">
                                            {{ __('Phone Number') }} <span class="text-red-500">*</span>
                                        </label>
                                        <input
                                            type="tel"
                                            wire:model="phone"
                                            required
                                            class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 transition-all duration-200 placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/20 dark:border-slate-600 dark:bg-slate-700 dark:text-white dark:placeholder:text-slate-500 dark:focus:border-blue-400 dark:focus:ring-blue-400/20"
                                            placeholder="{{ __('(555) 123-4567') }}"
                                        />
                                        @error('phone')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div>
                                    <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">
                                        {{ __('Preferred Contact Method') }} <span class="text-red-500">*</span>
                                    </label>
                                    <div class="grid grid-cols-3 gap-3">
                                        @foreach(['phone' => 'Phone', 'email' => 'Email', 'either' => 'Either'] as $value => $label)
                                            <label
                                                @class([
                                                    'flex cursor-pointer items-center justify-center rounded-xl border px-4 py-3 text-sm font-medium transition-all duration-200',
                                                    'border-blue-500 bg-blue-50 text-blue-600 dark:border-blue-500 dark:bg-blue-900/50 dark:text-blue-400' => $preferred_contact === $value,
                                                    'border-slate-300 bg-white text-slate-700 hover:border-blue-500 hover:bg-blue-50 dark:border-slate-600 dark:bg-slate-700 dark:text-slate-300 dark:hover:border-blue-500 dark:hover:bg-blue-900/50' => $preferred_contact !== $value,
                                                ])
                                            >
                                                <input
                                                    type="radio"
                                                    wire:model="preferred_contact"
                                                    value="{{ $value }}"
                                                    class="sr-only"
                                                />
                                                {{ __($label) }}
                                            </label>
                                        @endforeach
                                    </div>
                                    @error('preferred_contact')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">
                                        {{ __('Additional Notes') }}
                                    </label>
                                    <textarea
                                        wire:model="notes"
                                        rows="4"
                                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 transition-all duration-200 placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/20 dark:border-slate-600 dark:bg-slate-700 dark:text-white dark:placeholder:text-slate-500 dark:focus:border-blue-400 dark:focus:ring-blue-400/20"
                                        placeholder="{{ __('Please briefly describe your situation or any specific concerns...') }}"
                                    ></textarea>
                                    @error('notes')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Confidentiality Notice -->
                                <div class="rounded-xl border border-blue-200 bg-gradient-to-br from-blue-50 to-cyan-50 p-4 dark:border-blue-800 dark:from-blue-900/30 dark:to-cyan-900/30">
                                    <div class="flex items-start gap-3">
                                        <div class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg bg-blue-600">
                                            <svg class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="font-semibold text-slate-900 dark:text-white">{{ __('100% Confidential') }}</h3>
                                            <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">{{ __('Your information is protected. We never share your personal details with third parties.') }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex flex-col gap-4 pt-4 sm:flex-row">
                                    <button
                                        type="button"
                                        wire:click="goToStep(1)"
                                        class="flex items-center justify-center gap-2 rounded-xl border border-slate-300 bg-white px-6 py-4 font-semibold text-slate-700 transition-all duration-200 hover:bg-slate-50 dark:border-slate-600 dark:bg-slate-700 dark:text-slate-300 dark:hover:bg-slate-600"
                                    >
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/>
                                        </svg>
                                        {{ __('Back') }}
                                    </button>

                                    <button
                                        type="submit"
                                        wire:loading.attr="disabled"
                                        class="group flex flex-1 items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 to-cyan-600 px-8 py-4 font-semibold text-white shadow-lg shadow-blue-500/30 transition-all duration-300 hover:scale-[1.02] hover:shadow-xl disabled:cursor-not-allowed disabled:opacity-70"
                                    >
                                        <span wire:loading.remove>{{ __('Book Appointment') }}</span>
                                        <span wire:loading>{{ __('Submitting...') }}</span>
                                        <svg wire:loading.remove class="h-5 w-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        <svg wire:loading class="h-5 w-5 animate-spin" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </section>

    <!-- Help Section -->
    <section class="bg-slate-50 py-24 dark:bg-slate-900/50 lg:py-32">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-bold tracking-tight text-slate-900 dark:text-white sm:text-4xl">{{ __('Need Help Right Away?') }}</h2>
                <p class="mx-auto mt-4 max-w-2xl text-lg text-slate-600 dark:text-slate-400">{{ __('If you can\'t find a suitable time or need immediate assistance, don\'t hesitate to contact us directly.') }}</p>
            </div>

            @php
                $phonePrimary = SiteSetting::get('phone_primary');
                $email = SiteSetting::get('email');
            @endphp

            <div class="mt-12 flex flex-col items-center justify-center gap-6 sm:flex-row">
                @if($phonePrimary)
                    <a
                        href="tel:{{ preg_replace('/[^0-9+]/', '', $phonePrimary) }}"
                        class="group inline-flex items-center gap-3 rounded-xl border-2 border-blue-600 bg-white px-8 py-4 font-semibold text-blue-600 transition-all duration-300 hover:bg-blue-600 hover:text-white dark:border-blue-500 dark:bg-slate-800 dark:text-blue-400 dark:hover:bg-blue-600 dark:hover:text-white"
                    >
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        {{ __('Call Us') }}: {{ $phonePrimary }}
                    </a>
                @endif

                <a
                    href="{{ route('contact') }}"
                    class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 to-cyan-600 px-8 py-4 font-semibold text-white shadow-lg shadow-blue-500/30 transition-all duration-300 hover:scale-105 hover:shadow-xl"
                >
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    {{ __('Send a Message') }}
                </a>
            </div>
        </div>
    </section>
</div>
