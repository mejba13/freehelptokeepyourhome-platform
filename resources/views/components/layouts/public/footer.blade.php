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

<footer class="border-t border-zinc-200 bg-zinc-50 dark:border-zinc-800 dark:bg-zinc-900">
    <!-- Main Footer -->
    <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-4">
            <!-- About -->
            <div class="lg:col-span-2">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-600 text-white">
                        <x-flux::icon name="home" class="h-6 w-6" />
                    </div>
                    <span class="text-lg font-bold text-zinc-900 dark:text-white">{{ $siteName }}</span>
                </div>
                @if($footerText)
                    <p class="mt-4 max-w-md text-sm text-zinc-600 dark:text-zinc-400">{{ $footerText }}</p>
                @endif
                <!-- Social Links -->
                @if($facebookUrl || $twitterUrl || $linkedinUrl)
                    <div class="mt-6 flex gap-4">
                        @if($facebookUrl)
                            <a href="{{ $facebookUrl }}" target="_blank" rel="noopener noreferrer" class="text-zinc-400 transition hover:text-blue-600" aria-label="Facebook">
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                            </a>
                        @endif
                        @if($twitterUrl)
                            <a href="{{ $twitterUrl }}" target="_blank" rel="noopener noreferrer" class="text-zinc-400 transition hover:text-blue-400" aria-label="Twitter">
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/></svg>
                            </a>
                        @endif
                        @if($linkedinUrl)
                            <a href="{{ $linkedinUrl }}" target="_blank" rel="noopener noreferrer" class="text-zinc-400 transition hover:text-blue-700" aria-label="LinkedIn">
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                            </a>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-sm font-semibold uppercase tracking-wider text-zinc-900 dark:text-white">{{ __('Quick Links') }}</h3>
                <ul class="mt-4 space-y-3">
                    <li><a href="{{ route('home') }}" class="text-sm text-zinc-600 transition hover:text-blue-600 dark:text-zinc-400 dark:hover:text-blue-400" wire:navigate>{{ __('Home') }}</a></li>
                    <li><a href="{{ route('about') }}" class="text-sm text-zinc-600 transition hover:text-blue-600 dark:text-zinc-400 dark:hover:text-blue-400" wire:navigate>{{ __('About Us') }}</a></li>
                    <li><a href="{{ route('services') }}" class="text-sm text-zinc-600 transition hover:text-blue-600 dark:text-zinc-400 dark:hover:text-blue-400" wire:navigate>{{ __('Services') }}</a></li>
                    <li><a href="{{ route('testimonials') }}" class="text-sm text-zinc-600 transition hover:text-blue-600 dark:text-zinc-400 dark:hover:text-blue-400" wire:navigate>{{ __('Testimonials') }}</a></li>
                    <li><a href="{{ route('contact') }}" class="text-sm text-zinc-600 transition hover:text-blue-600 dark:text-zinc-400 dark:hover:text-blue-400" wire:navigate>{{ __('Contact') }}</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h3 class="text-sm font-semibold uppercase tracking-wider text-zinc-900 dark:text-white">{{ __('Contact Us') }}</h3>
                <ul class="mt-4 space-y-3">
                    @if($phonePrimary)
                        <li class="flex items-start gap-2">
                            <x-flux::icon name="phone" class="mt-0.5 h-4 w-4 flex-shrink-0 text-blue-600" />
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phonePrimary) }}" class="text-sm text-zinc-600 hover:text-blue-600 dark:text-zinc-400 dark:hover:text-blue-400">{{ $phonePrimary }}</a>
                        </li>
                    @endif
                    @if($phoneSecondary)
                        <li class="flex items-start gap-2">
                            <x-flux::icon name="phone" class="mt-0.5 h-4 w-4 flex-shrink-0 text-blue-600" />
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phoneSecondary) }}" class="text-sm text-zinc-600 hover:text-blue-600 dark:text-zinc-400 dark:hover:text-blue-400">{{ $phoneSecondary }}</a>
                        </li>
                    @endif
                    @if($email)
                        <li class="flex items-start gap-2">
                            <x-flux::icon name="envelope" class="mt-0.5 h-4 w-4 flex-shrink-0 text-blue-600" />
                            <a href="mailto:{{ $email }}" class="text-sm text-zinc-600 hover:text-blue-600 dark:text-zinc-400 dark:hover:text-blue-400">{{ $email }}</a>
                        </li>
                    @endif
                    @if($businessHours)
                        <li class="flex items-start gap-2">
                            <x-flux::icon name="clock" class="mt-0.5 h-4 w-4 flex-shrink-0 text-blue-600" />
                            <span class="text-sm text-zinc-600 dark:text-zinc-400">{{ $businessHours }}</span>
                        </li>
                    @endif
                    @if($address)
                        <li class="flex items-start gap-2">
                            <x-flux::icon name="map-pin" class="mt-0.5 h-4 w-4 flex-shrink-0 text-blue-600" />
                            <span class="text-sm text-zinc-600 dark:text-zinc-400">{!! nl2br(e($address)) !!}</span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <!-- Disclosure -->
    @if($disclosureText)
        <div class="border-t border-zinc-200 bg-zinc-100 dark:border-zinc-800 dark:bg-zinc-900/50">
            <div class="mx-auto max-w-7xl px-4 py-4 sm:px-6 lg:px-8">
                <p class="text-center text-xs text-zinc-500 dark:text-zinc-400">{{ $disclosureText }}</p>
            </div>
        </div>
    @endif

    <!-- Copyright -->
    <div class="border-t border-zinc-200 dark:border-zinc-800">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <p class="text-center text-sm text-zinc-500 dark:text-zinc-400">
                &copy; {{ date('Y') }} {{ $siteName }}. {{ __('All rights reserved.') }}
            </p>
        </div>
    </div>
</footer>
