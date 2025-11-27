<?php

use App\Models\BlockedDate;
use App\Models\BookingSetting;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new
#[Layout('components.layouts.admin')]
#[Title('Booking Settings')]
class extends Component {
    public array $workingDays = [];
    public string $startTime = '09:00';
    public string $endTime = '17:00';
    public int $slotDuration = 30;
    public int $bufferTime = 0;
    public int $maxPerSlot = 1;
    public ?int $maxPerDay = null;
    public int $advanceBookingDays = 30;
    public int $minimumNoticeHours = 24;
    public bool $isActive = true;

    public string $newBlockedDate = '';
    public string $newBlockedReason = '';
    public bool $newBlockedRecurring = false;

    public function mount(): void
    {
        $settings = BookingSetting::getSettings();

        $this->workingDays = $settings->working_days;
        $this->startTime = Carbon::parse($settings->start_time)->format('H:i');
        $this->endTime = Carbon::parse($settings->end_time)->format('H:i');
        $this->slotDuration = $settings->slot_duration;
        $this->bufferTime = $settings->buffer_time;
        $this->maxPerSlot = $settings->max_appointments_per_slot;
        $this->maxPerDay = $settings->max_appointments_per_day;
        $this->advanceBookingDays = $settings->advance_booking_days;
        $this->minimumNoticeHours = $settings->minimum_notice_hours;
        $this->isActive = $settings->is_active;
    }

    public function saveSettings(): void
    {
        $this->validate([
            'startTime' => 'required',
            'endTime' => 'required|after:startTime',
            'slotDuration' => 'required|integer|min:15|max:180',
            'bufferTime' => 'required|integer|min:0|max:60',
            'maxPerSlot' => 'required|integer|min:1|max:10',
            'maxPerDay' => 'nullable|integer|min:1|max:100',
            'advanceBookingDays' => 'required|integer|min:1|max:365',
            'minimumNoticeHours' => 'required|integer|min:0|max:168',
        ]);

        $settings = BookingSetting::getSettings();
        $settings->update([
            'working_days' => $this->workingDays,
            'start_time' => $this->startTime,
            'end_time' => $this->endTime,
            'slot_duration' => $this->slotDuration,
            'buffer_time' => $this->bufferTime,
            'max_appointments_per_slot' => $this->maxPerSlot,
            'max_appointments_per_day' => $this->maxPerDay,
            'advance_booking_days' => $this->advanceBookingDays,
            'minimum_notice_hours' => $this->minimumNoticeHours,
            'is_active' => $this->isActive,
        ]);

        session()->flash('success', __('Booking settings saved successfully.'));
    }

    public function addBlockedDate(): void
    {
        $this->validate([
            'newBlockedDate' => 'required|date|after_or_equal:today',
            'newBlockedReason' => 'nullable|string|max:255',
        ]);

        BlockedDate::create([
            'date' => $this->newBlockedDate,
            'reason' => $this->newBlockedReason,
            'is_recurring' => $this->newBlockedRecurring,
        ]);

        $this->reset(['newBlockedDate', 'newBlockedReason', 'newBlockedRecurring']);
        session()->flash('blocked_success', __('Blocked date added successfully.'));
    }

    public function removeBlockedDate(int $id): void
    {
        BlockedDate::findOrFail($id)->delete();
        session()->flash('blocked_success', __('Blocked date removed.'));
    }

    public function with(): array
    {
        return [
            'blockedDates' => BlockedDate::orderBy('date')->get(),
            'allDays' => [
                'monday' => __('Monday'),
                'tuesday' => __('Tuesday'),
                'wednesday' => __('Wednesday'),
                'thursday' => __('Thursday'),
                'friday' => __('Friday'),
                'saturday' => __('Saturday'),
                'sunday' => __('Sunday'),
            ],
        ];
    }
}; ?>

<div
    x-data="{ shown: false }"
    x-init="setTimeout(() => shown = true, 100)"
    class="space-y-6"
