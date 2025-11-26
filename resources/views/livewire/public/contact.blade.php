<?php

use App\Models\ContactSubmission;
use App\Models\SiteSetting;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new
#[Layout('components.layouts.public')]
#[Title('Contact Us')]
class extends Component {
    public string $name = '';
    public string $email = '';
    public string $phone = '';
    public string $message = '';
    public bool $submitted = false;

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'message' => ['required', 'string', 'max:5000'],
        ];
    }

    public function submit(): void
    {
        $validated = $this->validate();

        ContactSubmission::create([
            'form_type' => 'contact',
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'message' => $validated['message'],
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'status' => 'new',
        ]);

        $this->submitted = true;
        $this->reset(['name', 'email', 'phone', 'message']);
    }
}; ?>

<div class="overflow-hidden">
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 py-24 lg:py-32">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-[0.03]">
            <svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="contact-hero-pattern" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                        <circle cx="20" cy="20" r="1" fill="white"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#contact-hero-pattern)"/>
            </svg>
        </div>

        <!-- Gradient Orbs -->
        <div class="absolute left-1/4 top-0 h-96 w-96 -translate-x-1/2 rounded-full bg-blue-500/20 blur-3xl"></div>
        <div class="absolute bottom-0 right-1/4 h-96 w-96 translate-x-1/2 rounded-full bg-cyan-500/20 blur-3xl"></div>

        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div
                x-data="{ shown: false }"
                x-init="setTimeout(() => shown = true, 100)"
                class="mx-auto max-w-3xl text-center"
            >
                <p
                    x-show="shown"
                    x-transition:enter="transition ease-out duration-700"
                    x-transition:enter-start="opacity-0 -translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="text-sm font-semibold uppercase tracking-widest text-blue-400"
                >{{ __('Get In Touch') }}</p>
                <h1
                    x-show="shown"
                    x-transition:enter="transition ease-out duration-700 delay-150"
                    x-transition:enter-start="opacity-0 -translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="mt-4 text-4xl font-bold tracking-tight text-white sm:text-5xl lg:text-6xl"
                >{{ __('Contact Us') }}</h1>
                <p
                    x-show="shown"
                    x-transition:enter="transition ease-out duration-700 delay-300"
                    x-transition:enter-start="opacity-0 -translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="mt-6 text-lg leading-relaxed text-slate-300"
                >{{ __('Get free, confidential help from our certified housing counselors. We\'re here to help you keep your home.') }}</p>
            </div>
        </div>
    </section>

    <!-- Contact Content -->
    <section class="bg-white py-24 dark:bg-slate-900 lg:py-32">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-12 lg:grid-cols-3">
                <!-- Contact Info -->
                <div
                    x-data="{ shown: false }"
                    x-init="setTimeout(() => shown = true, 200)"
                    x-show="shown"
                    x-transition:enter="transition ease-out duration-700"
                    x-transition:enter-start="opacity-0 -translate-x-8"
                    x-transition:enter-end="opacity-100 translate-x-0"
                    class="space-y-8"
                >
                    <div>
                        <h2 class="text-2xl font-bold text-slate-900 dark:text-white">{{ __('Get in Touch') }}</h2>
                        <p class="mt-4 leading-relaxed text-slate-600 dark:text-slate-400">{{ __('Our housing counselors are ready to help you. All consultations are free and confidential.') }}</p>
                    </div>

                    @php
                        $phonePrimary = SiteSetting::get('phone_primary');
                        $phoneSecondary = SiteSetting::get('phone_secondary');
                        $email = SiteSetting::get('email');
                        $address = SiteSetting::get('address');
                        $businessHours = SiteSetting::get('business_hours');
                    @endphp

                    <div class="space-y-6">
                        @if($phonePrimary)
                            <div class="group flex items-start gap-4">
                                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-blue-500 to-cyan-500 shadow-lg shadow-blue-500/25 transition-transform duration-300 group-hover:scale-110">
                                    <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-slate-900 dark:text-white">{{ __('Phone') }}</h3>
                                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phonePrimary) }}" class="text-blue-600 transition-colors hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300">{{ $phonePrimary }}</a>
                                    @if($phoneSecondary)
                                        <br><a href="tel:{{ preg_replace('/[^0-9+]/', '', $phoneSecondary) }}" class="text-blue-600 transition-colors hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300">{{ $phoneSecondary }}</a>
                                    @endif
                                </div>
                            </div>
                        @endif

                        @if($email)
                            <div class="group flex items-start gap-4">
                                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-blue-500 to-cyan-500 shadow-lg shadow-blue-500/25 transition-transform duration-300 group-hover:scale-110">
                                    <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-slate-900 dark:text-white">{{ __('Email') }}</h3>
                                    <a href="mailto:{{ $email }}" class="text-blue-600 transition-colors hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300">{{ $email }}</a>
                                </div>
                            </div>
                        @endif

                        @if($businessHours)
                            <div class="group flex items-start gap-4">
                                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-blue-500 to-cyan-500 shadow-lg shadow-blue-500/25 transition-transform duration-300 group-hover:scale-110">
                                    <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-slate-900 dark:text-white">{{ __('Business Hours') }}</h3>
                                    <p class="text-slate-600 dark:text-slate-400">{{ $businessHours }}</p>
                                </div>
                            </div>
                        @endif

                        @if($address)
                            <div class="group flex items-start gap-4">
                                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-blue-500 to-cyan-500 shadow-lg shadow-blue-500/25 transition-transform duration-300 group-hover:scale-110">
                                    <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-slate-900 dark:text-white">{{ __('Address') }}</h3>
                                    <p class="text-slate-600 dark:text-slate-400">{!! nl2br(e($address)) !!}</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Confidentiality Notice -->
                    <div class="rounded-2xl border border-blue-200 bg-gradient-to-br from-blue-50 to-cyan-50 p-6 dark:border-blue-800 dark:from-blue-900/30 dark:to-cyan-900/30">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-600">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>
                            <h3 class="font-semibold text-slate-900 dark:text-white">{{ __('100% Confidential') }}</h3>
                        </div>
                        <p class="mt-3 text-sm leading-relaxed text-slate-600 dark:text-slate-400">{{ __('Your information is protected. We never share your personal details with third parties.') }}</p>
                    </div>
                </div>

                <!-- Contact Form -->
                <div
                    x-data="{ shown: false }"
                    x-init="setTimeout(() => shown = true, 400)"
                    x-show="shown"
                    x-transition:enter="transition ease-out duration-700"
                    x-transition:enter-start="opacity-0 translate-x-8"
                    x-transition:enter-end="opacity-100 translate-x-0"
                    class="lg:col-span-2"
                >
                    <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-xl shadow-slate-200/50 dark:border-slate-700 dark:bg-slate-800 dark:shadow-none lg:p-10">
                        @if($submitted)
                            <div class="py-8 text-center">
                                <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-gradient-to-br from-green-400 to-emerald-500 shadow-lg shadow-green-500/30">
                                    <svg class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <h2 class="mt-8 text-2xl font-bold text-slate-900 dark:text-white">{{ __('Thank You!') }}</h2>
                                <p class="mx-auto mt-4 max-w-md leading-relaxed text-slate-600 dark:text-slate-400">{{ __('We\'ve received your message and will get back to you within 24-48 hours. If you need immediate assistance, please call us directly.') }}</p>
                                @if($phonePrimary)
                                    <div class="mt-8">
                                        <a
                                            href="tel:{{ preg_replace('/[^0-9+]/', '', $phonePrimary) }}"
                                            class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 to-cyan-600 px-8 py-4 font-semibold text-white shadow-lg shadow-blue-500/30 transition-all duration-300 hover:scale-105 hover:shadow-xl"
                                        >
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                            </svg>
                                            {{ __('Call Us Now') }}: {{ $phonePrimary }}
                                        </a>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="mb-8">
                                <h2 class="text-2xl font-bold text-slate-900 dark:text-white">{{ __('Send Us a Message') }}</h2>
                                <p class="mt-2 text-slate-600 dark:text-slate-400">{{ __('Fill out the form below and we\'ll respond within 24-48 hours.') }}</p>
                            </div>

                            <form wire:submit="submit" class="space-y-6">
                                <div class="grid gap-6 sm:grid-cols-2">
                                    <div>
                                        <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">
                                            {{ __('Full Name') }} <span class="text-red-500">*</span>
                                        </label>
                                        <input
                                            type="text"
                                            wire:model="name"
                                            required
                                            class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 transition-all duration-200 placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/20 dark:border-slate-600 dark:bg-slate-700 dark:text-white dark:placeholder:text-slate-500 dark:focus:border-blue-400 dark:focus:ring-blue-400/20"
                                            placeholder="{{ __('John Doe') }}"
                                        />
                                        @error('name')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">
                                            {{ __('Email Address') }} <span class="text-red-500">*</span>
                                        </label>
                                        <input
                                            type="email"
                                            wire:model="email"
                                            required
                                            class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 transition-all duration-200 placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/20 dark:border-slate-600 dark:bg-slate-700 dark:text-white dark:placeholder:text-slate-500 dark:focus:border-blue-400 dark:focus:ring-blue-400/20"
                                            placeholder="{{ __('john@example.com') }}"
                                        />
                                        @error('email')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div>
                                    <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">
                                        {{ __('Phone Number') }}
                                    </label>
                                    <input
                                        type="tel"
                                        wire:model="phone"
                                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 transition-all duration-200 placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/20 dark:border-slate-600 dark:bg-slate-700 dark:text-white dark:placeholder:text-slate-500 dark:focus:border-blue-400 dark:focus:ring-blue-400/20"
                                        placeholder="{{ __('(555) 123-4567 (Optional)') }}"
                                    />
                                    @error('phone')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">
                                        {{ __('Message') }} <span class="text-red-500">*</span>
                                    </label>
                                    <textarea
                                        wire:model="message"
                                        rows="5"
                                        required
                                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 transition-all duration-200 placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/20 dark:border-slate-600 dark:bg-slate-700 dark:text-white dark:placeholder:text-slate-500 dark:focus:border-blue-400 dark:focus:ring-blue-400/20"
                                        placeholder="{{ __('Please describe your situation and how we can help you...') }}"
                                    ></textarea>
                                    @error('message')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <button
                                    type="submit"
                                    wire:loading.attr="disabled"
                                    class="group inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 to-cyan-600 px-8 py-4 font-semibold text-white shadow-lg shadow-blue-500/30 transition-all duration-300 hover:scale-105 hover:shadow-xl disabled:cursor-not-allowed disabled:opacity-70"
                                >
                                    <span wire:loading.remove>{{ __('Send Message') }}</span>
                                    <span wire:loading>{{ __('Sending...') }}</span>
                                    <svg wire:loading.remove class="h-5 w-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                    </svg>
                                    <svg wire:loading class="h-5 w-5 animate-spin" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="bg-slate-50 py-24 dark:bg-slate-900/50 lg:py-32">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div
                x-data="{ shown: false }"
                x-init="setTimeout(() => shown = true, 100)"
                class="text-center"
            >
                <p
                    x-show="shown"
                    x-transition:enter="transition ease-out duration-700"
                    x-transition:enter-start="opacity-0 -translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="text-sm font-semibold uppercase tracking-widest text-blue-600 dark:text-blue-400"
                >{{ __('FAQ') }}</p>
                <h2
                    x-show="shown"
                    x-transition:enter="transition ease-out duration-700 delay-150"
                    x-transition:enter-start="opacity-0 -translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="mt-4 text-3xl font-bold tracking-tight text-slate-900 dark:text-white sm:text-4xl"
                >{{ __('Frequently Asked Questions') }}</h2>
            </div>

            <div class="mx-auto mt-16 max-w-3xl space-y-6">
                <div
                    x-data="{ shown: false, open: false }"
                    x-init="setTimeout(() => shown = true, 200)"
                    x-show="shown"
                    x-transition:enter="transition ease-out duration-500"
                    x-transition:enter-start="opacity-0 translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="group overflow-hidden rounded-2xl border border-slate-200 bg-white transition-all duration-300 hover:shadow-lg dark:border-slate-700 dark:bg-slate-800"
                >
                    <button
                        @click="open = !open"
                        class="flex w-full items-center justify-between p-6 text-left"
                    >
                        <h3 class="font-semibold text-slate-900 dark:text-white">{{ __('Is your service really free?') }}</h3>
                        <svg
                            class="h-5 w-5 flex-shrink-0 text-slate-400 transition-transform duration-300"
                            :class="open ? 'rotate-180' : ''"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open" x-collapse>
                        <div class="border-t border-slate-200 px-6 pb-6 pt-4 dark:border-slate-700">
                            <p class="leading-relaxed text-slate-600 dark:text-slate-400">{{ __('Yes, all of our housing counseling services are completely free. We are a HUD-approved agency funded to help homeowners in need.') }}</p>
                        </div>
                    </div>
                </div>

                <div
                    x-data="{ shown: false, open: false }"
                    x-init="setTimeout(() => shown = true, 300)"
                    x-show="shown"
                    x-transition:enter="transition ease-out duration-500"
                    x-transition:enter-start="opacity-0 translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="group overflow-hidden rounded-2xl border border-slate-200 bg-white transition-all duration-300 hover:shadow-lg dark:border-slate-700 dark:bg-slate-800"
                >
                    <button
                        @click="open = !open"
                        class="flex w-full items-center justify-between p-6 text-left"
                    >
                        <h3 class="font-semibold text-slate-900 dark:text-white">{{ __('Is my information kept confidential?') }}</h3>
                        <svg
                            class="h-5 w-5 flex-shrink-0 text-slate-400 transition-transform duration-300"
                            :class="open ? 'rotate-180' : ''"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open" x-collapse>
                        <div class="border-t border-slate-200 px-6 pb-6 pt-4 dark:border-slate-700">
                            <p class="leading-relaxed text-slate-600 dark:text-slate-400">{{ __('Absolutely. We maintain strict confidentiality and never share your personal information with third parties without your consent.') }}</p>
                        </div>
                    </div>
                </div>

                <div
                    x-data="{ shown: false, open: false }"
                    x-init="setTimeout(() => shown = true, 400)"
                    x-show="shown"
                    x-transition:enter="transition ease-out duration-500"
                    x-transition:enter-start="opacity-0 translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="group overflow-hidden rounded-2xl border border-slate-200 bg-white transition-all duration-300 hover:shadow-lg dark:border-slate-700 dark:bg-slate-800"
                >
                    <button
                        @click="open = !open"
                        class="flex w-full items-center justify-between p-6 text-left"
                    >
                        <h3 class="font-semibold text-slate-900 dark:text-white">{{ __('How quickly can I get help?') }}</h3>
                        <svg
                            class="h-5 w-5 flex-shrink-0 text-slate-400 transition-transform duration-300"
                            :class="open ? 'rotate-180' : ''"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open" x-collapse>
                        <div class="border-t border-slate-200 px-6 pb-6 pt-4 dark:border-slate-700">
                            <p class="leading-relaxed text-slate-600 dark:text-slate-400">{{ __('We typically respond within 24-48 hours. If your situation is urgent, please call us directly for immediate assistance.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="relative bg-white py-24 dark:bg-slate-900 lg:py-32">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 p-12 text-center shadow-2xl lg:p-16">
                <!-- Background Pattern -->
                <div class="absolute inset-0 opacity-10">
                    <svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <pattern id="contact-cta-pattern" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                                <circle cx="20" cy="20" r="1" fill="white"/>
                            </pattern>
                        </defs>
                        <rect width="100%" height="100%" fill="url(#contact-cta-pattern)"/>
                    </svg>
                </div>

                <!-- Gradient Orbs -->
                <div class="absolute -left-20 -top-20 h-80 w-80 rounded-full bg-blue-500/30 blur-3xl"></div>
                <div class="absolute -bottom-20 -right-20 h-80 w-80 rounded-full bg-cyan-500/30 blur-3xl"></div>

                <div class="relative">
                    <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">{{ __('Prefer to Talk on the Phone?') }}</h2>
                    <p class="mx-auto mt-6 max-w-2xl text-lg leading-relaxed text-blue-100">{{ __('Our housing counselors are available during business hours to speak with you directly. Call now for immediate assistance.') }}</p>
                    @if($phonePrimary)
                        <div class="mt-10">
                            <a
                                href="tel:{{ preg_replace('/[^0-9+]/', '', $phonePrimary) }}"
                                class="group inline-flex items-center gap-3 rounded-xl bg-white px-8 py-4 text-lg font-semibold text-slate-900 shadow-lg shadow-white/25 transition-all duration-300 hover:scale-105 hover:shadow-xl"
                            >
                                <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                {{ $phonePrimary }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
