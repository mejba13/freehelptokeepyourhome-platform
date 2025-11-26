<?php

use App\Models\Page;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new
#[Layout('components.layouts.admin')]
#[Title('Pages')]
class extends Component {
    use WithPagination;

    public string $search = '';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function delete(Page $page): void
    {
        $page->delete();
        $this->dispatch('page-deleted');
    }

    public function with(): array
    {
        return [
            'pages' => Page::query()
                ->when($this->search, fn ($q) => $q->where('title', 'like', "%{$this->search}%"))
                ->ordered()
                ->paginate(10),
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
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">{{ __('Pages') }}</h1>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ __('Manage your website pages and content') }}</p>
        </div>
        <a
            href="{{ route('admin.pages.create') }}"
            wire:navigate
            class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 to-cyan-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-blue-500/30 transition-all duration-300 hover:scale-105 hover:shadow-xl"
        >
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            {{ __('Create Page') }}
        </a>
    </div>

    <!-- Content Card -->
    <div
        x-show="shown"
        x-transition:enter="transition ease-out duration-500 delay-100"
        x-transition:enter-start="opacity-0 translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        class="overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900"
    >
        <!-- Search Bar -->
        <div class="border-b border-slate-200/80 p-4 dark:border-slate-800">
            <div class="relative max-w-sm">
                <svg class="absolute left-3 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input
                    type="text"
                    wire:model.live.debounce.300ms="search"
                    placeholder="{{ __('Search pages...') }}"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 py-2.5 pl-10 pr-4 text-sm text-slate-900 transition-all duration-200 placeholder:text-slate-400 focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 dark:focus:border-blue-500 dark:focus:bg-slate-800"
                />
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="border-b border-slate-200/80 bg-slate-50/50 dark:border-slate-800 dark:bg-slate-800/50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">{{ __('Title') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">{{ __('Slug') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">{{ __('Status') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">{{ __('Updated') }}</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200/80 dark:divide-slate-800">
                    @forelse ($pages as $page)
                        <tr wire:key="page-{{ $page->id }}" class="group transition-colors hover:bg-slate-50/50 dark:hover:bg-slate-800/30">
                            <td class="px-6 py-4">
                                <span class="font-medium text-slate-900 dark:text-white">{{ $page->title }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <code class="rounded-lg bg-slate-100 px-2 py-1 text-xs text-slate-600 dark:bg-slate-800 dark:text-slate-400">/{{ $page->slug }}</code>
                            </td>
                            <td class="px-6 py-4">
                                @if ($page->status === 'published')
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-500/10 px-2.5 py-1 text-xs font-medium text-emerald-600 dark:bg-emerald-500/20 dark:text-emerald-400">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                        {{ __('Published') }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-500/10 px-2.5 py-1 text-xs font-medium text-amber-600 dark:bg-amber-500/20 dark:text-amber-400">
                                        <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                        {{ __('Draft') }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm text-slate-500 dark:text-slate-400">{{ $page->updated_at->diffForHumans() }}</span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a
                                        href="{{ route('admin.pages.edit', $page) }}"
                                        wire:navigate
                                        class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs font-medium text-slate-600 transition-all duration-200 hover:border-slate-300 hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-400 dark:hover:border-slate-600 dark:hover:bg-slate-700"
                                    >
                                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        {{ __('Edit') }}
                                    </a>
                                    <button
                                        wire:click="delete({{ $page->id }})"
                                        wire:confirm="{{ __('Are you sure you want to delete this page?') }}"
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
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </div>
                                    <h3 class="mt-4 font-medium text-slate-900 dark:text-white">{{ __('No pages found') }}</h3>
                                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ __('Create your first page to get started.') }}</p>
                                    <a
                                        href="{{ route('admin.pages.create') }}"
                                        wire:navigate
                                        class="mt-4 inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 to-cyan-600 px-4 py-2 text-sm font-medium text-white shadow-lg shadow-blue-500/30 transition-all duration-300 hover:scale-105"
                                    >
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                        </svg>
                                        {{ __('Create Page') }}
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($pages->hasPages())
            <div class="border-t border-slate-200/80 px-6 py-4 dark:border-slate-800">
                {{ $pages->links() }}
            </div>
        @endif
    </div>
</div>
