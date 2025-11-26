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

<div>
    <!-- Hero -->
    <section class="bg-gradient-to-br from-blue-600 to-blue-800 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-bold text-white sm:text-5xl">{{ __('About Us') }}</h1>
                <p class="mx-auto mt-4 max-w-2xl text-xl text-blue-100">{{ __('Helping families keep their homes since 2008.') }}</p>
            </div>
        </div>
    </section>

    <!-- Mission -->
    <section class="py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-12 lg:grid-cols-2 lg:items-center">
                <div>
                    <h2 class="text-3xl font-bold text-zinc-900 dark:text-white">{{ __('Our Mission') }}</h2>
                    <p class="mt-4 text-lg text-zinc-600 dark:text-zinc-400">{{ __('We believe that everyone deserves the opportunity to keep their home. Our mission is to provide free, confidential housing counseling to help families avoid foreclosure and achieve long-term housing stability.') }}</p>
                    <p class="mt-4 text-lg text-zinc-600 dark:text-zinc-400">{{ __('As a HUD-approved housing counseling agency, we work directly with homeowners to explore all available options and advocate on their behalf with lenders and servicers.') }}</p>
                </div>
                <div class="rounded-xl bg-blue-50 p-8 dark:bg-blue-900/20">
                    <h3 class="text-xl font-semibold text-zinc-900 dark:text-white">{{ __('Our Values') }}</h3>
                    <ul class="mt-6 space-y-4">
                        <li class="flex items-start gap-3">
                            <x-flux::icon name="check-circle" class="mt-0.5 h-6 w-6 flex-shrink-0 text-blue-600" />
                            <div>
                                <span class="font-medium text-zinc-900 dark:text-white">{{ __('Compassion') }}</span>
                                <p class="text-sm text-zinc-600 dark:text-zinc-400">{{ __('We treat every client with dignity and understanding.') }}</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <x-flux::icon name="check-circle" class="mt-0.5 h-6 w-6 flex-shrink-0 text-blue-600" />
                            <div>
                                <span class="font-medium text-zinc-900 dark:text-white">{{ __('Integrity') }}</span>
                                <p class="text-sm text-zinc-600 dark:text-zinc-400">{{ __('We provide honest, unbiased advice with no hidden agendas.') }}</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <x-flux::icon name="check-circle" class="mt-0.5 h-6 w-6 flex-shrink-0 text-blue-600" />
                            <div>
                                <span class="font-medium text-zinc-900 dark:text-white">{{ __('Empowerment') }}</span>
                                <p class="text-sm text-zinc-600 dark:text-zinc-400">{{ __('We educate and empower homeowners to make informed decisions.') }}</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- HUD Certification -->
    <section class="border-y border-zinc-200 bg-zinc-50 py-16 dark:border-zinc-800 dark:bg-zinc-900">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900/30">
                    <x-flux::icon name="shield-check" class="h-8 w-8 text-blue-600" />
                </div>
                <h2 class="mt-6 text-2xl font-bold text-zinc-900 dark:text-white">{{ __('HUD-Approved Counseling Agency') }}</h2>
                <p class="mx-auto mt-4 max-w-2xl text-zinc-600 dark:text-zinc-400">{{ __('We are approved by the U.S. Department of Housing and Urban Development to provide housing counseling services. This means our counselors are certified, our services meet federal standards, and we are held to the highest ethical guidelines.') }}</p>
            </div>
        </div>
    </section>

    <!-- What We Do -->
    <section class="py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-bold text-zinc-900 dark:text-white">{{ __('What We Do') }}</h2>
                <p class="mx-auto mt-4 max-w-2xl text-lg text-zinc-600 dark:text-zinc-400">{{ __('Our comprehensive services help homeowners at every stage of the foreclosure prevention process.') }}</p>
            </div>
            <div class="mt-12 grid gap-8 md:grid-cols-2">
                <div class="rounded-xl border border-zinc-200 bg-white p-8 dark:border-zinc-700 dark:bg-zinc-900">
                    <x-flux::icon name="phone" class="h-8 w-8 text-blue-600" />
                    <h3 class="mt-4 text-xl font-semibold text-zinc-900 dark:text-white">{{ __('Free Consultations') }}</h3>
                    <p class="mt-2 text-zinc-600 dark:text-zinc-400">{{ __('Speak with a certified housing counselor to understand your situation and explore your options at no cost.') }}</p>
                </div>
                <div class="rounded-xl border border-zinc-200 bg-white p-8 dark:border-zinc-700 dark:bg-zinc-900">
                    <x-flux::icon name="document-text" class="h-8 w-8 text-blue-600" />
                    <h3 class="mt-4 text-xl font-semibold text-zinc-900 dark:text-white">{{ __('Document Preparation') }}</h3>
                    <p class="mt-2 text-zinc-600 dark:text-zinc-400">{{ __('We help you gather and prepare all necessary documentation for loan modification and loss mitigation applications.') }}</p>
                </div>
                <div class="rounded-xl border border-zinc-200 bg-white p-8 dark:border-zinc-700 dark:bg-zinc-900">
                    <x-flux::icon name="chat-bubble-left-right" class="h-8 w-8 text-blue-600" />
                    <h3 class="mt-4 text-xl font-semibold text-zinc-900 dark:text-white">{{ __('Lender Negotiations') }}</h3>
                    <p class="mt-2 text-zinc-600 dark:text-zinc-400">{{ __('Our counselors advocate on your behalf with lenders and servicers to find solutions that work for you.') }}</p>
                </div>
                <div class="rounded-xl border border-zinc-200 bg-white p-8 dark:border-zinc-700 dark:bg-zinc-900">
                    <x-flux::icon name="academic-cap" class="h-8 w-8 text-blue-600" />
                    <h3 class="mt-4 text-xl font-semibold text-zinc-900 dark:text-white">{{ __('Financial Education') }}</h3>
                    <p class="mt-2 text-zinc-600 dark:text-zinc-400">{{ __('Learn budgeting skills and financial strategies to maintain your housing stability long-term.') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="bg-blue-600 py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-bold text-white">{{ __('Ready to Get Started?') }}</h2>
                <p class="mx-auto mt-4 max-w-xl text-blue-100">{{ __('Contact us today to schedule your free consultation with a certified housing counselor.') }}</p>
                <div class="mt-8">
                    <flux:button variant="primary" :href="route('contact')" wire:navigate class="bg-white text-blue-600 hover:bg-blue-50">{{ __('Contact Us Today') }}</flux:button>
                </div>
            </div>
        </div>
    </section>
</div>
