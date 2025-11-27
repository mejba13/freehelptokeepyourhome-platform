@php
    use App\Models\SiteSetting;
    $siteName = SiteSetting::get('site_name', 'Free Help To Keep Your Home');
    $phonePrimary = SiteSetting::get('phone_primary', '');
    $phoneSecondary = SiteSetting::get('phone_secondary', '');
    $email = SiteSetting::get('email', '');
    $address = SiteSetting::get('address', '');
    $businessHours = SiteSetting::get('business_hours', '');
    $facebookUrl = SiteSetting::get('facebook_url', '');
    $twitterUrl = SiteSetting::get('twitter_url', '');
    $linkedinUrl = SiteSetting::get('linkedin_url', '');
    $footerText = SiteSetting::get('footer_text', '');
    $disclosureText = SiteSetting::get('disclosure_text', '');
@endphp

<footer class="relative overflow-hidden bg-slate-900">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-[0.02]">
        <svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="footer-pattern" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                    <circle cx="20" cy="20" r="1" fill="white"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#footer-pattern)"/>
        </svg>
    </div>

    <!-- Gradient Orbs -->
    <div class="absolute -left-40 top-0 h-80 w-80 rounded-full bg-blue-500/10 blur-3xl"></div>
    <div class="absolute -right-40 bottom-0 h-80 w-80 rounded-full bg-cyan-500/10 blur-3xl"></div>

    <!-- Main Footer -->
    <div class="relative mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8 lg:py-20">
        <div class="grid gap-12 md:grid-cols-2 lg:grid-cols-4 lg:gap-8">
            <!-- About -->
            <div class="lg:col-span-2">
                <div class="flex items-center gap-3">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-blue-500 to-cyan-500 shadow-lg shadow-blue-500/25">
                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-white">{{ $siteName }}</span>
                </div>
                @if($footerText)
                    <p class="mt-6 max-w-md text-base leading-relaxed text-slate-400">{{ $footerText }}</p>
                @endif

                <!-- Social Links -->
                @if($facebookUrl || $twitterUrl || $linkedinUrl)
                    <div class="mt-8 flex gap-4">
                        @if($facebookUrl)
                            <a
                                href="{{ $facebookUrl }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-800 text-slate-400 transition-all duration-300 hover:bg-blue-600 hover:text-white hover:shadow-lg hover:shadow-blue-500/25"
                                aria-label="Facebook"
                            >
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/>
                                </svg>
                            </a>
                        @endif
                        @if($twitterUrl)
                            <a
                                href="{{ $twitterUrl }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-800 text-slate-400 transition-all duration-300 hover:bg-sky-500 hover:text-white hover:shadow-lg hover:shadow-sky-500/25"
                                aria-label="Twitter"
                            >
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/>
                                </svg>
                            </a>
                        @endif
                        @if($linkedinUrl)
                            <a
                                href="{{ $linkedinUrl }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-800 text-slate-400 transition-all duration-300 hover:bg-blue-700 hover:text-white hover:shadow-lg hover:shadow-blue-700/25"
                                aria-label="LinkedIn"
                            >
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                </svg>
                            </a>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-sm font-semibold uppercase tracking-widest text-white">{{ __('Quick Links') }}</h3>
                <ul class="mt-6 space-y-4">
                    <li>
                        <a href="{{ route('home') }}" class="group inline-flex items-center gap-2 text-slate-400 transition-colors duration-300 hover:text-white" wire:navigate>
                            <span class="h-px w-0 bg-gradient-to-r from-blue-500 to-cyan-500 transition-all duration-300 group-hover:w-4"></span>
                            {{ __('Home') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}" class="group inline-flex items-center gap-2 text-slate-400 transition-colors duration-300 hover:text-white" wire:navigate>
                            <span class="h-px w-0 bg-gradient-to-r from-blue-500 to-cyan-500 transition-all duration-300 group-hover:w-4"></span>
                            {{ __('About Us') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('why-is-it-free') }}" class="group inline-flex items-center gap-2 text-slate-400 transition-colors duration-300 hover:text-white" wire:navigate>
                            <span class="h-px w-0 bg-gradient-to-r from-blue-500 to-cyan-500 transition-all duration-300 group-hover:w-4"></span>
                            {{ __('Why Is It Free') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('services') }}" class="group inline-flex items-center gap-2 text-slate-400 transition-colors duration-300 hover:text-white" wire:navigate>
                            <span class="h-px w-0 bg-gradient-to-r from-blue-500 to-cyan-500 transition-all duration-300 group-hover:w-4"></span>
                            {{ __('Services') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('testimonials') }}" class="group inline-flex items-center gap-2 text-slate-400 transition-colors duration-300 hover:text-white" wire:navigate>
                            <span class="h-px w-0 bg-gradient-to-r from-blue-500 to-cyan-500 transition-all duration-300 group-hover:w-4"></span>
                            {{ __('Testimonials') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" class="group inline-flex items-center gap-2 text-slate-400 transition-colors duration-300 hover:text-white" wire:navigate>
                            <span class="h-px w-0 bg-gradient-to-r from-blue-500 to-cyan-500 transition-all duration-300 group-hover:w-4"></span>
                            {{ __('Contact') }}
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h3 class="text-sm font-semibold uppercase tracking-widest text-white">{{ __('Contact Us') }}</h3>
                <ul class="mt-6 space-y-4">
                    @if($phonePrimary)
                        <li class="flex items-start gap-3">
                            <div class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg bg-slate-800">
                                <svg class="h-4 w-4 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phonePrimary) }}" class="text-slate-400 transition-colors duration-300 hover:text-white">{{ $phonePrimary }}</a>
                        </li>
                    @endif
                    @if($phoneSecondary)
                        <li class="flex items-start gap-3">
                            <div class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg bg-slate-800">
                                <svg class="h-4 w-4 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phoneSecondary) }}" class="text-slate-400 transition-colors duration-300 hover:text-white">{{ $phoneSecondary }}</a>
                        </li>
                    @endif
                    @if($email)
                        <li class="flex items-start gap-3">
                            <div class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg bg-slate-800">
                                <svg class="h-4 w-4 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <a href="mailto:{{ $email }}" class="text-slate-400 transition-colors duration-300 hover:text-white">{{ $email }}</a>
                        </li>
                    @endif
                    @if($businessHours)
                        <li class="flex items-start gap-3">
                            <div class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg bg-slate-800">
                                <svg class="h-4 w-4 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <span class="text-slate-400">{{ $businessHours }}</span>
                        </li>
                    @endif
                    @if($address)
                        <li class="flex items-start gap-3">
                            <div class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg bg-slate-800">
                                <svg class="h-4 w-4 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <span class="text-slate-400">{!! nl2br(e($address)) !!}</span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <!-- Disclosure -->
    @if($disclosureText)
        <div class="relative border-t border-slate-800">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <p class="text-center text-sm leading-relaxed text-slate-500">{{ $disclosureText }}</p>
            </div>
        </div>
    @endif

    <!-- Copyright -->
    <div class="relative border-t border-slate-800 bg-slate-900/50">
        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            <div class="flex flex-col items-center justify-between gap-4 sm:flex-row">
                <p class="text-sm text-slate-500">
                    &copy; {{ date('Y') }} {{ $siteName }}. {{ __('All rights reserved.') }}
                </p>
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-green-500/10 px-3 py-1 text-xs font-medium text-green-400">
                        <span class="h-1.5 w-1.5 rounded-full bg-green-400"></span>
                        {{ __('HUD Approved') }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</footer>
