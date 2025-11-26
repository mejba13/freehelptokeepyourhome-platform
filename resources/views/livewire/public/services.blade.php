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

<div>
    <!-- Hero -->
    <section class="bg-gradient-to-br from-blue-600 to-blue-800 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-bold text-white sm:text-5xl">{{ __('Our Services') }}</h1>
                <p class="mx-auto mt-4 max-w-2xl text-xl text-blue-100">{{ __('Free, confidential housing counseling to help you keep your home.') }}</p>
            </div>
        </div>
    </section>

    <!-- Services List -->
    <section class="py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="space-y-16">
                <!-- Foreclosure Prevention -->
                <div class="grid gap-8 lg:grid-cols-2 lg:items-center">
                    <div>
                        <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-blue-100 text-blue-600 dark:bg-blue-900/30">
                            <x-flux::icon name="shield-check" class="h-7 w-7" />
                        </div>
                        <h2 class="mt-6 text-2xl font-bold text-zinc-900 dark:text-white">{{ __('Foreclosure Prevention') }}</h2>
                        <p class="mt-4 text-lg text-zinc-600 dark:text-zinc-400">{{ __('If you\'re behind on your mortgage or facing foreclosure, we can help you explore all available options to keep your home.') }}</p>
                        <ul class="mt-6 space-y-3">
                            <li class="flex items-start gap-3">
                                <x-flux::icon name="check" class="mt-1 h-5 w-5 flex-shrink-0 text-blue-600" />
                                <span class="text-zinc-600 dark:text-zinc-400">{{ __('Review your mortgage documents and financial situation') }}</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <x-flux::icon name="check" class="mt-1 h-5 w-5 flex-shrink-0 text-blue-600" />
                                <span class="text-zinc-600 dark:text-zinc-400">{{ __('Explain your rights and options under federal and state law') }}</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <x-flux::icon name="check" class="mt-1 h-5 w-5 flex-shrink-0 text-blue-600" />
                                <span class="text-zinc-600 dark:text-zinc-400">{{ __('Help you communicate with your lender or servicer') }}</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <x-flux::icon name="check" class="mt-1 h-5 w-5 flex-shrink-0 text-blue-600" />
                                <span class="text-zinc-600 dark:text-zinc-400">{{ __('Connect you with legal resources if needed') }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="rounded-xl bg-zinc-100 p-8 dark:bg-zinc-800">
                        <p class="text-lg font-medium text-zinc-900 dark:text-white">{{ __('Warning Signs You May Need Help:') }}</p>
                        <ul class="mt-4 space-y-2 text-zinc-600 dark:text-zinc-400">
                            <li>{{ __('You\'ve received a notice of default') }}</li>
                            <li>{{ __('You\'re 30+ days behind on payments') }}</li>
                            <li>{{ __('Your income has decreased or expenses increased') }}</li>
                            <li>{{ __('You\'re considering using savings or retirement to pay mortgage') }}</li>
                        </ul>
                    </div>
                </div>

                <hr class="border-zinc-200 dark:border-zinc-800" />

                <!-- Loan Modification -->
                <div class="grid gap-8 lg:grid-cols-2 lg:items-center">
                    <div class="lg:order-2">
                        <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-green-100 text-green-600 dark:bg-green-900/30">
                            <x-flux::icon name="banknotes" class="h-7 w-7" />
                        </div>
                        <h2 class="mt-6 text-2xl font-bold text-zinc-900 dark:text-white">{{ __('Loan Modification Assistance') }}</h2>
                        <p class="mt-4 text-lg text-zinc-600 dark:text-zinc-400">{{ __('A loan modification can permanently change the terms of your mortgage to make payments more affordable.') }}</p>
                        <ul class="mt-6 space-y-3">
                            <li class="flex items-start gap-3">
                                <x-flux::icon name="check" class="mt-1 h-5 w-5 flex-shrink-0 text-green-600" />
                                <span class="text-zinc-600 dark:text-zinc-400">{{ __('Prepare and submit your complete application package') }}</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <x-flux::icon name="check" class="mt-1 h-5 w-5 flex-shrink-0 text-green-600" />
                                <span class="text-zinc-600 dark:text-zinc-400">{{ __('Gather and organize all required documentation') }}</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <x-flux::icon name="check" class="mt-1 h-5 w-5 flex-shrink-0 text-green-600" />
                                <span class="text-zinc-600 dark:text-zinc-400">{{ __('Follow up with your lender to ensure timely processing') }}</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <x-flux::icon name="check" class="mt-1 h-5 w-5 flex-shrink-0 text-green-600" />
                                <span class="text-zinc-600 dark:text-zinc-400">{{ __('Appeal denied applications when appropriate') }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="rounded-xl bg-zinc-100 p-8 dark:bg-zinc-800 lg:order-1">
                        <p class="text-lg font-medium text-zinc-900 dark:text-white">{{ __('Possible Modification Options:') }}</p>
                        <ul class="mt-4 space-y-2 text-zinc-600 dark:text-zinc-400">
                            <li>{{ __('Interest rate reduction') }}</li>
                            <li>{{ __('Extended loan term') }}</li>
                            <li>{{ __('Principal forbearance') }}</li>
                            <li>{{ __('Capitalization of arrears') }}</li>
                        </ul>
                    </div>
                </div>

                <hr class="border-zinc-200 dark:border-zinc-800" />

                <!-- Budget Counseling -->
                <div class="grid gap-8 lg:grid-cols-2 lg:items-center">
                    <div>
                        <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-amber-100 text-amber-600 dark:bg-amber-900/30">
                            <x-flux::icon name="calculator" class="h-7 w-7" />
                        </div>
                        <h2 class="mt-6 text-2xl font-bold text-zinc-900 dark:text-white">{{ __('Budget Counseling') }}</h2>
                        <p class="mt-4 text-lg text-zinc-600 dark:text-zinc-400">{{ __('Learn to manage your finances effectively and create a sustainable plan to maintain your housing stability.') }}</p>
                        <ul class="mt-6 space-y-3">
                            <li class="flex items-start gap-3">
                                <x-flux::icon name="check" class="mt-1 h-5 w-5 flex-shrink-0 text-amber-600" />
                                <span class="text-zinc-600 dark:text-zinc-400">{{ __('Analyze your income, expenses, and debt') }}</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <x-flux::icon name="check" class="mt-1 h-5 w-5 flex-shrink-0 text-amber-600" />
                                <span class="text-zinc-600 dark:text-zinc-400">{{ __('Create a personalized spending plan') }}</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <x-flux::icon name="check" class="mt-1 h-5 w-5 flex-shrink-0 text-amber-600" />
                                <span class="text-zinc-600 dark:text-zinc-400">{{ __('Identify areas to reduce expenses') }}</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <x-flux::icon name="check" class="mt-1 h-5 w-5 flex-shrink-0 text-amber-600" />
                                <span class="text-zinc-600 dark:text-zinc-400">{{ __('Develop strategies to increase income') }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="rounded-xl bg-zinc-100 p-8 dark:bg-zinc-800">
                        <p class="text-lg font-medium text-zinc-900 dark:text-white">{{ __('Financial Tools We Provide:') }}</p>
                        <ul class="mt-4 space-y-2 text-zinc-600 dark:text-zinc-400">
                            <li>{{ __('Budget worksheets and templates') }}</li>
                            <li>{{ __('Debt management strategies') }}</li>
                            <li>{{ __('Emergency fund planning') }}</li>
                            <li>{{ __('Credit improvement guidance') }}</li>
                        </ul>
                    </div>
                </div>

                <hr class="border-zinc-200 dark:border-zinc-800" />

                <!-- Additional Services -->
                <div>
                    <h2 class="text-2xl font-bold text-zinc-900 dark:text-white">{{ __('Additional Services') }}</h2>
                    <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        <div class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
                            <x-flux::icon name="home-modern" class="h-8 w-8 text-blue-600" />
                            <h3 class="mt-4 font-semibold text-zinc-900 dark:text-white">{{ __('Pre-Purchase Counseling') }}</h3>
                            <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">{{ __('Prepare for homeownership with guidance on the buying process and responsibilities.') }}</p>
                        </div>
                        <div class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
                            <x-flux::icon name="arrow-trending-down" class="h-8 w-8 text-blue-600" />
                            <h3 class="mt-4 font-semibold text-zinc-900 dark:text-white">{{ __('Reverse Mortgage Counseling') }}</h3>
                            <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">{{ __('Understand the pros and cons of reverse mortgages before making a decision.') }}</p>
                        </div>
                        <div class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
                            <x-flux::icon name="scale" class="h-8 w-8 text-blue-600" />
                            <h3 class="mt-4 font-semibold text-zinc-900 dark:text-white">{{ __('Rental Assistance') }}</h3>
                            <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">{{ __('Help navigating rental assistance programs and tenant rights.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="bg-blue-600 py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-bold text-white">{{ __('Get Started Today') }}</h2>
                <p class="mx-auto mt-4 max-w-xl text-blue-100">{{ __('All of our services are free and confidential. Contact us to schedule your consultation.') }}</p>
                <div class="mt-8">
                    <flux:button variant="primary" :href="route('contact')" wire:navigate class="bg-white text-blue-600 hover:bg-blue-50">{{ __('Schedule a Consultation') }}</flux:button>
                </div>
            </div>
        </div>
    </section>
</div>
