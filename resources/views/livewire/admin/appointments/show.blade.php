<?php

use App\Models\Appointment;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new
#[Layout('components.layouts.admin')]
#[Title('Appointment Details')]
class extends Component {
    public Appointment $appointment;
    public string $adminNotes = '';
    public bool $editing = false;

    public function mount(Appointment $appointment): void
    {
        $this->appointment = $appointment;
        $this->adminNotes = $appointment->admin_notes ?? '';
    }

    public function saveNotes(): void
    {
        $this->appointment->update(['admin_notes' => $this->adminNotes]);
        $this->editing = false;
        session()->flash('success', __('Notes saved successfully.'));
    }

    public function updateStatus(string $status): void
    {
        switch ($status) {
            case 'confirmed':
                $this->appointment->confirm();
                break;
            case 'completed':
                $this->appointment->complete();
                break;
            case 'cancelled':
                $this->appointment->cancel();
                break;
            case 'no_show':
                $this->appointment->markNoShow();
                break;
            default:
                $this->appointment->update(['status' => $status]);
        }

        $this->appointment->refresh();
        session()->flash('success', __('Status updated successfully.'));
    }

    public function with(): array
    {
        return [
            'statuses' => Appointment::getStatuses(),
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
        <div class="flex items-center gap-4">
            <a
                href="{{ route('admin.appointments.index') }}"
                wire:navigate
                class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-500 transition-all hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-400 dark:hover:bg-slate-700"
            >
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-slate-900 dark:text-white">{{ __('Appointment Details') }}</h1>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ $appointment->formatted_date_time }}</p>
            </div>
        </div>
        <span @class([
            'inline-flex items-center rounded-full px-3 py-1.5 text-sm font-medium',
            'bg-amber-100 text-amber-700 dark:bg-amber-500/20 dark:text-amber-400' => $appointment->status === 'pending',
            'bg-blue-100 text-blue-700 dark:bg-blue-500/20 dark:text-blue-400' => $appointment->status === 'confirmed',
            'bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-400' => $appointment->status === 'completed',
            'bg-red-100 text-red-700 dark:bg-red-500/20 dark:text-red-400' => $appointment->status === 'cancelled',
            'bg-slate-100 text-slate-700 dark:bg-slate-500/20 dark:text-slate-400' => $appointment->status === 'no_show',
        ])>
            {{ $statuses[$appointment->status] ?? ucfirst($appointment->status) }}
        </span>
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

    <div class="grid gap-6 lg:grid-cols-3">
        <!-- Main Info -->
        <div class="space-y-6 lg:col-span-2">
            <!-- Customer Information -->
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <h2 class="font-semibold text-slate-900 dark:text-white">{{ __('Customer Information') }}</h2>
                </div>
                <div class="grid gap-6 p-6 sm:grid-cols-2">
                    <div>
                        <label class="text-xs font-medium uppercase tracking-wider text-slate-500 dark:text-slate-400">{{ __('Name') }}</label>
                        <p class="mt-1 text-lg font-medium text-slate-900 dark:text-white">{{ $appointment->name }}</p>
                    </div>
                    <div>
                        <label class="text-xs font-medium uppercase tracking-wider text-slate-500 dark:text-slate-400">{{ __('Email') }}</label>
                        <p class="mt-1">
                            <a href="mailto:{{ $appointment->email }}" class="text-blue-600 hover:underline dark:text-blue-400">{{ $appointment->email }}</a>
                        </p>
                    </div>
                    <div>
                        <label class="text-xs font-medium uppercase tracking-wider text-slate-500 dark:text-slate-400">{{ __('Phone') }}</label>
                        <p class="mt-1">
                            <a href="tel:{{ $appointment->phone }}" class="text-blue-600 hover:underline dark:text-blue-400">{{ $appointment->phone }}</a>
                        </p>
                    </div>
                    <div>
                        <label class="text-xs font-medium uppercase tracking-wider text-slate-500 dark:text-slate-400">{{ __('Preferred Contact') }}</label>
                        <p class="mt-1 text-slate-900 dark:text-white">{{ ucfirst($appointment->preferred_contact) }}</p>
                    </div>
                </div>
            </div>

            <!-- Customer Notes -->
            @if($appointment->notes)
                <div
                    x-show="shown"
                    x-transition:enter="transition ease-out duration-500 delay-150"
                    x-transition:enter-start="opacity-0 translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900"
                >
                    <div class="flex items-center gap-3 border-b border-slate-200/80 px-6 py-4 dark:border-slate-800">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-500/10 text-amber-600 dark:bg-amber-500/20 dark:text-amber-400">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                            </svg>
                        </div>
                        <h2 class="font-semibold text-slate-900 dark:text-white">{{ __('Customer Notes') }}</h2>
                    </div>
                    <div class="p-6">
                        <p class="text-slate-700 dark:text-slate-300">{{ $appointment->notes }}</p>
                    </div>
                </div>
            @endif

            <!-- Admin Notes -->
            <div
                x-show="shown"
                x-transition:enter="transition ease-out duration-500 delay-200"
                x-transition:enter-start="opacity-0 translate-y-4"
                x-transition:enter-end="opacity-100 translate-y-0"
                class="overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900"
            >
                <div class="flex items-center justify-between border-b border-slate-200/80 px-6 py-4 dark:border-slate-800">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-purple-500/10 text-purple-600 dark:bg-purple-500/20 dark:text-purple-400">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </div>
                        <h2 class="font-semibold text-slate-900 dark:text-white">{{ __('Admin Notes') }}</h2>
                    </div>
                    @if(!$editing)
                        <button
                            wire:click="$set('editing', true)"
                            class="rounded-lg p-2 text-slate-400 transition-colors hover:bg-slate-100 hover:text-slate-600 dark:hover:bg-slate-800 dark:hover:text-slate-300"
                        >
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                            </svg>
                        </button>
                    @endif
                </div>
                <div class="p-6">
                    @if($editing)
                        <form wire:submit="saveNotes" class="space-y-4">
                            <textarea
                                wire:model="adminNotes"
                                rows="4"
                                placeholder="{{ __('Add notes about this appointment...') }}"
                                class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 transition-all duration-200 placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white"
                            ></textarea>
                            <div class="flex items-center gap-3">
                                <button
                                    type="submit"
                                    class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white transition-all duration-200 hover:bg-blue-700"
                                >
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    {{ __('Save Notes') }}
                                </button>
                                <button
                                    type="button"
                                    wire:click="$set('editing', false)"
                                    class="rounded-xl px-4 py-2.5 text-sm font-medium text-slate-600 transition-colors hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-slate-800"
                                >
                                    {{ __('Cancel') }}
                                </button>
                            </div>
                        </form>
                    @else
                        @if($appointment->admin_notes)
                            <p class="text-slate-700 dark:text-slate-300">{{ $appointment->admin_notes }}</p>
                        @else
                            <p class="italic text-slate-400 dark:text-slate-500">{{ __('No admin notes yet. Click edit to add notes.') }}</p>
                        @endif
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Appointment Time -->
            <div
                x-show="shown"
                x-transition:enter="transition ease-out duration-500 delay-100"
                x-transition:enter-start="opacity-0 translate-y-4"
                x-transition:enter-end="opacity-100 translate-y-0"
                class="overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900"
            >
                <div class="flex items-center gap-3 border-b border-slate-200/80 px-6 py-4 dark:border-slate-800">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-cyan-500/10 text-cyan-600 dark:bg-cyan-500/20 dark:text-cyan-400">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h2 class="font-semibold text-slate-900 dark:text-white">{{ __('Appointment') }}</h2>
                </div>
                <div class="p-6 text-center">
                    <p class="text-3xl font-bold text-slate-900 dark:text-white">{{ $appointment->formatted_time }}</p>
                    <p class="mt-2 text-lg text-slate-600 dark:text-slate-400">{{ $appointment->formatted_date }}</p>
                    @if($appointment->isToday())
                        <span class="mt-4 inline-flex items-center gap-1.5 rounded-full bg-blue-100 px-3 py-1 text-sm font-medium text-blue-700 dark:bg-blue-500/20 dark:text-blue-400">
                            <span class="h-2 w-2 rounded-full bg-blue-500"></span>
                            {{ __('Today') }}
                        </span>
                    @elseif($appointment->isPast())
                        <span class="mt-4 inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-3 py-1 text-sm font-medium text-slate-600 dark:bg-slate-700 dark:text-slate-400">
                            {{ __('Past appointment') }}
                        </span>
                    @endif
                </div>
            </div>

            <!-- Quick Actions -->
            <div
                x-show="shown"
                x-transition:enter="transition ease-out duration-500 delay-150"
                x-transition:enter-start="opacity-0 translate-y-4"
                x-transition:enter-end="opacity-100 translate-y-0"
                class="overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900"
            >
                <div class="flex items-center gap-3 border-b border-slate-200/80 px-6 py-4 dark:border-slate-800">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-500/10 text-emerald-600 dark:bg-emerald-500/20 dark:text-emerald-400">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h2 class="font-semibold text-slate-900 dark:text-white">{{ __('Quick Actions') }}</h2>
                </div>
                <div class="space-y-2 p-4">
                    @if($appointment->status !== 'confirmed')
                        <button
                            wire:click="updateStatus('confirmed')"
                            class="flex w-full items-center gap-3 rounded-xl px-4 py-3 text-left transition-colors hover:bg-blue-50 dark:hover:bg-blue-500/10"
                        >
                            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-100 text-blue-600 dark:bg-blue-500/20 dark:text-blue-400">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-slate-900 dark:text-white">{{ __('Confirm') }}</p>
                                <p class="text-xs text-slate-500">{{ __('Mark as confirmed') }}</p>
                            </div>
                        </button>
                    @endif
                    @if($appointment->status !== 'completed')
                        <button
                            wire:click="updateStatus('completed')"
                            class="flex w-full items-center gap-3 rounded-xl px-4 py-3 text-left transition-colors hover:bg-emerald-50 dark:hover:bg-emerald-500/10"
                        >
                            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600 dark:bg-emerald-500/20 dark:text-emerald-400">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-slate-900 dark:text-white">{{ __('Complete') }}</p>
                                <p class="text-xs text-slate-500">{{ __('Mark as completed') }}</p>
                            </div>
                        </button>
                    @endif
                    @if($appointment->status !== 'cancelled')
                        <button
                            wire:click="updateStatus('cancelled')"
                            wire:confirm="{{ __('Are you sure you want to cancel this appointment?') }}"
                            class="flex w-full items-center gap-3 rounded-xl px-4 py-3 text-left transition-colors hover:bg-red-50 dark:hover:bg-red-500/10"
                        >
                            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-red-100 text-red-600 dark:bg-red-500/20 dark:text-red-400">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-slate-900 dark:text-white">{{ __('Cancel') }}</p>
                                <p class="text-xs text-slate-500">{{ __('Cancel appointment') }}</p>
                            </div>
                        </button>
                    @endif
                </div>
            </div>

            <!-- Timeline -->
            <div
                x-show="shown"
                x-transition:enter="transition ease-out duration-500 delay-200"
                x-transition:enter-start="opacity-0 translate-y-4"
                x-transition:enter-end="opacity-100 translate-y-0"
                class="overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900"
            >
                <div class="flex items-center gap-3 border-b border-slate-200/80 px-6 py-4 dark:border-slate-800">
                    <h2 class="font-semibold text-slate-900 dark:text-white">{{ __('Timeline') }}</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex gap-3">
                            <div class="flex flex-col items-center">
                                <div class="flex h-8 w-8 items-center justify-center rounded-full bg-emerald-100 text-emerald-600 dark:bg-emerald-500/20 dark:text-emerald-400">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                </div>
                                <div class="h-full w-px bg-slate-200 dark:bg-slate-700"></div>
                            </div>
                            <div class="pb-4">
                                <p class="text-sm font-medium text-slate-900 dark:text-white">{{ __('Created') }}</p>
                                <p class="text-xs text-slate-500">{{ $appointment->created_at->format('M j, Y g:i A') }}</p>
                            </div>
                        </div>
                        @if($appointment->confirmed_at)
                            <div class="flex gap-3">
                                <div class="flex flex-col items-center">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-100 text-blue-600 dark:bg-blue-500/20 dark:text-blue-400">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                    <div class="h-full w-px bg-slate-200 dark:bg-slate-700"></div>
                                </div>
                                <div class="pb-4">
                                    <p class="text-sm font-medium text-slate-900 dark:text-white">{{ __('Confirmed') }}</p>
                                    <p class="text-xs text-slate-500">{{ $appointment->confirmed_at->format('M j, Y g:i A') }}</p>
                                </div>
                            </div>
                        @endif
                        @if($appointment->cancelled_at)
                            <div class="flex gap-3">
                                <div class="flex flex-col items-center">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-full bg-red-100 text-red-600 dark:bg-red-500/20 dark:text-red-400">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-slate-900 dark:text-white">{{ __('Cancelled') }}</p>
                                    <p class="text-xs text-slate-500">{{ $appointment->cancelled_at->format('M j, Y g:i A') }}</p>
                                    @if($appointment->cancellation_reason)
                                        <p class="mt-1 text-xs text-slate-500">{{ $appointment->cancellation_reason }}</p>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
