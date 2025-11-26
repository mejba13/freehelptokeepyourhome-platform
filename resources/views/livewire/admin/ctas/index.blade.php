<?php

use App\Models\CallToAction;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new
#[Layout('components.layouts.admin')]
#[Title('CTAs')]
class extends Component {
    public function delete(CallToAction $cta): void
    {
        $cta->delete();
    }

    public function with(): array
    {
        return ['ctas' => CallToAction::latest()->get()];
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
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">{{ __('Call to Actions') }}</h1>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ __('Manage CTA buttons and sections') }}</p>
        </div>
        <a
            href="{{ route('admin.ctas.create') }}"
            wire:navigate
            class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 to-cyan-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-blue-500/30 transition-all duration-300 hover:scale-105 hover:shadow-xl"
        >
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            {{ __('Add CTA') }}
        </a>
    </div>

    <!-- CTA Cards Grid -->
    <div
        x-show="shown"
        x-transition:enter="transition ease-out duration-500 delay-100"
        x-transition:enter-start="opacity-0 translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        class="grid gap-6 md:grid-cols-2 lg:grid-cols-3"
    >
        @forelse ($ctas as $index => $cta)
            <div
                wire:key="cta-{{ $cta->id }}"
                class="group overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-lg dark:border-slate-800 dark:bg-slate-900"
            >
                <!-- Card Header -->
                <div class="relative border-b border-slate-200/80 px-6 py-5 dark:border-slate-800">
                    <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-emerald-500 to-cyan-500"></div>
                    <div class="flex items-start justify-between">
                        <div class="flex items-center gap-3">
                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-gradient-to-br from-emerald-500 to-cyan-500 text-sm font-semibold text-white shadow-lg shadow-emerald-500/30">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"/>
                                </svg>
                            </div>
                            <h3 class="font-semibold text-slate-900 dark:text-white">{{ $cta->name }}</h3>
                        </div>
                        @if ($cta->status === 'published')
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
                    </div>
                </div>

                <!-- Card Body -->
                <div class="p-6">
                    <p class="mb-2 font-medium text-slate-800 dark:text-slate-200">{{ $cta->title }}</p>
                    @if ($cta->description)
                        <p class="mb-4 text-sm text-slate-600 dark:text-slate-400">{{ Str::limit($cta->description, 100) }}</p>
                    @endif

                    <div class="mb-4">
                        <span class="inline-flex items-center rounded-full bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-600 dark:bg-slate-800 dark:text-slate-400">
                            {{ ucfirst($cta->style) }}
                        </span>
                    </div>

                    <div class="flex gap-2">
                        <a
                            href="{{ route('admin.ctas.edit', $cta) }}"
                            wire:navigate
                            class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs font-medium text-slate-600 transition-all duration-200 hover:border-slate-300 hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-400 dark:hover:border-slate-600 dark:hover:bg-slate-700"
                        >
                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            {{ __('Edit') }}
                        </a>
                        <button
                            wire:click="delete({{ $cta->id }})"
                            wire:confirm="{{ __('Are you sure you want to delete this CTA?') }}"
                            class="inline-flex items-center gap-1.5 rounded-lg border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-medium text-red-600 transition-all duration-200 hover:border-red-300 hover:bg-red-100 dark:border-red-500/30 dark:bg-red-500/10 dark:text-red-400 dark:hover:border-red-500/50 dark:hover:bg-red-500/20"
                        >
                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            {{ __('Delete') }}
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full flex flex-col items-center justify-center rounded-2xl border border-slate-200/80 bg-white px-6 py-16 text-center dark:border-slate-800 dark:bg-slate-900">
                <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100 dark:bg-slate-800">
                    <svg class="h-8 w-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"/>
                    </svg>
                </div>
                <h3 class="mt-4 font-medium text-slate-900 dark:text-white">{{ __('No CTAs found') }}</h3>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ __('Create your first call to action to get started.') }}</p>
                <a
                    href="{{ route('admin.ctas.create') }}"
                    wire:navigate
                    class="mt-4 inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 to-cyan-600 px-4 py-2 text-sm font-medium text-white shadow-lg shadow-blue-500/30 transition-all duration-300 hover:scale-105"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    {{ __('Add CTA') }}
                </a>
            </div>
        @endforelse
    </div>
</div>
