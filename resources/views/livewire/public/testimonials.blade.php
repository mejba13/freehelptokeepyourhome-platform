<?php

use App\Models\Testimonial;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new
#[Layout('components.layouts.public')]
#[Title('Testimonials')]
class extends Component {
    use WithPagination;

    public function with(): array
    {
        return [
            'testimonials' => Testimonial::published()->ordered()->paginate(9),
        ];
    }
}; ?>

<div class="overflow-hidden">
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 py-24 lg:py-32">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-[0.03]">
            <svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="testimonials-hero-pattern" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                        <circle cx="20" cy="20" r="1" fill="white"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#testimonials-hero-pattern)"/>
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
                >{{ __('Testimonials') }}</p>
                <h1
                    x-show="shown"
                    x-transition:enter="transition ease-out duration-700 delay-150"
                    x-transition:enter-start="opacity-0 -translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="mt-4 text-4xl font-bold tracking-tight text-white sm:text-5xl lg:text-6xl"
                >{{ __('Success Stories') }}</h1>
                <p
                    x-show="shown"
                    x-transition:enter="transition ease-out duration-700 delay-300"
                    x-transition:enter-start="opacity-0 -translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="mt-6 text-lg leading-relaxed text-slate-300"
                >{{ __('Hear from families who kept their homes with our help. Their stories inspire us to continue our mission.') }}</p>
            </div>
        </div>
    </section>

    <!-- Testimonials Grid -->
    <section class="bg-white py-24 dark:bg-slate-900 lg:py-32">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @if($testimonials->count() > 0)
                <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($testimonials as $index => $testimonial)
                        <div
                            x-data="{ shown: false }"
                            x-init="setTimeout(() => shown = true, {{ $index * 100 }})"
                            x-show="shown"
                            x-transition:enter="transition ease-out duration-500"
                            x-transition:enter-start="opacity-0 translate-y-4"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-slate-50 p-8 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl dark:border-slate-700 dark:bg-slate-800"
                        >
                            <!-- Quote Icon -->
                            <div class="absolute -right-4 -top-4 text-slate-200 dark:text-slate-700">
                                <svg class="h-24 w-24" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                                </svg>
                            </div>

                            <div class="relative">
                                <!-- Rating -->
                                @if($testimonial->rating)
                                    <div class="flex gap-1">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg class="h-5 w-5 {{ $i <= $testimonial->rating ? 'text-amber-400' : 'text-slate-300 dark:text-slate-600' }}" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        @endfor
                                    </div>
                                @endif

                                <!-- Quote -->
                                <blockquote class="mt-6 text-lg leading-relaxed text-slate-700 dark:text-slate-300">
                                    "{{ $testimonial->content }}"
                                </blockquote>

                                <!-- Author -->
                                <div class="mt-8 flex items-center gap-4 border-t border-slate-200 pt-6 dark:border-slate-700">
                                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-gradient-to-br from-blue-500 to-cyan-500 text-sm font-bold text-white shadow-lg shadow-blue-500/30">
                                        {{ strtoupper(substr($testimonial->author_name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <p class="font-semibold text-slate-900 dark:text-white">{{ $testimonial->author_name }}</p>
                                        @if($testimonial->author_title)
                                            <p class="text-sm text-slate-500 dark:text-slate-400">{{ $testimonial->author_title }}</p>
                                        @endif
                                        @if($testimonial->author_location)
                                            <p class="text-sm text-slate-500 dark:text-slate-400">{{ $testimonial->author_location }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if($testimonials->hasPages())
                    <div class="mt-16 flex justify-center">
                        {{ $testimonials->links() }}
                    </div>
                @endif
            @else
                <div class="mx-auto max-w-lg rounded-2xl border border-slate-200 bg-slate-50 p-12 text-center dark:border-slate-700 dark:bg-slate-800">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-slate-200 dark:bg-slate-700">
                        <svg class="h-8 w-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                    </div>
                    <h3 class="mt-6 text-lg font-semibold text-slate-900 dark:text-white">{{ __('No testimonials yet') }}</h3>
                    <p class="mt-2 text-slate-600 dark:text-slate-400">{{ __('Check back soon for success stories from our clients.') }}</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Share Your Story -->
    <section class="bg-slate-50 py-24 dark:bg-slate-900/50 lg:py-32">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-500 to-cyan-500 shadow-lg shadow-blue-500/30">
                    <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                    </svg>
                </div>
                <h2 class="mt-8 text-3xl font-bold tracking-tight text-slate-900 dark:text-white sm:text-4xl">{{ __('Share Your Story') }}</h2>
                <p class="mt-6 text-lg leading-relaxed text-slate-600 dark:text-slate-400">{{ __('Have we helped you keep your home? We\'d love to hear about your experience. Your story can inspire others facing similar challenges.') }}</p>
                <div class="mt-10">
                    <a
                        href="{{ route('contact') }}"
                        wire:navigate
                        class="group inline-flex items-center gap-2 rounded-xl border-2 border-slate-900 bg-slate-900 px-8 py-4 text-base font-semibold text-white transition-all duration-300 hover:bg-transparent hover:text-slate-900 dark:border-white dark:bg-white dark:text-slate-900 dark:hover:bg-transparent dark:hover:text-white"
                    >
                        {{ __('Contact Us to Share') }}
                        <svg class="h-5 w-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
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
                            <pattern id="testimonials-cta-pattern" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                                <circle cx="20" cy="20" r="1" fill="white"/>
                            </pattern>
                        </defs>
                        <rect width="100%" height="100%" fill="url(#testimonials-cta-pattern)"/>
                    </svg>
                </div>

                <!-- Gradient Orbs -->
                <div class="absolute -left-20 -top-20 h-80 w-80 rounded-full bg-blue-500/30 blur-3xl"></div>
                <div class="absolute -bottom-20 -right-20 h-80 w-80 rounded-full bg-cyan-500/30 blur-3xl"></div>

                <div class="relative">
                    <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">{{ __('Need Help Keeping Your Home?') }}</h2>
                    <p class="mx-auto mt-6 max-w-2xl text-lg leading-relaxed text-blue-100">{{ __('Our free housing counseling services have helped thousands of families. Let us help you too.') }}</p>
                    <div class="mt-10">
                        <a
                            href="{{ route('contact') }}"
                            wire:navigate
                            class="group inline-flex items-center gap-2 rounded-xl bg-white px-8 py-4 text-base font-semibold text-slate-900 shadow-lg shadow-white/25 transition-all duration-300 hover:scale-105 hover:shadow-xl"
                        >
                            {{ __('Get Free Help Today') }}
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
