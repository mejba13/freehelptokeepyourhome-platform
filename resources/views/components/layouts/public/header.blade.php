@php
    use App\Models\SiteSetting;
    $siteName = SiteSetting::get('site_name', 'Free Help To Keep Your Home');
    $tagline = SiteSetting::get('site_tagline', '');
    $phonePrimary = SiteSetting::get('phone_primary', '');
@endphp

<!-- Announcement Bar -->
@if($phonePrimary)
    <div class="bg-gradient-to-r from-slate-900 via-blue-900 to-slate-900 text-white">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-2.5 sm:px-6 lg:px-8">
            <div class="flex items-center gap-2">
                <span class="relative flex h-2 w-2">
                    <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex h-2 w-2 rounded-full bg-emerald-400"></span>
                </span>
                <p class="text-sm font-medium">{{ __('Free & Confidential Help Available') }}</p>
            </div>
            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phonePrimary) }}" class="group flex items-center gap-2 text-sm font-semibold transition-colors hover:text-blue-200">
                <svg class="h-4 w-4 transition-transform group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                </svg>
                <span>{{ $phonePrimary }}</span>
            </a>
        </div>
    </div>
@endif

<!-- Main Header -->
<header
    x-data="{ scrolled: false, mobileOpen: false }"
    @scroll.window="scrolled = window.scrollY > 20"
    :class="scrolled ? 'bg-white/95 shadow-lg shadow-slate-900/5 backdrop-blur-lg dark:bg-slate-900/95' : 'bg-transparent'"
    class="sticky top-0 z-50 transition-all duration-300"
