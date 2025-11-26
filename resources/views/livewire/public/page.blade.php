<?php

use App\Models\Page;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new
#[Layout('components.layouts.public')]
class extends Component {
    public Page $page;

    public function mount(Page $page): void
    {
        if ($page->status !== 'published') {
            abort(404);
        }
        $this->page = $page;
    }
}; ?>

<div class="overflow-hidden">
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 py-24 lg:py-32">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-[0.03]">
            <svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="page-hero-pattern" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                        <circle cx="20" cy="20" r="1" fill="white"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#page-hero-pattern)"/>
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
                <h1
                    x-show="shown"
                    x-transition:enter="transition ease-out duration-700"
                    x-transition:enter-start="opacity-0 -translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="text-4xl font-bold tracking-tight text-white sm:text-5xl lg:text-6xl"
                >{{ $page->title }}</h1>
                @if($page->excerpt)
                    <p
                        x-show="shown"
                        x-transition:enter="transition ease-out duration-700 delay-150"
                        x-transition:enter-start="opacity-0 -translate-y-4"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="mt-6 text-lg leading-relaxed text-slate-300"
                    >{{ $page->excerpt }}</p>
                @endif
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section class="bg-white py-24 dark:bg-slate-900 lg:py-32">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <article
                x-data="{ shown: false }"
                x-init="setTimeout(() => shown = true, 200)"
                x-show="shown"
                x-transition:enter="transition ease-out duration-700"
                x-transition:enter-start="opacity-0 translate-y-4"
                x-transition:enter-end="opacity-100 translate-y-0"
                class="prose prose-lg prose-slate mx-auto dark:prose-invert prose-headings:font-bold prose-headings:tracking-tight prose-h2:text-2xl prose-h3:text-xl prose-a:text-blue-600 prose-a:no-underline hover:prose-a:underline dark:prose-a:text-blue-400 prose-img:rounded-2xl prose-img:shadow-lg"
            >
                {!! $page->content !!}
            </article>
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
                            <pattern id="page-cta-pattern" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                                <circle cx="20" cy="20" r="1" fill="white"/>
                            </pattern>
                        </defs>
                        <rect width="100%" height="100%" fill="url(#page-cta-pattern)"/>
                    </svg>
                </div>

                <!-- Gradient Orbs -->
                <div class="absolute -left-20 -top-20 h-80 w-80 rounded-full bg-blue-500/30 blur-3xl"></div>
                <div class="absolute -bottom-20 -right-20 h-80 w-80 rounded-full bg-cyan-500/30 blur-3xl"></div>

                <div class="relative">
                    <div class="mx-auto mb-8 flex h-16 w-16 items-center justify-center rounded-2xl bg-white/10 backdrop-blur-sm">
                        <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">{{ __('Need Assistance?') }}</h2>
                    <p class="mx-auto mt-6 max-w-2xl text-lg leading-relaxed text-blue-100">{{ __('Contact us today for free, confidential housing counseling. Our certified counselors are here to help you.') }}</p>
                    <div class="mt-10">
                        <a
                            href="{{ route('contact') }}"
                            wire:navigate
                            class="group inline-flex items-center gap-2 rounded-xl bg-white px-8 py-4 text-base font-semibold text-slate-900 shadow-lg shadow-white/25 transition-all duration-300 hover:scale-105 hover:shadow-xl"
                        >
                            {{ __('Contact Us') }}
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
