<?php

use App\Models\ContactSubmission;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new
#[Layout('components.layouts.admin')]
#[Title('Form Submissions')]
class extends Component {
    use WithPagination;

    public string $filter = '';

    public function updatedFilter(): void
    {
        $this->resetPage();
    }

    public function delete(ContactSubmission $submission): void
    {
        $submission->delete();
    }

    public function with(): array
    {
        return [
            'submissions' => ContactSubmission::query()
                ->when($this->filter, fn ($q) => $q->where('status', $this->filter))
                ->latest()
                ->paginate(15),
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
        class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between"
    >
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">{{ __('Form Submissions') }}</h1>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ __('View and manage contact form submissions') }}</p>
        </div>
    </div>

    <!-- Content Card -->
    <div
        x-show="shown"
        x-transition:enter="transition ease-out duration-500 delay-100"
        x-transition:enter-start="opacity-0 translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        class="overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900"
    >
        <!-- Filter Bar -->
        <div class="border-b border-slate-200/80 p-4 dark:border-slate-800">
            <select
                wire:model.live="filter"
                class="w-48 rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 transition-all duration-200 focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:focus:border-blue-500 dark:focus:bg-slate-800"
            >
                <option value="">{{ __('All Submissions') }}</option>
                <option value="new">{{ __('New') }}</option>
                <option value="read">{{ __('Read') }}</option>
                <option value="responded">{{ __('Responded') }}</option>
            </select>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="border-b border-slate-200/80 bg-slate-50/50 dark:border-slate-800 dark:bg-slate-800/50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">{{ __('Contact') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">{{ __('Type') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">{{ __('Status') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">{{ __('Date') }}</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200/80 dark:divide-slate-800">
                    @forelse ($submissions as $submission)
                        <tr wire:key="submission-{{ $submission->id }}" class="group transition-colors {{ $submission->status === 'new' ? 'bg-blue-50/50 dark:bg-blue-900/10' : 'hover:bg-slate-50/50 dark:hover:bg-slate-800/30' }}">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-11 w-11 items-center justify-center rounded-xl {{ $submission->status === 'new' ? 'bg-gradient-to-br from-blue-500 to-cyan-500 shadow-lg shadow-blue-500/20' : 'bg-slate-200 dark:bg-slate-700' }} text-sm font-semibold text-white">
                                        {{ strtoupper(substr($submission->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <span class="font-medium text-slate-900 dark:text-white">{{ $submission->name }}</span>
                                            @if ($submission->status === 'new')
                                                <span class="flex h-2 w-2">
                                                    <span class="absolute inline-flex h-2 w-2 animate-ping rounded-full bg-blue-400 opacity-75"></span>
                                                    <span class="relative inline-flex h-2 w-2 rounded-full bg-blue-500"></span>
                                                </span>
                                            @endif
                                        </div>
                                        <p class="text-sm text-slate-500 dark:text-slate-400">{{ $submission->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-600 dark:bg-slate-800 dark:text-slate-400">
                                    {{ ucfirst($submission->form_type) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if ($submission->status === 'new')
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-red-500/10 px-2.5 py-1 text-xs font-medium text-red-600 dark:bg-red-500/20 dark:text-red-400">
                                        <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>
                                        {{ __('New') }}
                                    </span>
                                @elseif ($submission->status === 'read')
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-500/10 px-2.5 py-1 text-xs font-medium text-amber-600 dark:bg-amber-500/20 dark:text-amber-400">
                                        <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                        {{ __('Read') }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-500/10 px-2.5 py-1 text-xs font-medium text-emerald-600 dark:bg-emerald-500/20 dark:text-emerald-400">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                        {{ __('Responded') }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div>
                                    <span class="text-sm text-slate-900 dark:text-white">{{ $submission->created_at->format('M j, Y') }}</span>
                                    <p class="text-xs text-slate-500 dark:text-slate-400">{{ $submission->created_at->format('g:i A') }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a
                                        href="{{ route('admin.submissions.show', $submission) }}"
                                        wire:navigate
                                        class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs font-medium text-slate-600 transition-all duration-200 hover:border-slate-300 hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-400 dark:hover:border-slate-600 dark:hover:bg-slate-700"
                                    >
                                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        {{ __('View') }}
                                    </a>
                                    <button
                                        wire:click="delete({{ $submission->id }})"
                                        wire:confirm="{{ __('Are you sure you want to delete this submission?') }}"
                                        class="inline-flex items-center gap-1.5 rounded-lg border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-medium text-red-600 transition-all duration-200 hover:border-red-300 hover:bg-red-100 dark:border-red-500/30 dark:bg-red-500/10 dark:text-red-400 dark:hover:border-red-500/50 dark:hover:bg-red-500/20"
                                    >
                                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        {{ __('Delete') }}
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100 dark:bg-slate-800">
                                        <svg class="h-8 w-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                        </svg>
                                    </div>
                                    <h3 class="mt-4 font-medium text-slate-900 dark:text-white">{{ __('No submissions found') }}</h3>
                                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ __('New form submissions will appear here.') }}</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($submissions->hasPages())
            <div class="border-t border-slate-200/80 px-6 py-4 dark:border-slate-800">
                {{ $submissions->links() }}
            </div>
        @endif
    </div>
</div>
