@php
    use App\Models\SiteSetting;
    $siteName = SiteSetting::get('site_name', 'Free Help To Keep Your Home');
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen antialiased">
        <div class="relative flex min-h-screen">
            <!-- Left Side - Branding Panel -->
            <div class="hidden lg:flex lg:w-1/2 lg:flex-col lg:justify-between relative overflow-hidden bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900">
                <!-- Background Pattern -->
                <div class="absolute inset-0 opacity-[0.03]">
                    <svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <pattern id="auth-pattern" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                                <circle cx="20" cy="20" r="1" fill="white"/>
                            </pattern>
                        </defs>
                        <rect width="100%" height="100%" fill="url(#auth-pattern)"/>
                    </svg>
                </div>

                <!-- Gradient Orbs -->
                <div class="absolute -left-20 top-1/4 h-96 w-96 rounded-full bg-blue-500/20 blur-3xl"></div>
                <div class="absolute -right-20 bottom-1/4 h-96 w-96 rounded-full bg-cyan-500/20 blur-3xl"></div>

                <!-- Content -->
                <div class="relative z-10 flex flex-1 flex-col justify-center px-12 xl:px-16">
                    <div class="mb-8">
                        <a href="{{ route('home') }}" class="flex items-center gap-3" wire:navigate>
                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-500 to-cyan-500 shadow-lg shadow-blue-500/30">
                                <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                            </div>
                            <span class="text-2xl font-bold text-white">{{ $siteName }}</span>
                        </a>
                    </div>

                    <h1 class="text-4xl font-bold leading-tight text-white xl:text-5xl">
                        {{ __('Helping Families Keep Their Homes') }}
                    </h1>
                    <p class="mt-6 text-lg leading-relaxed text-slate-300">
                        {{ __('Free, confidential housing counseling services from HUD-approved counselors. We\'ve helped thousands of families avoid foreclosure and stay in their homes.') }}
                    </p>

                    <!-- Trust Indicators -->
                    <div class="mt-12 flex items-center gap-6">
                        <div class="flex items-center gap-2">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white/10 backdrop-blur-sm">
                                <svg class="h-5 w-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-white">{{ __('HUD Approved') }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white/10 backdrop-blur-sm">
                                <svg class="h-5 w-5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-white">{{ __('100% Confidential') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="relative z-10 px-12 pb-8 xl:px-16">
                    <p class="text-sm text-slate-400">
                        &copy; {{ date('Y') }} {{ $siteName }}. {{ __('All rights reserved.') }}
                    </p>
                </div>
            </div>

            <!-- Right Side - Form Panel -->
            <div class="flex w-full flex-col items-center justify-center bg-white px-6 py-12 dark:bg-slate-900 lg:w-1/2 lg:px-12">
                <!-- Mobile Logo -->
                <div class="mb-8 lg:hidden">
                    <a href="{{ route('home') }}" class="flex flex-col items-center gap-3" wire:navigate>
                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-500 to-cyan-500 shadow-lg shadow-blue-500/30">
                            <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                        </div>
                        <span class="text-lg font-bold text-slate-900 dark:text-white">{{ $siteName }}</span>
                    </a>
                </div>

                <div class="w-full max-w-md">
                    {{ $slot }}
                </div>
            </div>
        </div>
        @fluxScripts
    </body>
</html>
