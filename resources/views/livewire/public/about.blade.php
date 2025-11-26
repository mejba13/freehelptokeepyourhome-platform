<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new
#[Layout('components.layouts.public')]
#[Title('About Us')]
class extends Component {
    //
}; ?>

<div class="overflow-hidden">
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 py-24 lg:py-32">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-[0.03]">
            <svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="about-hero-pattern" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                        <circle cx="20" cy="20" r="1" fill="white"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#about-hero-pattern)"/>
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
                >{{ __('About Us') }}</p>
                <h1
                    x-show="shown"
                    x-transition:enter="transition ease-out duration-700 delay-150"
                    x-transition:enter-start="opacity-0 -translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="mt-4 text-4xl font-bold tracking-tight text-white sm:text-5xl lg:text-6xl"
                >{{ __('Helping Families Keep Their Homes') }}</h1>
                <p
                    x-show="shown"
                    x-transition:enter="transition ease-out duration-700 delay-300"
                    x-transition:enter-start="opacity-0 -translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="mt-6 text-lg leading-relaxed text-slate-300"
                >{{ __('Since 2008, we\'ve been dedicated to providing free, confidential housing counseling to families facing foreclosure.') }}</p>
            </div>
        </div>
    </section>

    <!-- Mission & Values -->
    <section class="relative bg-white py-24 dark:bg-slate-900 lg:py-32">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-16 lg:grid-cols-2 lg:items-start">
                <!-- Mission -->
                <div>
                    <p class="text-sm font-semibold uppercase tracking-widest text-blue-600 dark:text-blue-400">{{ __('Our Mission') }}</p>
                    <h2 class="mt-4 text-3xl font-bold tracking-tight text-slate-900 dark:text-white sm:text-4xl">{{ __('Everyone Deserves a Home') }}</h2>
                    <div class="mt-6 space-y-6 text-lg leading-relaxed text-slate-600 dark:text-slate-400">
                        <p>{{ __('We believe that everyone deserves the opportunity to keep their home. Our mission is to provide free, confidential housing counseling to help families avoid foreclosure and achieve long-term housing stability.') }}</p>
                        <p>{{ __('As a HUD-approved housing counseling agency, we work directly with homeowners to explore all available options and advocate on their behalf with lenders and servicers.') }}</p>
                    </div>

                    <!-- Stats -->
                    <div class="mt-12 grid grid-cols-3 gap-8">
                        <div class="text-center">
                            <p class="text-4xl font-bold text-blue-600">10K+</p>
                            <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">{{ __('Families Helped') }}</p>
                        </div>
                        <div class="text-center">
                            <p class="text-4xl font-bold text-blue-600">15+</p>
                            <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">{{ __('Years Experience') }}</p>
                        </div>
                        <div class="text-center">
                            <p class="text-4xl font-bold text-blue-600">98%</p>
                            <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">{{ __('Success Rate') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Values Card -->
                <div class="relative">
                    <div class="absolute -right-4 -top-4 h-72 w-72 rounded-full bg-blue-500/10 blur-3xl"></div>
                    <div class="relative rounded-3xl border border-slate-200 bg-slate-50 p-8 dark:border-slate-700 dark:bg-slate-800 lg:p-10">
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white">{{ __('Our Core Values') }}</h3>
                        <div class="mt-8 space-y-6">
                            <div class="flex items-start gap-4">
                                <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 shadow-lg shadow-blue-500/30">
                                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-slate-900 dark:text-white">{{ __('Compassion') }}</h4>
                                    <p class="mt-1 text-slate-600 dark:text-slate-400">{{ __('We treat every client with dignity, empathy, and understanding.') }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600 shadow-lg shadow-emerald-500/30">
                                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-slate-900 dark:text-white">{{ __('Integrity') }}</h4>
                                    <p class="mt-1 text-slate-600 dark:text-slate-400">{{ __('We provide honest, unbiased advice with no hidden agendas.') }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-amber-500 to-amber-600 shadow-lg shadow-amber-500/30">
                                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-slate-900 dark:text-white">{{ __('Empowerment') }}</h4>
                                    <p class="mt-1 text-slate-600 dark:text-slate-400">{{ __('We educate and empower homeowners to make informed decisions.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- HUD Certification -->
    <section class="relative bg-slate-50 py-24 dark:bg-slate-900/50 lg:py-32">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 p-12 lg:p-16">
                <!-- Background Pattern -->
                <div class="absolute inset-0 opacity-10">
                    <svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <pattern id="hud-pattern" x="0" y="0" width="60" height="60" patternUnits="userSpaceOnUse">
                                <path d="M60 0H0v60" fill="none" stroke="white" stroke-width="0.5"/>
                            </pattern>
                        </defs>
                        <rect width="100%" height="100%" fill="url(#hud-pattern)"/>
                    </svg>
                </div>

                <!-- Gradient Orbs -->
                <div class="absolute -left-20 -top-20 h-80 w-80 rounded-full bg-blue-500/30 blur-3xl"></div>
                <div class="absolute -bottom-20 -right-20 h-80 w-80 rounded-full bg-cyan-500/30 blur-3xl"></div>

                <div class="relative flex flex-col items-center text-center">
                    <div class="flex h-20 w-20 items-center justify-center rounded-2xl bg-white/10 backdrop-blur-sm">
                        <svg class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h2 class="mt-8 text-3xl font-bold tracking-tight text-white sm:text-4xl">{{ __('HUD-Approved Counseling Agency') }}</h2>
                    <p class="mx-auto mt-6 max-w-3xl text-lg leading-relaxed text-blue-100">{{ __('We are approved by the U.S. Department of Housing and Urban Development to provide housing counseling services. This means our counselors are certified, our services meet federal standards, and we are held to the highest ethical guidelines.') }}</p>
                    <div class="mt-10 flex flex-wrap items-center justify-center gap-8">
                        <div class="flex items-center gap-3 rounded-xl bg-white/10 px-6 py-3 backdrop-blur-sm">
                            <svg class="h-6 w-6 text-emerald-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-white">{{ __('Certified Counselors') }}</span>
                        </div>
                        <div class="flex items-center gap-3 rounded-xl bg-white/10 px-6 py-3 backdrop-blur-sm">
                            <svg class="h-6 w-6 text-emerald-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-white">{{ __('Federal Standards') }}</span>
                        </div>
                        <div class="flex items-center gap-3 rounded-xl bg-white/10 px-6 py-3 backdrop-blur-sm">
                            <svg class="h-6 w-6 text-emerald-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-white">{{ __('Ethical Guidelines') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- What We Do -->
    <section class="bg-white py-24 dark:bg-slate-900 lg:py-32">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="mx-auto max-w-3xl text-center">
                <p class="text-sm font-semibold uppercase tracking-widest text-blue-600 dark:text-blue-400">{{ __('What We Do') }}</p>
                <h2 class="mt-4 text-3xl font-bold tracking-tight text-slate-900 dark:text-white sm:text-4xl">{{ __('Comprehensive Housing Support') }}</h2>
                <p class="mt-6 text-lg leading-relaxed text-slate-600 dark:text-slate-400">{{ __('Our services help homeowners at every stage of the foreclosure prevention process.') }}</p>
            </div>

            <!-- Services Grid -->
            <div class="mt-16 grid gap-8 md:grid-cols-2">
                <div class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-8 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl dark:border-slate-700 dark:bg-slate-800">
                    <div class="absolute -right-20 -top-20 h-40 w-40 rounded-full bg-blue-500/10 transition-transform duration-500 group-hover:scale-150"></div>
                    <div class="relative">
                        <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 shadow-lg shadow-blue-500/30">
                            <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <h3 class="mt-6 text-xl font-bold text-slate-900 dark:text-white">{{ __('Free Consultations') }}</h3>
                        <p class="mt-3 leading-relaxed text-slate-600 dark:text-slate-400">{{ __('Speak with a certified housing counselor to understand your situation and explore your options at no cost.') }}</p>
                    </div>
                </div>

                <div class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-8 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl dark:border-slate-700 dark:bg-slate-800">
                    <div class="absolute -right-20 -top-20 h-40 w-40 rounded-full bg-emerald-500/10 transition-transform duration-500 group-hover:scale-150"></div>
                    <div class="relative">
                        <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600 shadow-lg shadow-emerald-500/30">
                            <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <h3 class="mt-6 text-xl font-bold text-slate-900 dark:text-white">{{ __('Document Preparation') }}</h3>
                        <p class="mt-3 leading-relaxed text-slate-600 dark:text-slate-400">{{ __('We help you gather and prepare all necessary documentation for loan modification and loss mitigation applications.') }}</p>
                    </div>
                </div>

                <div class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-8 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl dark:border-slate-700 dark:bg-slate-800">
                    <div class="absolute -right-20 -top-20 h-40 w-40 rounded-full bg-amber-500/10 transition-transform duration-500 group-hover:scale-150"></div>
                    <div class="relative">
                        <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-gradient-to-br from-amber-500 to-amber-600 shadow-lg shadow-amber-500/30">
                            <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                        </div>
                        <h3 class="mt-6 text-xl font-bold text-slate-900 dark:text-white">{{ __('Lender Negotiations') }}</h3>
                        <p class="mt-3 leading-relaxed text-slate-600 dark:text-slate-400">{{ __('Our counselors advocate on your behalf with lenders and servicers to find solutions that work for you.') }}</p>
                    </div>
                </div>

                <div class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-8 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl dark:border-slate-700 dark:bg-slate-800">
                    <div class="absolute -right-20 -top-20 h-40 w-40 rounded-full bg-purple-500/10 transition-transform duration-500 group-hover:scale-150"></div>
                    <div class="relative">
                        <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-gradient-to-br from-purple-500 to-purple-600 shadow-lg shadow-purple-500/30">
                            <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <h3 class="mt-6 text-xl font-bold text-slate-900 dark:text-white">{{ __('Financial Education') }}</h3>
                        <p class="mt-3 leading-relaxed text-slate-600 dark:text-slate-400">{{ __('Learn budgeting skills and financial strategies to maintain your housing stability long-term.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="relative bg-slate-50 py-24 dark:bg-slate-900/50 lg:py-32">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 p-12 text-center shadow-2xl lg:p-16">
                <!-- Background Pattern -->
                <div class="absolute inset-0 opacity-10">
                    <svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <pattern id="about-cta-pattern" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                                <circle cx="20" cy="20" r="1" fill="white"/>
                            </pattern>
                        </defs>
                        <rect width="100%" height="100%" fill="url(#about-cta-pattern)"/>
                    </svg>
                </div>

                <!-- Gradient Orbs -->
                <div class="absolute -left-20 -top-20 h-80 w-80 rounded-full bg-blue-500/30 blur-3xl"></div>
                <div class="absolute -bottom-20 -right-20 h-80 w-80 rounded-full bg-cyan-500/30 blur-3xl"></div>

                <div class="relative">
                    <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">{{ __('Ready to Get Started?') }}</h2>
                    <p class="mx-auto mt-6 max-w-2xl text-lg leading-relaxed text-blue-100">{{ __('Contact us today to schedule your free consultation with a certified housing counselor.') }}</p>
                    <div class="mt-10">
                        <a
                            href="{{ route('contact') }}"
                            wire:navigate
                            class="group inline-flex items-center gap-2 rounded-xl bg-white px-8 py-4 text-base font-semibold text-slate-900 shadow-lg shadow-white/25 transition-all duration-300 hover:scale-105 hover:shadow-xl"
                        >
                            {{ __('Contact Us Today') }}
                            <svg class="h-5 w-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
