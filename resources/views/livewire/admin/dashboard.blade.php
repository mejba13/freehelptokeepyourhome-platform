<?php

use App\Models\Page;
use App\Models\Testimonial;
use App\Models\ContactSubmission;
use App\Models\HeroSection;
use App\Models\Banner;
use App\Models\CallToAction;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new
#[Layout('components.layouts.admin')]
#[Title('Admin Dashboard')]
class extends Component {
    public function with(): array
    {
        return [
            'stats' => [
                'pages' => Page::count(),
                'testimonials' => Testimonial::count(),
                'hero_sections' => HeroSection::count(),
                'banners' => Banner::count(),
                'ctas' => CallToAction::count(),
                'new_submissions' => ContactSubmission::new()->count(),
                'total_submissions' => ContactSubmission::count(),
            ],
            'recentSubmissions' => ContactSubmission::latest()->take(5)->get(),
        ];
    }
}; ?>

<div class="space-y-8">
    <!-- Welcome Hero Section -->
    <div
        x-data="{ shown: false }"
        x-init="setTimeout(() => shown = true, 100)"
        class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 p-8 lg:p-10"
    >
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-[0.03]">
            <svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="admin-hero-pattern" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                        <circle cx="20" cy="20" r="1" fill="white"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#admin-hero-pattern)"/>
            </svg>
        </div>

        <!-- Gradient Orbs -->
        <div class="absolute -left-20 -top-20 h-64 w-64 rounded-full bg-blue-500/30 blur-3xl"></div>
        <div class="absolute -bottom-20 -right-20 h-64 w-64 rounded-full bg-cyan-500/30 blur-3xl"></div>

        <div class="relative">
            <div
                x-show="shown"
                x-transition:enter="transition ease-out duration-700"
                x-transition:enter-start="opacity-0 -translate-y-4"
                x-transition:enter-end="opacity-100 translate-y-0"
                class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between"
            >
                <div>
                    <div class="mb-2 inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1 text-xs font-medium text-blue-300 backdrop-blur-sm">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        {{ __('System Online') }}
                    </div>
                    <h1 class="text-2xl font-bold text-white lg:text-3xl">
                        {{ __('Welcome back') }}, {{ auth()->user()->name }}!
                    </h1>
                    <p class="mt-2 max-w-xl text-blue-100/80">
                        {{ __('Here\'s what\'s happening with your site today. Manage your content, review submissions, and keep your site up to date.') }}
                    </p>
                </div>

                <div class="flex flex-wrap gap-3">
                    <a
                        href="{{ route('home') }}"
                        target="_blank"
                        class="inline-flex items-center gap-2 rounded-xl bg-white/10 px-5 py-2.5 text-sm font-medium text-white backdrop-blur-sm transition-all duration-300 hover:bg-white/20"
                    >
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                        {{ __('View Site') }}
                    </a>
                    <a
                        href="{{ route('admin.settings.index') }}"
                        wire:navigate
                        class="inline-flex items-center gap-2 rounded-xl bg-white px-5 py-2.5 text-sm font-medium text-slate-900 shadow-lg shadow-white/20 transition-all duration-300 hover:scale-105"
                    >
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        {{ __('Settings') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-2 gap-4 lg:grid-cols-3 xl:grid-cols-6">
        @php
            $statCards = [
                ['label' => 'Pages', 'value' => $stats['pages'], 'route' => 'admin.pages.index', 'color' => 'blue', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>'],
                ['label' => 'Testimonials', 'value' => $stats['testimonials'], 'route' => 'admin.testimonials.index', 'color' => 'cyan', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>'],
                ['label' => 'Hero Sections', 'value' => $stats['hero_sections'], 'route' => 'admin.hero.index', 'color' => 'purple', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>'],
                ['label' => 'Banners', 'value' => $stats['banners'], 'route' => 'admin.banners.index', 'color' => 'amber', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>'],
                ['label' => 'CTAs', 'value' => $stats['ctas'], 'route' => 'admin.ctas.index', 'color' => 'emerald', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"/>'],
                ['label' => 'Submissions', 'value' => $stats['new_submissions'], 'route' => 'admin.submissions.index', 'color' => 'red', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>'],
            ];
        @endphp

        @foreach($statCards as $index => $card)
            <a
                href="{{ route($card['route']) }}"
                wire:navigate
                x-data="{ shown: false }"
                x-init="setTimeout(() => shown = true, {{ 150 + ($index * 50) }})"
                x-show="shown"
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 translate-y-4"
                x-transition:enter-end="opacity-100 translate-y-0"
                class="group relative overflow-hidden rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-lg dark:border-slate-800 dark:bg-slate-900"
            >
                <!-- Colored top bar -->
                <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-{{ $card['color'] }}-500 to-{{ $card['color'] }}-400"></div>

                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-xs font-medium uppercase tracking-wider text-slate-400 dark:text-slate-500">{{ __($card['label']) }}</p>
                        <p class="mt-2 text-2xl font-bold text-slate-900 dark:text-white">{{ $card['value'] }}</p>
                    </div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-{{ $card['color'] }}-500/10 text-{{ $card['color'] }}-600 dark:bg-{{ $card['color'] }}-500/20 dark:text-{{ $card['color'] }}-400">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            {!! $card['icon'] !!}
                        </svg>
                    </div>
                </div>

                @if($card['label'] === 'Submissions' && $stats['new_submissions'] > 0)
                    <div class="absolute right-3 top-3">
                        <span class="flex h-2.5 w-2.5">
                            <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-red-400 opacity-75"></span>
                            <span class="relative inline-flex h-2.5 w-2.5 rounded-full bg-red-500"></span>
                        </span>
                    </div>
                @endif
            </a>
        @endforeach
    </div>

    <div class="grid gap-8 xl:grid-cols-3">
        <!-- Recent Submissions -->
        <div
            x-data="{ shown: false }"
            x-init="setTimeout(() => shown = true, 400)"
            x-show="shown"
            x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            class="xl:col-span-2 overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900"
        >
            <div class="flex items-center justify-between border-b border-slate-200/80 px-6 py-5 dark:border-slate-800">
                <div>
                    <h2 class="text-lg font-semibold text-slate-900 dark:text-white">{{ __('Recent Submissions') }}</h2>
                    <p class="mt-0.5 text-sm text-slate-500 dark:text-slate-400">{{ __('Latest form submissions from visitors') }}</p>
                </div>
                <a
                    href="{{ route('admin.submissions.index') }}"
                    wire:navigate
                    class="inline-flex items-center gap-1.5 rounded-lg bg-slate-100 px-3 py-1.5 text-xs font-medium text-slate-600 transition-colors hover:bg-slate-200 dark:bg-slate-800 dark:text-slate-400 dark:hover:bg-slate-700"
                >
                    {{ __('View All') }}
                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            <div class="divide-y divide-slate-200/80 dark:divide-slate-800">
                @forelse ($recentSubmissions as $submission)
                    <a
                        href="{{ route('admin.submissions.show', $submission) }}"
                        wire:navigate
                        class="flex items-center gap-4 px-6 py-4 transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/50"
                    >
                        <div class="flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-blue-500 to-cyan-500 text-sm font-semibold text-white shadow-lg shadow-blue-500/20">
                            {{ strtoupper(substr($submission->name, 0, 2)) }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="flex items-center gap-2">
                                <p class="truncate font-medium text-slate-900 dark:text-white">{{ $submission->name }}</p>
                                @if ($submission->status === 'new')
                                    <span class="inline-flex items-center gap-1 rounded-full bg-red-500/10 px-2 py-0.5 text-[10px] font-semibold uppercase tracking-wide text-red-600 dark:bg-red-500/20 dark:text-red-400">
                                        {{ __('New') }}
                                    </span>
                                @elseif ($submission->status === 'read')
                                    <span class="inline-flex items-center gap-1 rounded-full bg-amber-500/10 px-2 py-0.5 text-[10px] font-semibold uppercase tracking-wide text-amber-600 dark:bg-amber-500/20 dark:text-amber-400">
                                        {{ __('Read') }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 rounded-full bg-emerald-500/10 px-2 py-0.5 text-[10px] font-semibold uppercase tracking-wide text-emerald-600 dark:bg-emerald-500/20 dark:text-emerald-400">
                                        {{ __('Responded') }}
                                    </span>
                                @endif
                            </div>
                            <p class="mt-0.5 truncate text-sm text-slate-500 dark:text-slate-400">{{ $submission->email }}</p>
                        </div>
                        <div class="hidden text-right sm:block">
                            <p class="text-xs text-slate-400 dark:text-slate-500">{{ $submission->created_at->format('M d, Y') }}</p>
                            <p class="mt-0.5 text-xs text-slate-400 dark:text-slate-500">{{ $submission->created_at->format('g:i A') }}</p>
                        </div>
                        <svg class="h-5 w-5 flex-shrink-0 text-slate-300 dark:text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                @empty
                    <div class="flex flex-col items-center justify-center px-6 py-16 text-center">
                        <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100 dark:bg-slate-800">
                            <svg class="h-8 w-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                            </svg>
                        </div>
                        <h3 class="mt-4 font-medium text-slate-900 dark:text-white">{{ __('No submissions yet') }}</h3>
                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ __('New form submissions will appear here.') }}</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Quick Actions -->
        <div
            x-data="{ shown: false }"
            x-init="setTimeout(() => shown = true, 500)"
            x-show="shown"
            x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            class="overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900"
        >
            <div class="border-b border-slate-200/80 px-6 py-5 dark:border-slate-800">
                <h2 class="text-lg font-semibold text-slate-900 dark:text-white">{{ __('Quick Actions') }}</h2>
                <p class="mt-0.5 text-sm text-slate-500 dark:text-slate-400">{{ __('Create new content quickly') }}</p>
            </div>

            <div class="space-y-2 p-4">
                @php
                    $actions = [
                        ['label' => 'New Page', 'route' => 'admin.pages.create', 'color' => 'blue'],
                        ['label' => 'New Testimonial', 'route' => 'admin.testimonials.create', 'color' => 'cyan'],
                        ['label' => 'New Hero Section', 'route' => 'admin.hero.create', 'color' => 'purple'],
                        ['label' => 'New Banner', 'route' => 'admin.banners.create', 'color' => 'amber'],
                        ['label' => 'New CTA', 'route' => 'admin.ctas.create', 'color' => 'emerald'],
                    ];
                @endphp

                @foreach($actions as $action)
                    <a
                        href="{{ route($action['route']) }}"
                        wire:navigate
                        class="group flex items-center gap-3 rounded-xl border border-slate-200/80 bg-slate-50/50 p-3.5 transition-all duration-200 hover:border-{{ $action['color'] }}-500/50 hover:bg-{{ $action['color'] }}-50/50 dark:border-slate-800 dark:bg-slate-800/50 dark:hover:border-{{ $action['color'] }}-500/50 dark:hover:bg-{{ $action['color'] }}-500/10"
                    >
                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-{{ $action['color'] }}-500/10 text-{{ $action['color'] }}-600 transition-colors group-hover:bg-{{ $action['color'] }}-500 group-hover:text-white dark:bg-{{ $action['color'] }}-500/20 dark:text-{{ $action['color'] }}-400">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-slate-700 dark:text-slate-300">{{ __($action['label']) }}</span>
                        <svg class="ml-auto h-4 w-4 text-slate-300 transition-transform group-hover:translate-x-1 dark:text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                @endforeach
            </div>

            <!-- Site Health -->
            <div class="border-t border-slate-200/80 px-6 py-5 dark:border-slate-800">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-500/10 text-emerald-600 dark:bg-emerald-500/20 dark:text-emerald-400">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-slate-900 dark:text-white">{{ __('Site Health') }}</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400">{{ __('All systems operational') }}</p>
                        </div>
                    </div>
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-500/10 px-2.5 py-1 text-xs font-medium text-emerald-600 dark:bg-emerald-500/20 dark:text-emerald-400">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                        {{ __('Good') }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
