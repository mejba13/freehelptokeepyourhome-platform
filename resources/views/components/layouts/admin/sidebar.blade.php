@props(['title' => null])

@php
    use App\Models\SiteSetting;
    $siteName = SiteSetting::get('site_name', 'Free Help To Keep Your Home');
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        <style>
            /* Custom scrollbar for sidebar */
            .sidebar-scroll::-webkit-scrollbar {
                width: 4px;
            }
            .sidebar-scroll::-webkit-scrollbar-track {
                background: transparent;
            }
            .sidebar-scroll::-webkit-scrollbar-thumb {
                background: rgba(148, 163, 184, 0.3);
                border-radius: 2px;
            }
            .sidebar-scroll::-webkit-scrollbar-thumb:hover {
                background: rgba(148, 163, 184, 0.5);
            }
            /* Nav item active gradient */
            .nav-item-active {
                background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(6, 182, 212, 0.1) 100%);
                border-left: 3px solid;
                border-image: linear-gradient(180deg, #3b82f6, #06b6d4) 1;
            }
            .dark .nav-item-active {
                background: linear-gradient(135deg, rgba(59, 130, 246, 0.15) 0%, rgba(6, 182, 212, 0.15) 100%);
            }
        </style>
    </head>
    <body class="min-h-screen bg-slate-100 antialiased dark:bg-slate-950">
        <!-- Sidebar -->
        <aside
            x-data="{ open: false, mobileOpen: false }"
            @keydown.escape.window="mobileOpen = false"
            class="fixed inset-y-0 left-0 z-50 w-72 transform transition-transform duration-300 lg:translate-x-0"
            :class="mobileOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
        >
            <!-- Sidebar backdrop for mobile -->
            <div
                x-show="mobileOpen"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                @click="mobileOpen = false"
                class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm lg:hidden"
            ></div>

            <!-- Sidebar content -->
            <div class="relative flex h-full flex-col border-r border-slate-200/80 bg-white shadow-xl dark:border-slate-800 dark:bg-slate-900">
                <!-- Logo Section -->
                <div class="flex h-20 items-center gap-3 border-b border-slate-200/80 px-6 dark:border-slate-800">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3" wire:navigate>
                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-gradient-to-br from-blue-500 to-cyan-500 shadow-lg shadow-blue-500/30 transition-transform duration-300 hover:scale-105">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-sm font-bold text-slate-900 dark:text-white">{{ Str::limit($siteName, 18) }}</span>
                            <span class="inline-flex items-center gap-1 text-xs font-medium text-blue-600 dark:text-blue-400">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                Admin Panel
                            </span>
                        </div>
                    </a>
                    <!-- Mobile close button -->
                    <button
                        @click="mobileOpen = false"
                        class="ml-auto rounded-lg p-2 text-slate-400 hover:bg-slate-100 hover:text-slate-600 lg:hidden dark:hover:bg-slate-800 dark:hover:text-slate-300"
                    >
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <!-- Navigation -->
                <nav class="sidebar-scroll flex-1 overflow-y-auto px-4 py-6">
                    <!-- Dashboard Section -->
                    <div class="mb-8">
                        <p class="mb-3 px-3 text-xs font-semibold uppercase tracking-wider text-slate-400 dark:text-slate-500">{{ __('Dashboard') }}</p>
                        <a
                            href="{{ route('admin.dashboard') }}"
                            wire:navigate
                            class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'nav-item-active text-blue-600 dark:text-blue-400' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-white' }}"
                        >
                            <div class="flex h-9 w-9 items-center justify-center rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-br from-blue-500 to-cyan-500 text-white shadow-lg shadow-blue-500/30' : 'bg-slate-100 text-slate-500 group-hover:bg-slate-200 dark:bg-slate-800 dark:text-slate-400 dark:group-hover:bg-slate-700' }} transition-all duration-200">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
                                </svg>
                            </div>
                            <span>{{ __('Overview') }}</span>
                        </a>
                    </div>

                    <!-- Content Section -->
                    <div class="mb-8">
                        <p class="mb-3 px-3 text-xs font-semibold uppercase tracking-wider text-slate-400 dark:text-slate-500">{{ __('Content') }}</p>
                        <div class="space-y-1">
                            <a
                                href="{{ route('admin.pages.index') }}"
                                wire:navigate
                                class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.pages.*') ? 'nav-item-active text-blue-600 dark:text-blue-400' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-white' }}"
                            >
                                <div class="flex h-9 w-9 items-center justify-center rounded-lg {{ request()->routeIs('admin.pages.*') ? 'bg-gradient-to-br from-blue-500 to-cyan-500 text-white shadow-lg shadow-blue-500/30' : 'bg-slate-100 text-slate-500 group-hover:bg-slate-200 dark:bg-slate-800 dark:text-slate-400 dark:group-hover:bg-slate-700' }} transition-all duration-200">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <span>{{ __('Pages') }}</span>
                            </a>

                            <a
                                href="{{ route('admin.testimonials.index') }}"
                                wire:navigate
                                class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.testimonials.*') ? 'nav-item-active text-blue-600 dark:text-blue-400' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-white' }}"
                            >
                                <div class="flex h-9 w-9 items-center justify-center rounded-lg {{ request()->routeIs('admin.testimonials.*') ? 'bg-gradient-to-br from-blue-500 to-cyan-500 text-white shadow-lg shadow-blue-500/30' : 'bg-slate-100 text-slate-500 group-hover:bg-slate-200 dark:bg-slate-800 dark:text-slate-400 dark:group-hover:bg-slate-700' }} transition-all duration-200">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                    </svg>
                                </div>
                                <span>{{ __('Testimonials') }}</span>
                            </a>

                            <a
                                href="{{ route('admin.hero.index') }}"
                                wire:navigate
                                class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.hero.*') ? 'nav-item-active text-blue-600 dark:text-blue-400' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-white' }}"
                            >
                                <div class="flex h-9 w-9 items-center justify-center rounded-lg {{ request()->routeIs('admin.hero.*') ? 'bg-gradient-to-br from-blue-500 to-cyan-500 text-white shadow-lg shadow-blue-500/30' : 'bg-slate-100 text-slate-500 group-hover:bg-slate-200 dark:bg-slate-800 dark:text-slate-400 dark:group-hover:bg-slate-700' }} transition-all duration-200">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <span>{{ __('Hero Sections') }}</span>
                            </a>

                            <a
                                href="{{ route('admin.banners.index') }}"
                                wire:navigate
                                class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.banners.*') ? 'nav-item-active text-blue-600 dark:text-blue-400' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-white' }}"
                            >
                                <div class="flex h-9 w-9 items-center justify-center rounded-lg {{ request()->routeIs('admin.banners.*') ? 'bg-gradient-to-br from-blue-500 to-cyan-500 text-white shadow-lg shadow-blue-500/30' : 'bg-slate-100 text-slate-500 group-hover:bg-slate-200 dark:bg-slate-800 dark:text-slate-400 dark:group-hover:bg-slate-700' }} transition-all duration-200">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                                    </svg>
                                </div>
                                <span>{{ __('Banners') }}</span>
                            </a>

                            <a
                                href="{{ route('admin.ctas.index') }}"
                                wire:navigate
                                class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.ctas.*') ? 'nav-item-active text-blue-600 dark:text-blue-400' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-white' }}"
                            >
                                <div class="flex h-9 w-9 items-center justify-center rounded-lg {{ request()->routeIs('admin.ctas.*') ? 'bg-gradient-to-br from-blue-500 to-cyan-500 text-white shadow-lg shadow-blue-500/30' : 'bg-slate-100 text-slate-500 group-hover:bg-slate-200 dark:bg-slate-800 dark:text-slate-400 dark:group-hover:bg-slate-700' }} transition-all duration-200">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"/>
                                    </svg>
                                </div>
                                <span>{{ __('CTAs') }}</span>
                            </a>
                        </div>
                    </div>

                    <!-- Communications Section -->
                    <div class="mb-8">
                        <p class="mb-3 px-3 text-xs font-semibold uppercase tracking-wider text-slate-400 dark:text-slate-500">{{ __('Communications') }}</p>
                        <a
                            href="{{ route('admin.submissions.index') }}"
                            wire:navigate
                            class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.submissions.*') ? 'nav-item-active text-blue-600 dark:text-blue-400' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-white' }}"
                        >
                            <div class="flex h-9 w-9 items-center justify-center rounded-lg {{ request()->routeIs('admin.submissions.*') ? 'bg-gradient-to-br from-blue-500 to-cyan-500 text-white shadow-lg shadow-blue-500/30' : 'bg-slate-100 text-slate-500 group-hover:bg-slate-200 dark:bg-slate-800 dark:text-slate-400 dark:group-hover:bg-slate-700' }} transition-all duration-200">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <span>{{ __('Submissions') }}</span>
                            @php $newCount = \App\Models\ContactSubmission::new()->count(); @endphp
                            @if($newCount > 0)
                                <span class="ml-auto inline-flex h-5 min-w-[20px] items-center justify-center rounded-full bg-red-500 px-1.5 text-xs font-semibold text-white">
                                    {{ $newCount }}
                                </span>
                            @endif
                        </a>
                    </div>

                    <!-- Settings Section -->
                    <div>
                        <p class="mb-3 px-3 text-xs font-semibold uppercase tracking-wider text-slate-400 dark:text-slate-500">{{ __('Settings') }}</p>
                        <div class="space-y-1">
                            <a
                                href="{{ route('admin.settings.index') }}"
                                wire:navigate
                                class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.settings.*') ? 'nav-item-active text-blue-600 dark:text-blue-400' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-white' }}"
                            >
                                <div class="flex h-9 w-9 items-center justify-center rounded-lg {{ request()->routeIs('admin.settings.*') ? 'bg-gradient-to-br from-blue-500 to-cyan-500 text-white shadow-lg shadow-blue-500/30' : 'bg-slate-100 text-slate-500 group-hover:bg-slate-200 dark:bg-slate-800 dark:text-slate-400 dark:group-hover:bg-slate-700' }} transition-all duration-200">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <span>{{ __('Site Settings') }}</span>
                            </a>

                            @can('manage-users')
                            <a
                                href="{{ route('admin.users.index') }}"
                                wire:navigate
                                class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.users.*') ? 'nav-item-active text-blue-600 dark:text-blue-400' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-white' }}"
                            >
                                <div class="flex h-9 w-9 items-center justify-center rounded-lg {{ request()->routeIs('admin.users.*') ? 'bg-gradient-to-br from-blue-500 to-cyan-500 text-white shadow-lg shadow-blue-500/30' : 'bg-slate-100 text-slate-500 group-hover:bg-slate-200 dark:bg-slate-800 dark:text-slate-400 dark:group-hover:bg-slate-700' }} transition-all duration-200">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                    </svg>
                                </div>
                                <span>{{ __('Users') }}</span>
                            </a>
                            @endcan
                        </div>
                    </div>
                </nav>

                <!-- User Section -->
                <div class="border-t border-slate-200/80 p-4 dark:border-slate-800">
                    <!-- Back to Site -->
                    <a
                        href="{{ route('home') }}"
                        target="_blank"
                        class="mb-4 flex items-center gap-3 rounded-xl bg-slate-100 px-3 py-2.5 text-sm font-medium text-slate-600 transition-all duration-200 hover:bg-slate-200 dark:bg-slate-800 dark:text-slate-400 dark:hover:bg-slate-700"
                    >
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                        <span>{{ __('View Site') }}</span>
                    </a>

                    <!-- User Dropdown -->
                    <div x-data="{ userOpen: false }" class="relative">
                        <button
                            @click="userOpen = !userOpen"
                            class="flex w-full items-center gap-3 rounded-xl p-2 transition-all duration-200 hover:bg-slate-100 dark:hover:bg-slate-800"
                        >
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-blue-500 to-cyan-500 text-sm font-semibold text-white shadow-lg shadow-blue-500/30">
                                {{ auth()->user()->initials() }}
                            </div>
                            <div class="flex-1 text-left">
                                <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-slate-500 dark:text-slate-400">{{ Str::limit(auth()->user()->email, 20) }}</p>
                            </div>
                            <svg class="h-5 w-5 text-slate-400 transition-transform duration-200" :class="userOpen ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div
                            x-show="userOpen"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 -translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 -translate-y-2"
                            @click.away="userOpen = false"
                            class="absolute bottom-full left-0 mb-2 w-full overflow-hidden rounded-xl border border-slate-200 bg-white shadow-lg dark:border-slate-700 dark:bg-slate-800"
                        >
                            <a
                                href="{{ route('profile.edit') }}"
                                wire:navigate
                                class="flex items-center gap-3 px-4 py-3 text-sm text-slate-600 transition-colors hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-slate-700"
                            >
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                {{ __('Profile Settings') }}
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button
                                    type="submit"
                                    class="flex w-full items-center gap-3 px-4 py-3 text-sm text-red-600 transition-colors hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-500/10"
                                >
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    {{ __('Log Out') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="lg:pl-72">
            <!-- Top Header Bar -->
            <header class="sticky top-0 z-40 flex h-16 items-center gap-4 border-b border-slate-200/80 bg-white/80 px-6 backdrop-blur-xl dark:border-slate-800 dark:bg-slate-900/80 lg:h-20">
                <!-- Mobile Menu Button -->
                <button
                    @click="mobileOpen = true"
                    class="rounded-lg p-2 text-slate-400 hover:bg-slate-100 hover:text-slate-600 lg:hidden dark:hover:bg-slate-800 dark:hover:text-slate-300"
                >
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                <!-- Breadcrumb / Page Title Area -->
                <div class="flex-1">
                    @if($title)
                        <h1 class="text-lg font-semibold text-slate-900 dark:text-white">{{ $title }}</h1>
                    @endif
                </div>

                <!-- Header Actions -->
                <div class="flex items-center gap-3">
                    <!-- Notifications -->
                    @php $newSubmissions = \App\Models\ContactSubmission::new()->count(); @endphp
                    <a
                        href="{{ route('admin.submissions.index') }}"
                        wire:navigate
                        class="relative rounded-xl p-2.5 text-slate-400 transition-colors hover:bg-slate-100 hover:text-slate-600 dark:hover:bg-slate-800 dark:hover:text-slate-300"
                    >
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        @if($newSubmissions > 0)
                            <span class="absolute right-1 top-1 flex h-4 w-4 items-center justify-center rounded-full bg-red-500 text-[10px] font-semibold text-white">
                                {{ $newSubmissions > 9 ? '9+' : $newSubmissions }}
                            </span>
                        @endif
                    </a>

                    <!-- Mobile User Avatar -->
                    <div class="lg:hidden">
                        <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-blue-500 to-cyan-500 text-sm font-semibold text-white">
                            {{ auth()->user()->initials() }}
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-6 lg:p-8">
                {{ $slot }}
            </main>
        </div>

        @fluxScripts
    </body>
</html>
