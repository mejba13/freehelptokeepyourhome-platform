<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new
#[Layout('components.layouts.public')]
#[Title('Our Services')]
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
                    <pattern id="services-hero-pattern" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                        <circle cx="20" cy="20" r="1" fill="white"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#services-hero-pattern)"/>
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
                >{{ __('Our Services') }}</p>
                <h1
                    x-show="shown"
                    x-transition:enter="transition ease-out duration-700 delay-150"
                    x-transition:enter-start="opacity-0 -translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="mt-4 text-4xl font-bold tracking-tight text-white sm:text-5xl lg:text-6xl"
                >{{ __('Free Housing Counseling Services') }}</h1>
                <p
                    x-show="shown"
                    x-transition:enter="transition ease-out duration-700 delay-300"
                    x-transition:enter-start="opacity-0 -translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="mt-6 text-lg leading-relaxed text-slate-300"
                >{{ __('Comprehensive, confidential support to help you navigate financial challenges and keep your home.') }}</p>
            </div>
        </div>
    </section>

    <!-- Services List -->
    <section class="bg-white py-24 dark:bg-slate-900 lg:py-32">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="space-y-24 lg:space-y-32">
                <!-- Foreclosure Prevention -->
                <div class="grid items-center gap-12 lg:grid-cols-2 lg:gap-16">
                    <div>
                        <div class="inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-4 py-2 dark:border-blue-800 dark:bg-blue-900/30">
                            <span class="flex h-2 w-2 rounded-full bg-blue-600"></span>
                            <span class="text-sm font-medium text-blue-700 dark:text-blue-300">{{ __('Core Service') }}</span>
                        </div>
                        <h2 class="mt-6 text-3xl font-bold tracking-tight text-slate-900 dark:text-white sm:text-4xl">{{ __('Foreclosure Prevention') }}</h2>
                        <p class="mt-4 text-lg leading-relaxed text-slate-600 dark:text-slate-400">{{ __('If you\'re behind on your mortgage or facing foreclosure, we can help you explore all available options to keep your home.') }}</p>
                        <ul class="mt-8 space-y-4">
                            <li class="flex items-start gap-4">
                                <div class="flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900/30">
                                    <svg class="h-4 w-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <span class="text-slate-600 dark:text-slate-400">{{ __('Review your mortgage documents and financial situation') }}</span>
                            </li>
                            <li class="flex items-start gap-4">
                                <div class="flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900/30">
                                    <svg class="h-4 w-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <span class="text-slate-600 dark:text-slate-400">{{ __('Explain your rights and options under federal and state law') }}</span>
                            </li>
                            <li class="flex items-start gap-4">
                                <div class="flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900/30">
                                    <svg class="h-4 w-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <span class="text-slate-600 dark:text-slate-400">{{ __('Help you communicate with your lender or servicer') }}</span>
                            </li>
                            <li class="flex items-start gap-4">
                                <div class="flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900/30">
                                    <svg class="h-4 w-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <span class="text-slate-600 dark:text-slate-400">{{ __('Connect you with legal resources if needed') }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="relative">
                        <div class="absolute -right-4 -top-4 h-72 w-72 rounded-full bg-blue-500/10 blur-3xl"></div>
                        <div class="relative rounded-2xl border border-slate-200 bg-slate-50 p-8 dark:border-slate-700 dark:bg-slate-800">
                            <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-gradient-to-br from-red-500 to-red-600 shadow-lg shadow-red-500/30">
                                <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                            </div>
                            <h3 class="mt-6 text-lg font-bold text-slate-900 dark:text-white">{{ __('Warning Signs You May Need Help') }}</h3>
                            <ul class="mt-4 space-y-3">
                                <li class="flex items-center gap-3 text-slate-600 dark:text-slate-400">
                                    <span class="h-1.5 w-1.5 flex-shrink-0 rounded-full bg-red-500"></span>
                                    {{ __('You\'ve received a notice of default') }}
                                </li>
                                <li class="flex items-center gap-3 text-slate-600 dark:text-slate-400">
                                    <span class="h-1.5 w-1.5 flex-shrink-0 rounded-full bg-red-500"></span>
                                    {{ __('You\'re 30+ days behind on payments') }}
                                </li>
                                <li class="flex items-center gap-3 text-slate-600 dark:text-slate-400">
                                    <span class="h-1.5 w-1.5 flex-shrink-0 rounded-full bg-red-500"></span>
                                    {{ __('Your income has decreased significantly') }}
                                </li>
                                <li class="flex items-center gap-3 text-slate-600 dark:text-slate-400">
                                    <span class="h-1.5 w-1.5 flex-shrink-0 rounded-full bg-red-500"></span>
                                    {{ __('Considering using savings or retirement funds') }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Divider -->
                <div class="flex items-center gap-4">
                    <div class="h-px flex-1 bg-gradient-to-r from-transparent via-slate-300 to-transparent dark:via-slate-700"></div>
                </div>

                <!-- Loan Modification -->
                <div class="grid items-center gap-12 lg:grid-cols-2 lg:gap-16">
                    <div class="lg:order-2">
                        <div class="inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-4 py-2 dark:border-emerald-800 dark:bg-emerald-900/30">
                            <span class="flex h-2 w-2 rounded-full bg-emerald-600"></span>
                            <span class="text-sm font-medium text-emerald-700 dark:text-emerald-300">{{ __('Most Popular') }}</span>
                        </div>
                        <h2 class="mt-6 text-3xl font-bold tracking-tight text-slate-900 dark:text-white sm:text-4xl">{{ __('Loan Modification Assistance') }}</h2>
                        <p class="mt-4 text-lg leading-relaxed text-slate-600 dark:text-slate-400">{{ __('A loan modification can permanently change the terms of your mortgage to make payments more affordable.') }}</p>
                        <ul class="mt-8 space-y-4">
                            <li class="flex items-start gap-4">
                                <div class="flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-full bg-emerald-100 dark:bg-emerald-900/30">
                                    <svg class="h-4 w-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <span class="text-slate-600 dark:text-slate-400">{{ __('Prepare and submit your complete application package') }}</span>
                            </li>
                            <li class="flex items-start gap-4">
                                <div class="flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-full bg-emerald-100 dark:bg-emerald-900/30">
                                    <svg class="h-4 w-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <span class="text-slate-600 dark:text-slate-400">{{ __('Gather and organize all required documentation') }}</span>
                            </li>
                            <li class="flex items-start gap-4">
                                <div class="flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-full bg-emerald-100 dark:bg-emerald-900/30">
                                    <svg class="h-4 w-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <span class="text-slate-600 dark:text-slate-400">{{ __('Follow up with your lender to ensure timely processing') }}</span>
                            </li>
                            <li class="flex items-start gap-4">
                                <div class="flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-full bg-emerald-100 dark:bg-emerald-900/30">
                                    <svg class="h-4 w-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <span class="text-slate-600 dark:text-slate-400">{{ __('Appeal denied applications when appropriate') }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="relative lg:order-1">
                        <div class="absolute -left-4 -top-4 h-72 w-72 rounded-full bg-emerald-500/10 blur-3xl"></div>
                        <div class="relative rounded-2xl border border-slate-200 bg-slate-50 p-8 dark:border-slate-700 dark:bg-slate-800">
                            <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600 shadow-lg shadow-emerald-500/30">
                                <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h3 class="mt-6 text-lg font-bold text-slate-900 dark:text-white">{{ __('Possible Modification Options') }}</h3>
                            <ul class="mt-4 space-y-3">
                                <li class="flex items-center gap-3 text-slate-600 dark:text-slate-400">
                                    <span class="h-1.5 w-1.5 flex-shrink-0 rounded-full bg-emerald-500"></span>
                                    {{ __('Interest rate reduction') }}
                                </li>
                                <li class="flex items-center gap-3 text-slate-600 dark:text-slate-400">
                                    <span class="h-1.5 w-1.5 flex-shrink-0 rounded-full bg-emerald-500"></span>
                                    {{ __('Extended loan term') }}
                                </li>
                                <li class="flex items-center gap-3 text-slate-600 dark:text-slate-400">
                                    <span class="h-1.5 w-1.5 flex-shrink-0 rounded-full bg-emerald-500"></span>
                                    {{ __('Principal forbearance') }}
                                </li>
                                <li class="flex items-center gap-3 text-slate-600 dark:text-slate-400">
                                    <span class="h-1.5 w-1.5 flex-shrink-0 rounded-full bg-emerald-500"></span>
                                    {{ __('Capitalization of arrears') }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Divider -->
                <div class="flex items-center gap-4">
                    <div class="h-px flex-1 bg-gradient-to-r from-transparent via-slate-300 to-transparent dark:via-slate-700"></div>
                </div>

                <!-- Budget Counseling -->
                <div class="grid items-center gap-12 lg:grid-cols-2 lg:gap-16">
                    <div>
                        <div class="inline-flex items-center gap-2 rounded-full border border-amber-200 bg-amber-50 px-4 py-2 dark:border-amber-800 dark:bg-amber-900/30">
                            <span class="flex h-2 w-2 rounded-full bg-amber-600"></span>
                            <span class="text-sm font-medium text-amber-700 dark:text-amber-300">{{ __('Financial Wellness') }}</span>
                        </div>
                        <h2 class="mt-6 text-3xl font-bold tracking-tight text-slate-900 dark:text-white sm:text-4xl">{{ __('Budget Counseling') }}</h2>
                        <p class="mt-4 text-lg leading-relaxed text-slate-600 dark:text-slate-400">{{ __('Learn to manage your finances effectively and create a sustainable plan to maintain your housing stability.') }}</p>
                        <ul class="mt-8 space-y-4">
                            <li class="flex items-start gap-4">
                                <div class="flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-full bg-amber-100 dark:bg-amber-900/30">
                                    <svg class="h-4 w-4 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <span class="text-slate-600 dark:text-slate-400">{{ __('Analyze your income, expenses, and debt') }}</span>
                            </li>
                            <li class="flex items-start gap-4">
                                <div class="flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-full bg-amber-100 dark:bg-amber-900/30">
                                    <svg class="h-4 w-4 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <span class="text-slate-600 dark:text-slate-400">{{ __('Create a personalized spending plan') }}</span>
                            </li>
                            <li class="flex items-start gap-4">
                                <div class="flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-full bg-amber-100 dark:bg-amber-900/30">
                                    <svg class="h-4 w-4 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <span class="text-slate-600 dark:text-slate-400">{{ __('Identify areas to reduce expenses') }}</span>
                            </li>
                            <li class="flex items-start gap-4">
                                <div class="flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-full bg-amber-100 dark:bg-amber-900/30">
                                    <svg class="h-4 w-4 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <span class="text-slate-600 dark:text-slate-400">{{ __('Develop strategies to increase income') }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="relative">
                        <div class="absolute -right-4 -top-4 h-72 w-72 rounded-full bg-amber-500/10 blur-3xl"></div>
                        <div class="relative rounded-2xl border border-slate-200 bg-slate-50 p-8 dark:border-slate-700 dark:bg-slate-800">
                            <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-gradient-to-br from-amber-500 to-amber-600 shadow-lg shadow-amber-500/30">
                                <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <h3 class="mt-6 text-lg font-bold text-slate-900 dark:text-white">{{ __('Financial Tools We Provide') }}</h3>
                            <ul class="mt-4 space-y-3">
                                <li class="flex items-center gap-3 text-slate-600 dark:text-slate-400">
                                    <span class="h-1.5 w-1.5 flex-shrink-0 rounded-full bg-amber-500"></span>
                                    {{ __('Budget worksheets and templates') }}
                                </li>
                                <li class="flex items-center gap-3 text-slate-600 dark:text-slate-400">
                                    <span class="h-1.5 w-1.5 flex-shrink-0 rounded-full bg-amber-500"></span>
                                    {{ __('Debt management strategies') }}
                                </li>
                                <li class="flex items-center gap-3 text-slate-600 dark:text-slate-400">
                                    <span class="h-1.5 w-1.5 flex-shrink-0 rounded-full bg-amber-500"></span>
                                    {{ __('Emergency fund planning') }}
                                </li>
                                <li class="flex items-center gap-3 text-slate-600 dark:text-slate-400">
                                    <span class="h-1.5 w-1.5 flex-shrink-0 rounded-full bg-amber-500"></span>
                                    {{ __('Credit improvement guidance') }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Additional Services -->
    <section class="bg-slate-50 py-24 dark:bg-slate-900/50 lg:py-32">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <p class="text-sm font-semibold uppercase tracking-widest text-blue-600 dark:text-blue-400">{{ __('More Services') }}</p>
                <h2 class="mt-4 text-3xl font-bold tracking-tight text-slate-900 dark:text-white sm:text-4xl">{{ __('Additional Services') }}</h2>
                <p class="mt-6 text-lg leading-relaxed text-slate-600 dark:text-slate-400">{{ __('We offer a range of additional housing counseling services to meet your needs.') }}</p>
            </div>

            <div class="mt-16 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                <div class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-8 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl dark:border-slate-700 dark:bg-slate-800">
                    <div class="absolute -right-20 -top-20 h-40 w-40 rounded-full bg-blue-500/10 transition-transform duration-500 group-hover:scale-150"></div>
                    <div class="relative">
                        <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 shadow-lg shadow-blue-500/30">
                            <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                        </div>
                        <h3 class="mt-6 text-xl font-bold text-slate-900 dark:text-white">{{ __('Pre-Purchase Counseling') }}</h3>
                        <p class="mt-3 leading-relaxed text-slate-600 dark:text-slate-400">{{ __('Prepare for homeownership with guidance on the buying process and responsibilities of owning a home.') }}</p>
                    </div>
                </div>

                <div class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-8 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl dark:border-slate-700 dark:bg-slate-800">
                    <div class="absolute -right-20 -top-20 h-40 w-40 rounded-full bg-purple-500/10 transition-transform duration-500 group-hover:scale-150"></div>
                    <div class="relative">
                        <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-gradient-to-br from-purple-500 to-purple-600 shadow-lg shadow-purple-500/30">
                            <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="mt-6 text-xl font-bold text-slate-900 dark:text-white">{{ __('Reverse Mortgage Counseling') }}</h3>
                        <p class="mt-3 leading-relaxed text-slate-600 dark:text-slate-400">{{ __('Understand the pros and cons of reverse mortgages before making an important financial decision.') }}</p>
                    </div>
                </div>

                <div class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-8 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl dark:border-slate-700 dark:bg-slate-800">
                    <div class="absolute -right-20 -top-20 h-40 w-40 rounded-full bg-cyan-500/10 transition-transform duration-500 group-hover:scale-150"></div>
                    <div class="relative">
                        <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-gradient-to-br from-cyan-500 to-cyan-600 shadow-lg shadow-cyan-500/30">
                            <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <h3 class="mt-6 text-xl font-bold text-slate-900 dark:text-white">{{ __('Rental Assistance') }}</h3>
                        <p class="mt-3 leading-relaxed text-slate-600 dark:text-slate-400">{{ __('Get help navigating rental assistance programs and understanding your rights as a tenant.') }}</p>
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
                            <pattern id="services-cta-pattern" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                                <circle cx="20" cy="20" r="1" fill="white"/>
                            </pattern>
                        </defs>
                        <rect width="100%" height="100%" fill="url(#services-cta-pattern)"/>
                    </svg>
                </div>

                <!-- Gradient Orbs -->
                <div class="absolute -left-20 -top-20 h-80 w-80 rounded-full bg-blue-500/30 blur-3xl"></div>
                <div class="absolute -bottom-20 -right-20 h-80 w-80 rounded-full bg-cyan-500/30 blur-3xl"></div>

                <div class="relative">
                    <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">{{ __('Get Started Today') }}</h2>
                    <p class="mx-auto mt-6 max-w-2xl text-lg leading-relaxed text-blue-100">{{ __('All of our services are free and confidential. Contact us to schedule your consultation with a certified housing counselor.') }}</p>
                    <div class="mt-10">
                        <a
                            href="{{ route('contact') }}"
                            wire:navigate
                            class="group inline-flex items-center gap-2 rounded-xl bg-white px-8 py-4 text-base font-semibold text-slate-900 shadow-lg shadow-white/25 transition-all duration-300 hover:scale-105 hover:shadow-xl"
                        >
                            {{ __('Schedule a Consultation') }}
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
