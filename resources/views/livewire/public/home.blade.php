<?php

use App\Models\Banner;
use App\Models\CallToAction;
use App\Models\HeroSection;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new
#[Layout('components.layouts.public')]
#[Title('Home')]
class extends Component {
    public function with(): array
    {
        return [
            'hero' => HeroSection::published()->first(),
            'testimonials' => Testimonial::published()->featured()->ordered()->take(3)->get(),
            'ctas' => CallToAction::published()->get(),
            'banner' => Banner::active()->position('home')->first(),
        ];
    }
}; ?>

<div>
<!-- Hero Section -->
@if($hero)
        <section class="relative overflow-hidden bg-gradient-to-br from-blue-600 via-blue-700 to-blue-800 py-20 lg:py-32">
            <div class="absolute inset-0 bg-[url('/img/pattern.svg')] opacity-10"></div>
            <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1 class="text-4xl font-bold tracking-tight text-white sm:text-5xl lg:text-6xl">
                        {{ $hero->title }}
                    </h1>
                    @if($hero->subtitle)
                        <p class="mx-auto mt-6 max-w-2xl text-xl text-blue-100">
                            {{ $hero->subtitle }}
                        </p>
                    @endif
                    <div class="mt-10 flex flex-col items-center justify-center gap-4 sm:flex-row">
                        @if($hero->cta_text && $hero->cta_url)
                            <flux:button variant="primary" :href="$hero->cta_url" class="bg-white text-blue-600 hover:bg-blue-50">
                                {{ $hero->cta_text }}
                            </flux:button>
                        @endif
                        @if($hero->cta_secondary_text && $hero->cta_secondary_url)
                            <flux:button variant="ghost" :href="$hero->cta_secondary_url" class="text-white hover:bg-white/10">
                                {{ $hero->cta_secondary_text }}
                            </flux:button>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @else
        <section class="relative overflow-hidden bg-gradient-to-br from-blue-600 via-blue-700 to-blue-800 py-20 lg:py-32">
            <div class="absolute inset-0 bg-[url('/img/pattern.svg')] opacity-10"></div>
            <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1 class="text-4xl font-bold tracking-tight text-white sm:text-5xl lg:text-6xl">
                        {{ __('Free Help to Keep Your Home') }}
                    </h1>
                    <p class="mx-auto mt-6 max-w-2xl text-xl text-blue-100">
                        {{ __('Get confidential assistance to avoid foreclosure and stay in your home. Our services are completely free.') }}
                    </p>
                    <div class="mt-10 flex flex-col items-center justify-center gap-4 sm:flex-row">
                        <flux:button variant="primary" :href="route('contact')" wire:navigate class="bg-white text-blue-600 hover:bg-blue-50">
                            {{ __('Get Free Help Today') }}
                        </flux:button>
                        <flux:button variant="ghost" :href="route('services')" wire:navigate class="text-white hover:bg-white/10">
                            {{ __('Our Services') }}
                        </flux:button>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Trust Indicators -->
    <section class="border-b border-zinc-200 bg-white py-8 dark:border-zinc-800 dark:bg-zinc-900">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 gap-8 md:grid-cols-4">
                <div class="text-center">
                    <div class="text-3xl font-bold text-blue-600">100%</div>
                    <div class="mt-1 text-sm text-zinc-500">{{ __('Free Service') }}</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-blue-600">24/7</div>
                    <div class="mt-1 text-sm text-zinc-500">{{ __('Support Available') }}</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-blue-600">1000+</div>
                    <div class="mt-1 text-sm text-zinc-500">{{ __('Families Helped') }}</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-blue-600">HUD</div>
                    <div class="mt-1 text-sm text-zinc-500">{{ __('Approved Agency') }}</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Overview -->
    <section class="py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-bold text-zinc-900 dark:text-white sm:text-4xl">{{ __('How We Can Help') }}</h2>
                <p class="mx-auto mt-4 max-w-2xl text-lg text-zinc-600 dark:text-zinc-400">{{ __('Our HUD-approved housing counselors provide free, confidential assistance to help you keep your home.') }}</p>
            </div>
            <div class="mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                <div class="rounded-xl border border-zinc-200 bg-white p-8 shadow-sm transition hover:shadow-md dark:border-zinc-700 dark:bg-zinc-900">
                    <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-blue-100 text-blue-600 dark:bg-blue-900/30">
                        <x-flux::icon name="shield-check" class="h-6 w-6" />
                    </div>
                    <h3 class="mt-6 text-lg font-semibold text-zinc-900 dark:text-white">{{ __('Foreclosure Prevention') }}</h3>
                    <p class="mt-2 text-zinc-600 dark:text-zinc-400">{{ __('Work with certified counselors to explore options and avoid losing your home to foreclosure.') }}</p>
                </div>
                <div class="rounded-xl border border-zinc-200 bg-white p-8 shadow-sm transition hover:shadow-md dark:border-zinc-700 dark:bg-zinc-900">
                    <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-green-100 text-green-600 dark:bg-green-900/30">
                        <x-flux::icon name="banknotes" class="h-6 w-6" />
                    </div>
                    <h3 class="mt-6 text-lg font-semibold text-zinc-900 dark:text-white">{{ __('Loan Modification') }}</h3>
                    <p class="mt-2 text-zinc-600 dark:text-zinc-400">{{ __('Get help negotiating with your lender to modify your loan terms and lower your payments.') }}</p>
                </div>
                <div class="rounded-xl border border-zinc-200 bg-white p-8 shadow-sm transition hover:shadow-md dark:border-zinc-700 dark:bg-zinc-900">
                    <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-amber-100 text-amber-600 dark:bg-amber-900/30">
                        <x-flux::icon name="document-text" class="h-6 w-6" />
                    </div>
                    <h3 class="mt-6 text-lg font-semibold text-zinc-900 dark:text-white">{{ __('Budget Counseling') }}</h3>
                    <p class="mt-2 text-zinc-600 dark:text-zinc-400">{{ __('Create a sustainable budget and financial plan to manage your mortgage and expenses.') }}</p>
                </div>
            </div>
            <div class="mt-12 text-center">
                <flux:button variant="primary" :href="route('services')" wire:navigate>{{ __('View All Services') }}</flux:button>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    @if($ctas->count() > 0)
        @php $cta = $ctas->first(); @endphp
        <section class="bg-blue-600 py-16">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    @if($cta->icon)
                        <x-flux::icon :name="$cta->icon" class="mx-auto h-12 w-12 text-blue-200" />
                    @endif
                    <h2 class="mt-4 text-3xl font-bold text-white">{{ $cta->title }}</h2>
                    @if($cta->description)
                        <p class="mx-auto mt-4 max-w-2xl text-lg text-blue-100">{{ $cta->description }}</p>
                    @endif
                    @if($cta->button_text && $cta->button_url)
                        <div class="mt-8">
                            <flux:button variant="primary" :href="$cta->button_url" class="bg-white text-blue-600 hover:bg-blue-50">{{ $cta->button_text }}</flux:button>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endif

    <!-- Testimonials -->
    @if($testimonials->count() > 0)
        <section class="py-16 lg:py-24">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 class="text-3xl font-bold text-zinc-900 dark:text-white sm:text-4xl">{{ __('Success Stories') }}</h2>
                    <p class="mx-auto mt-4 max-w-2xl text-lg text-zinc-600 dark:text-zinc-400">{{ __('Hear from families who kept their homes with our help.') }}</p>
                </div>
                <div class="mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($testimonials as $testimonial)
                        <div class="rounded-xl border border-zinc-200 bg-white p-8 shadow-sm dark:border-zinc-700 dark:bg-zinc-900">
                            <!-- Rating -->
                            @if($testimonial->rating)
                                <div class="flex gap-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        <x-flux::icon name="star" class="h-5 w-5 {{ $i <= $testimonial->rating ? 'text-amber-400' : 'text-zinc-200 dark:text-zinc-700' }}" />
                                    @endfor
                                </div>
                            @endif
                            <blockquote class="mt-4 text-zinc-600 dark:text-zinc-400">
                                "{{ Str::limit($testimonial->content, 200) }}"
                            </blockquote>
                            <div class="mt-6 flex items-center gap-4">
                                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-blue-100 text-sm font-medium text-blue-600 dark:bg-blue-900/30">
                                    {{ strtoupper(substr($testimonial->author_name, 0, 2)) }}
                                </div>
                                <div>
                                    <div class="font-medium text-zinc-900 dark:text-white">{{ $testimonial->author_name }}</div>
                                    @if($testimonial->author_location)
                                        <div class="text-sm text-zinc-500">{{ $testimonial->author_location }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-12 text-center">
                    <flux:button variant="outline" :href="route('testimonials')" wire:navigate>{{ __('Read More Stories') }}</flux:button>
                </div>
            </div>
        </section>
    @endif

    <!-- Final CTA -->
    <section class="border-t border-zinc-200 bg-zinc-50 py-16 dark:border-zinc-800 dark:bg-zinc-900">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-2xl bg-gradient-to-r from-blue-600 to-blue-700 p-8 text-center shadow-xl lg:p-12">
                <h2 class="text-2xl font-bold text-white sm:text-3xl">{{ __('Ready to Get Help?') }}</h2>
                <p class="mx-auto mt-4 max-w-xl text-blue-100">{{ __('Contact us today for free, confidential housing counseling. We\'re here to help you keep your home.') }}</p>
                <div class="mt-8 flex flex-col items-center justify-center gap-4 sm:flex-row">
                    <flux:button variant="primary" :href="route('contact')" wire:navigate class="bg-white text-blue-600 hover:bg-blue-50">{{ __('Contact Us') }}</flux:button>
                    @php $phone = SiteSetting::get('phone_primary'); @endphp
                    @if($phone)
                        <flux:button variant="ghost" href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}" class="text-white hover:bg-white/10" icon="phone">{{ $phone }}</flux:button>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
