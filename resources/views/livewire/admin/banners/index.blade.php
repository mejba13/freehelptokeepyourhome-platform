<?php

use App\Models\Banner;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new
#[Layout('components.layouts.admin')]
#[Title('Banners')]
class extends Component {
    public function delete(Banner $banner): void
    {
        $banner->delete();
    }

    public function with(): array
    {
        return ['banners' => Banner::latest()->get()];
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
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">{{ __('Banners') }}</h1>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ __('Manage promotional banners and announcements') }}</p>
        </div>
        <a
            href="{{ route('admin.banners.create') }}"
            wire:navigate
            class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 to-cyan-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-blue-500/30 transition-all duration-300 hover:scale-105 hover:shadow-xl"
        >
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            {{ __('Add Banner') }}
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
        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="border-b border-slate-200/80 bg-slate-50/50 dark:border-slate-800 dark:bg-slate-800/50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">{{ __('Name') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">{{ __('Position') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">{{ __('Status') }}</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200/80 dark:divide-slate-800">
                    @forelse ($banners as $banner)
                        <tr wire:key="banner-{{ $banner->id }}" class="group transition-colors hover:bg-slate-50/50 dark:hover:bg-slate-800/30">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-gradient-to-br from-amber-500 to-orange-500 text-sm font-semibold text-white shadow-lg shadow-amber-500/30">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <span class="font-medium text-slate-900 dark:text-white">{{ $banner->name }}</span>
                                        <p class="text-sm text-slate-500 dark:text-slate-400">{{ Str::limit($banner->title, 40) }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-600 dark:bg-slate-800 dark:text-slate-400">
                                    {{ ucfirst($banner->position) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if ($banner->status === 'published')
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
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a
                                        href="{{ route('admin.banners.edit', $banner) }}"
                                        wire:navigate
                                        class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs font-medium text-slate-600 transition-all duration-200 hover:border-slate-300 hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-400 dark:hover:border-slate-600 dark:hover:bg-slate-700"
                                    >
                                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        {{ __('Edit') }}
                                    </a>
                                    <button
                                        wire:click="delete({{ $banner->id }})"
                                        wire:confirm="{{ __('Are you sure you want to delete this banner?') }}"
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
                            <td colspan="4" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100 dark:bg-slate-800">
                                        <svg class="h-8 w-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                                        </svg>
                                    </div>
                                    <h3 class="mt-4 font-medium text-slate-900 dark:text-white">{{ __('No banners found') }}</h3>
                                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ __('Create your first banner to get started.') }}</p>
                                    <a
                                        href="{{ route('admin.banners.create') }}"
                                        wire:navigate
                                        class="mt-4 inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 to-cyan-600 px-4 py-2 text-sm font-medium text-white shadow-lg shadow-blue-500/30 transition-all duration-300 hover:scale-105"
                                    >
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                        </svg>
                                        {{ __('Add Banner') }}
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