>
    <nav class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-20 items-center justify-between">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="group flex items-center gap-3" wire:navigate>
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-gradient-to-br from-blue-600 to-blue-700 shadow-lg shadow-blue-600/30 transition-transform duration-300 group-hover:scale-105">
                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                </div>
                <div>
                    <span class="block text-lg font-bold leading-tight text-slate-900 dark:text-white">{{ $siteName }}</span>
                    @if($tagline)
                        <span class="block text-xs font-medium text-slate-500 dark:text-slate-400">{{ $tagline }}</span>
                    @endif
                </div>
            </a>

            <!-- Desktop Navigation -->
            <div class="hidden items-center gap-1 lg:flex">
                <a href="{{ route('home') }}" wire:navigate class="rounded-lg px-4 py-2 text-sm font-medium text-slate-700 transition-colors hover:bg-slate-100 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white {{ request()->routeIs('home') ? 'bg-slate-100 text-slate-900 dark:bg-slate-800 dark:text-white' : '' }}">
                    {{ __('Home') }}
                </a>
                <a href="{{ route('about') }}" wire:navigate class="rounded-lg px-4 py-2 text-sm font-medium text-slate-700 transition-colors hover:bg-slate-100 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white {{ request()->routeIs('about') ? 'bg-slate-100 text-slate-900 dark:bg-slate-800 dark:text-white' : '' }}">
                    {{ __('About Us') }}
                </a>
                <a href="{{ route('why-is-it-free') }}" wire:navigate class="rounded-lg px-4 py-2 text-sm font-medium text-slate-700 transition-colors hover:bg-slate-100 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white {{ request()->routeIs('why-is-it-free') ? 'bg-slate-100 text-slate-900 dark:bg-slate-800 dark:text-white' : '' }}">
                    {{ __('Why Is It Free') }}
                </a>
                <a href="{{ route('services') }}" wire:navigate class="rounded-lg px-4 py-2 text-sm font-medium text-slate-700 transition-colors hover:bg-slate-100 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white {{ request()->routeIs('services') ? 'bg-slate-100 text-slate-900 dark:bg-slate-800 dark:text-white' : '' }}">
                    {{ __('Services') }}
                </a>
                <a href="{{ route('testimonials') }}" wire:navigate class="rounded-lg px-4 py-2 text-sm font-medium text-slate-700 transition-colors hover:bg-slate-100 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white {{ request()->routeIs('testimonials') ? 'bg-slate-100 text-slate-900 dark:bg-slate-800 dark:text-white' : '' }}">
                    {{ __('Testimonials') }}
                </a>
                <a href="{{ route('contact') }}" wire:navigate class="rounded-lg px-4 py-2 text-sm font-medium text-slate-700 transition-colors hover:bg-slate-100 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white {{ request()->routeIs('contact') ? 'bg-slate-100 text-slate-900 dark:bg-slate-800 dark:text-white' : '' }}">
                    {{ __('Contact') }}
                </a>
            </div>

            <!-- CTA Button (Desktop) -->
            <div class="hidden lg:block">
                <a
                    href="{{ route('contact') }}"
                    wire:navigate
                    class="group inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-600/30 transition-all duration-300 hover:shadow-xl hover:shadow-blue-600/40"
                >
                    <span>{{ __('Get Free Help') }}</span>
                    <svg class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <button
                @click="mobileOpen = !mobileOpen"
                class="flex h-11 w-11 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-700 transition-colors hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 dark:hover:bg-slate-700 lg:hidden"
                :aria-expanded="mobileOpen"
                aria-label="Toggle menu"
            >
                <svg x-show="!mobileOpen" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="mobileOpen" x-cloak class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div
        x-show="mobileOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        x-cloak
        class="border-t border-slate-200 bg-white px-4 pb-6 pt-4 shadow-xl dark:border-slate-700 dark:bg-slate-900 lg:hidden"
    >
        <nav class="space-y-1">
            <a href="{{ route('home') }}" wire:navigate @click="mobileOpen = false" class="flex items-center gap-3 rounded-xl px-4 py-3 text-base font-medium text-slate-700 transition-colors hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800 {{ request()->routeIs('home') ? 'bg-slate-100 text-slate-900 dark:bg-slate-800 dark:text-white' : '' }}">
                <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                {{ __('Home') }}
            </a>
            <a href="{{ route('about') }}" wire:navigate @click="mobileOpen = false" class="flex items-center gap-3 rounded-xl px-4 py-3 text-base font-medium text-slate-700 transition-colors hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800 {{ request()->routeIs('about') ? 'bg-slate-100 text-slate-900 dark:bg-slate-800 dark:text-white' : '' }}">
                <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ __('About Us') }}
            </a>
            <a href="{{ route('why-is-it-free') }}" wire:navigate @click="mobileOpen = false" class="flex items-center gap-3 rounded-xl px-4 py-3 text-base font-medium text-slate-700 transition-colors hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800 {{ request()->routeIs('why-is-it-free') ? 'bg-slate-100 text-slate-900 dark:bg-slate-800 dark:text-white' : '' }}">
                <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ __('Why Is It Free') }}
            </a>
            <a href="{{ route('services') }}" wire:navigate @click="mobileOpen = false" class="flex items-center gap-3 rounded-xl px-4 py-3 text-base font-medium text-slate-700 transition-colors hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800 {{ request()->routeIs('services') ? 'bg-slate-100 text-slate-900 dark:bg-slate-800 dark:text-white' : '' }}">
                <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                {{ __('Services') }}
            </a>
            <a href="{{ route('testimonials') }}" wire:navigate @click="mobileOpen = false" class="flex items-center gap-3 rounded-xl px-4 py-3 text-base font-medium text-slate-700 transition-colors hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800 {{ request()->routeIs('testimonials') ? 'bg-slate-100 text-slate-900 dark:bg-slate-800 dark:text-white' : '' }}">
                <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
                {{ __('Testimonials') }}
            </a>
            <a href="{{ route('contact') }}" wire:navigate @click="mobileOpen = false" class="flex items-center gap-3 rounded-xl px-4 py-3 text-base font-medium text-slate-700 transition-colors hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800 {{ request()->routeIs('contact') ? 'bg-slate-100 text-slate-900 dark:bg-slate-800 dark:text-white' : '' }}">
                <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                {{ __('Contact') }}
            </a>
        </nav>

        <div class="mt-6 border-t border-slate-200 pt-6 dark:border-slate-700">
            <a
                href="{{ route('contact') }}"
                wire:navigate
                @click="mobileOpen = false"
                class="flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4 text-base font-semibold text-white shadow-lg shadow-blue-600/30"
            >
                <span>{{ __('Get Free Help Today') }}</span>
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>

        @if($phonePrimary)
            <div class="mt-4">
                <a
                    href="tel:{{ preg_replace('/[^0-9+]/', '', $phonePrimary) }}"
                    class="flex w-full items-center justify-center gap-2 rounded-xl border border-slate-200 bg-slate-50 px-6 py-4 text-base font-semibold text-slate-700 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300"
                >
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    <span>{{ $phonePrimary }}</span>
                </a>
            </div>
        @endif
    </div>
</header>