>
    <!-- Page Header -->
    <div
        x-show="shown"
        x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="opacity-0 -translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        class="flex items-center justify-between"
    >
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">{{ __('Booking Settings') }}</h1>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ __('Configure appointment availability and booking rules') }}</p>
        </div>
        <a
            href="{{ route('admin.appointments.index') }}"
            wire:navigate
            class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 transition-all duration-200 hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 dark:hover:bg-slate-700"
        >
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            {{ __('View Appointments') }}
        </a>
    </div>

    <!-- Success Message -->
    @if (session('success'))
        <div
            x-data="{ show: true }"
            x-show="show"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            x-init="setTimeout(() => show = false, 5000)"
            class="flex items-center gap-3 rounded-xl border border-emerald-200 bg-emerald-50 p-4 dark:border-emerald-500/30 dark:bg-emerald-500/10"
        >
            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-500/20 text-emerald-600 dark:text-emerald-400">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <span class="text-sm font-medium text-emerald-700 dark:text-emerald-300">{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid gap-6 lg:grid-cols-2">
        <!-- Booking Settings Form -->
        <div class="space-y-6">
            <form wire:submit="saveSettings" class="space-y-6">
                <!-- Working Days -->
                <div
                    x-show="shown"
                    x-transition:enter="transition ease-out duration-500 delay-100"
                    x-transition:enter-start="opacity-0 translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900"
                >
                    <div class="flex items-center gap-3 border-b border-slate-200/80 px-6 py-4 dark:border-slate-800">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-500/10 text-blue-600 dark:bg-blue-500/20 dark:text-blue-400">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <h2 class="font-semibold text-slate-900 dark:text-white">{{ __('Working Days') }}</h2>
                    </div>
                    <div class="p-6">
                        <div class="flex flex-wrap gap-3">
                            @foreach($allDays as $day => $label)
                                <label class="relative cursor-pointer">
                                    <input
                                        type="checkbox"
                                        wire:model="workingDays"
                                        value="{{ $day }}"
                                        class="peer sr-only"
                                    >
                                    <span class="inline-flex items-center rounded-xl border-2 border-slate-200 px-4 py-2 text-sm font-medium text-slate-600 transition-all duration-200 peer-checked:border-blue-500 peer-checked:bg-blue-50 peer-checked:text-blue-700 dark:border-slate-700 dark:text-slate-400 dark:peer-checked:border-blue-500 dark:peer-checked:bg-blue-500/20 dark:peer-checked:text-blue-400">
                                        {{ $label }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Time Settings -->
                <div
                    x-show="shown"
                    x-transition:enter="transition ease-out duration-500 delay-150"
                    x-transition:enter-start="opacity-0 translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900"
                >
                    <div class="flex items-center gap-3 border-b border-slate-200/80 px-6 py-4 dark:border-slate-800">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-cyan-500/10 text-cyan-600 dark:bg-cyan-500/20 dark:text-cyan-400">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h2 class="font-semibold text-slate-900 dark:text-white">{{ __('Time Settings') }}</h2>
                    </div>
                    <div class="grid gap-5 p-6 sm:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('Start Time') }}</label>
                            <input type="time" wire:model="startTime" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 transition-all duration-200 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white"/>
                            @error('startTime') <span class="mt-1 text-xs text-red-500">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('End Time') }}</label>
                            <input type="time" wire:model="endTime" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 transition-all duration-200 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white"/>
                            @error('endTime') <span class="mt-1 text-xs text-red-500">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('Slot Duration (minutes)') }}</label>
                            <select wire:model="slotDuration" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 transition-all duration-200 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                                <option value="15">15 {{ __('minutes') }}</option>
                                <option value="30">30 {{ __('minutes') }}</option>
                                <option value="45">45 {{ __('minutes') }}</option>
                                <option value="60">60 {{ __('minutes') }}</option>
                                <option value="90">90 {{ __('minutes') }}</option>
                                <option value="120">120 {{ __('minutes') }}</option>
                            </select>
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('Buffer Time (minutes)') }}</label>
                            <select wire:model="bufferTime" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 transition-all duration-200 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                                <option value="0">{{ __('No buffer') }}</option>
                                <option value="5">5 {{ __('minutes') }}</option>
                                <option value="10">10 {{ __('minutes') }}</option>
                                <option value="15">15 {{ __('minutes') }}</option>
                                <option value="30">30 {{ __('minutes') }}</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Capacity & Limits -->
                <div
                    x-show="shown"
                    x-transition:enter="transition ease-out duration-500 delay-200"
                    x-transition:enter-start="opacity-0 translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900"
                >
                    <div class="flex items-center gap-3 border-b border-slate-200/80 px-6 py-4 dark:border-slate-800">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-500/10 text-amber-600 dark:bg-amber-500/20 dark:text-amber-400">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <h2 class="font-semibold text-slate-900 dark:text-white">{{ __('Capacity & Limits') }}</h2>
                    </div>
                    <div class="grid gap-5 p-6 sm:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('Max Appointments Per Slot') }}</label>
                            <input type="number" wire:model="maxPerSlot" min="1" max="10" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 transition-all duration-200 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white"/>
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('Max Appointments Per Day') }}</label>
                            <input type="number" wire:model="maxPerDay" min="1" placeholder="{{ __('Unlimited') }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 transition-all duration-200 placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white"/>
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('Advance Booking (days)') }}</label>
                            <input type="number" wire:model="advanceBookingDays" min="1" max="365" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 transition-all duration-200 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white"/>
                            <p class="mt-1.5 text-xs text-slate-500">{{ __('How far in advance users can book') }}</p>
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('Minimum Notice (hours)') }}</label>
                            <input type="number" wire:model="minimumNoticeHours" min="0" max="168" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 transition-all duration-200 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white"/>
                            <p class="mt-1.5 text-xs text-slate-500">{{ __('Hours required before appointment') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Booking Status -->
                <div
                    x-show="shown"
                    x-transition:enter="transition ease-out duration-500 delay-250"
                    x-transition:enter-start="opacity-0 translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900"
                >
                    <div class="flex items-center justify-between px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-500/10 text-emerald-600 dark:bg-emerald-500/20 dark:text-emerald-400">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="font-semibold text-slate-900 dark:text-white">{{ __('Booking Status') }}</h2>
                                <p class="text-sm text-slate-500">{{ __('Enable or disable appointment booking') }}</p>
                            </div>
                        </div>
                        <label class="relative inline-flex cursor-pointer items-center">
                            <input type="checkbox" wire:model="isActive" class="peer sr-only">
                            <div class="peer h-7 w-12 rounded-full bg-slate-200 after:absolute after:left-[4px] after:top-[4px] after:h-5 after:w-5 after:rounded-full after:border after:border-slate-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-emerald-500 peer-checked:after:translate-x-5 peer-checked:after:border-white dark:bg-slate-700"></div>
                        </label>
                    </div>
                </div>

                <!-- Save Button -->
                <div
                    x-show="shown"
                    x-transition:enter="transition ease-out duration-500 delay-300"
                    x-transition:enter-start="opacity-0 translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0"
                >
                    <button
                        type="submit"
                        class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 to-cyan-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-500/30 transition-all duration-300 hover:scale-105 hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-blue-500/20"
                    >
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        {{ __('Save Settings') }}
                    </button>
                </div>
            </form>
        </div>

        <!-- Blocked Dates -->
        <div
            x-show="shown"
            x-transition:enter="transition ease-out duration-500 delay-150"
            x-transition:enter-start="opacity-0 translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            class="space-y-6"
        >
            <!-- Add Blocked Date -->
            <div class="overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <div class="flex items-center gap-3 border-b border-slate-200/80 px-6 py-4 dark:border-slate-800">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-red-500/10 text-red-600 dark:bg-red-500/20 dark:text-red-400">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                        </svg>
                    </div>
                    <h2 class="font-semibold text-slate-900 dark:text-white">{{ __('Blocked Dates') }}</h2>
                </div>
                <form wire:submit="addBlockedDate" class="p-6">
                    @if (session('blocked_success'))
                        <div class="mb-4 flex items-center gap-2 rounded-lg bg-emerald-50 p-3 text-sm text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ session('blocked_success') }}
                        </div>
                    @endif

                    <div class="space-y-4">
                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('Date') }}</label>
                            <input type="date" wire:model="newBlockedDate" min="{{ now()->format('Y-m-d') }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 transition-all duration-200 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white"/>
                            @error('newBlockedDate') <span class="mt-1 text-xs text-red-500">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('Reason (optional)') }}</label>
                            <input type="text" wire:model="newBlockedReason" placeholder="{{ __('e.g., Holiday, Personal day') }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 transition-all duration-200 placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white"/>
                        </div>
                        <label class="flex cursor-pointer items-center gap-3">
                            <input type="checkbox" wire:model="newBlockedRecurring" class="h-5 w-5 rounded border-slate-300 text-blue-600 focus:ring-blue-500 dark:border-slate-600 dark:bg-slate-800">
                            <span class="text-sm text-slate-700 dark:text-slate-300">{{ __('Repeat annually (e.g., for holidays)') }}</span>
                        </label>
                        <button
                            type="submit"
                            class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-red-500 px-4 py-3 text-sm font-semibold text-white transition-all duration-200 hover:bg-red-600"
                        >
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            {{ __('Add Blocked Date') }}
                        </button>
                    </div>
                </form>
            </div>

            <!-- Blocked Dates List -->
            <div class="overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <div class="flex items-center gap-3 border-b border-slate-200/80 px-6 py-4 dark:border-slate-800">
                    <h3 class="font-semibold text-slate-900 dark:text-white">{{ __('Upcoming Blocked Dates') }}</h3>
                </div>
                <div class="max-h-96 divide-y divide-slate-200/80 overflow-y-auto dark:divide-slate-800">
                    @forelse($blockedDates as $blocked)
                        <div class="flex items-center justify-between px-6 py-4">
                            <div>
                                <p class="font-medium text-slate-900 dark:text-white">
                                    {{ $blocked->date->format('l, M j, Y') }}
                                    @if($blocked->is_recurring)
                                        <span class="ml-2 inline-flex items-center rounded-full bg-purple-100 px-2 py-0.5 text-xs font-medium text-purple-700 dark:bg-purple-500/20 dark:text-purple-400">
                                            {{ __('Recurring') }}
                                        </span>
                                    @endif
                                </p>
                                @if($blocked->reason)
                                    <p class="text-sm text-slate-500 dark:text-slate-400">{{ $blocked->reason }}</p>
                                @endif
                            </div>
                            <button
                                wire:click="removeBlockedDate({{ $blocked->id }})"
                                wire:confirm="{{ __('Are you sure you want to remove this blocked date?') }}"
                                class="rounded-lg p-2 text-slate-400 transition-colors hover:bg-red-50 hover:text-red-500 dark:hover:bg-red-500/10"
                            >
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </div>
                    @empty
                        <div class="px-6 py-12 text-center">
                            <svg class="mx-auto h-12 w-12 text-slate-300 dark:text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p class="mt-4 text-sm text-slate-500 dark:text-slate-400">{{ __('No blocked dates') }}</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
