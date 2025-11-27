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
        $hero = HeroSection::published()->first();
        $videoUrl = $hero?->video_url ?: SiteSetting::get('hero_video_url', '');

        return [
            'hero' => $hero,
            'videoUrl' => $videoUrl,
            'youtubeId' => $this->extractYoutubeId($videoUrl),
            'testimonials' => Testimonial::published()->featured()->ordered()->take(6)->get(),
            'ctas' => CallToAction::published()->get(),
            'banner' => Banner::active()->position('home')->first(),
        ];
    }

    private function extractYoutubeId(?string $url): ?string
    {
        if (!$url) return null;

        $patterns = [
            '/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/)([a-zA-Z0-9_-]{11})/',
            '/^([a-zA-Z0-9_-]{11})$/',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $url, $matches)) {
                return $matches[1];
            }
        }

        return null;
    }
}; ?>

<div class="overflow-hidden">
    <!-- Hero Section - Premium Redesign with Video -->
    <section
        x-data="{
            shown: false,
            videoPlaying: false,
            init() {
                setTimeout(() => this.shown = true, 100);
            }
        }"
        class="relative min-h-screen overflow-hidden"
    >
        <!-- Layered Background -->
        <div class="absolute inset-0">
            <!-- Base gradient -->
            <div class="absolute inset-0 bg-gradient-to-br from-slate-950 via-slate-900 to-blue-950"></div>

            <!-- Helping hands background image with overlay -->
            <div
                class="absolute inset-0 bg-cover bg-center bg-no-repeat opacity-20"
                style="background-image: url('https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');"
            ></div>

            <!-- Gradient overlay for text contrast -->
            <div class="absolute inset-0 bg-gradient-to-r from-slate-950/95 via-slate-950/80 to-slate-950/60 lg:via-slate-950/70 lg:to-transparent"></div>

            <!-- Decorative gradient orbs -->
            <div class="absolute -left-40 top-1/4 h-[500px] w-[500px] rounded-full bg-blue-600/20 blur-[120px]"></div>
            <div class="absolute -right-40 bottom-1/4 h-[400px] w-[400px] rounded-full bg-cyan-600/15 blur-[100px]"></div>
            <div class="absolute right-1/4 top-20 h-[300px] w-[300px] rounded-full bg-emerald-600/10 blur-[80px]"></div>

            <!-- Subtle grid pattern -->
            <div class="absolute inset-0 opacity-[0.02]" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>

        <!-- Main Content -->
        <div class="relative z-10 flex min-h-screen items-center">
            <div class="mx-auto w-full max-w-7xl px-4 py-24 sm:px-6 lg:px-8 lg:py-32">
                <div class="grid items-center gap-12 lg:grid-cols-2 lg:gap-20">

                    <!-- Left Column - Content -->
                    <div class="text-center lg:text-left">
                        <!-- Trust Badge -->
                        <div
                            x-show="shown"
                            x-transition:enter="transition ease-out duration-700"
                            x-transition:enter-start="opacity-0 -translate-y-4"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="mb-8 inline-flex items-center gap-3 rounded-full border border-emerald-500/30 bg-emerald-500/10 px-5 py-2.5 backdrop-blur-sm"
                        >
                            <span class="relative flex h-2.5 w-2.5">
                                <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-75"></span>
                                <span class="relative inline-flex h-2.5 w-2.5 rounded-full bg-emerald-400"></span>
                            </span>
                            <span class="text-sm font-semibold tracking-wide text-emerald-300">{{ __('HUD-Approved Housing Counseling Agency') }}</span>
                        </div>

                        <!-- Main Heading -->
                        <h1
                            x-show="shown"
                            x-transition:enter="transition ease-out duration-700 delay-150"
                            x-transition:enter-start="opacity-0 -translate-y-4"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="text-4xl font-bold leading-[1.1] tracking-tight text-white sm:text-5xl lg:text-6xl xl:text-7xl"
                        >
                            @if($hero && $hero->title)
                                {!! nl2br(e($hero->title)) !!}
                            @else
                                <span class="block">{{ __('Free Help to') }}</span>
                                <span class="mt-2 block bg-gradient-to-r from-cyan-400 via-blue-400 to-emerald-400 bg-clip-text text-transparent">
                                    {{ __('Keep Your Home') }}
                                </span>
                            @endif
                        </h1>

                        <!-- Subtitle -->
                        <p
                            x-show="shown"
                            x-transition:enter="transition ease-out duration-700 delay-300"
                            x-transition:enter-start="opacity-0 -translate-y-4"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="mx-auto mt-8 max-w-xl text-lg leading-relaxed text-slate-300 lg:mx-0 lg:text-xl"
                        >
                            @if($hero && $hero->subtitle)
                                {{ $hero->subtitle }}
                            @else
                                {{ __('Get confidential assistance to avoid foreclosure and stay in your home. Our HUD-approved housing counselors are here to help — completely free of charge.') }}
                            @endif
                        </p>

                        <!-- Key Benefits - Compact -->
                        <div
                            x-show="shown"
                            x-transition:enter="transition ease-out duration-700 delay-400"
                            x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100"
                            class="mt-8 flex flex-wrap items-center justify-center gap-6 lg:justify-start"
                        >
                            <div class="flex items-center gap-2">
                                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-500/20">
                                    <svg class="h-4 w-4 text-emerald-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-slate-300">{{ __('100% Free') }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-500/20">
                                    <svg class="h-4 w-4 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-slate-300">{{ __('Confidential') }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-amber-500/20">
                                    <svg class="h-4 w-4 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-slate-300">{{ __('HUD Certified') }}</span>
                            </div>
                        </div>

                        <!-- CTA Buttons -->
                        <div
                            x-show="shown"
                            x-transition:enter="transition ease-out duration-700 delay-500"
                            x-transition:enter-start="opacity-0 -translate-y-4"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="mt-10 flex flex-col items-center gap-4 sm:flex-row lg:justify-start"
                        >
                            <a
                                href="{{ $hero?->cta_url ?: route('contact') }}"
                                wire:navigate
                                class="group relative inline-flex items-center justify-center gap-2.5 overflow-hidden rounded-xl bg-gradient-to-r from-emerald-500 to-cyan-500 px-8 py-4 text-base font-semibold text-white shadow-lg shadow-emerald-500/30 transition-all duration-300 hover:scale-[1.02] hover:shadow-xl hover:shadow-emerald-500/40"
                            >
                                <span class="relative z-10">{{ $hero?->cta_text ?: __('Get Free Help Today') }}</span>
                                <svg class="relative z-10 h-5 w-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                                <div class="absolute inset-0 -z-10 bg-gradient-to-r from-cyan-500 to-emerald-500 opacity-0 transition-opacity duration-300 group-hover:opacity-100"></div>
                            </a>
                            <a
                                href="{{ $hero?->cta_secondary_url ?: route('services') }}"
                                wire:navigate
                                class="group inline-flex items-center gap-2.5 rounded-xl border border-white/20 bg-white/5 px-8 py-4 text-base font-semibold text-white backdrop-blur-sm transition-all duration-300 hover:border-white/40 hover:bg-white/10"
                            >
                                <span>{{ $hero?->cta_secondary_text ?: __('Learn About Our Services') }}</span>
                                <svg class="h-5 w-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Right Column - Video Player -->
                    <div
                        x-show="shown"
                        x-transition:enter="transition ease-out duration-1000 delay-300"
                        x-transition:enter-start="opacity-0 translate-x-12"
                        x-transition:enter-end="opacity-100 translate-x-0"
                        class="relative"
                    >
                        <!-- Decorative elements -->
                        <div class="absolute -right-8 -top-8 h-64 w-64 rounded-full bg-gradient-to-br from-cyan-500/30 to-transparent blur-3xl"></div>
                        <div class="absolute -bottom-8 -left-8 h-48 w-48 rounded-full bg-gradient-to-tr from-emerald-500/20 to-transparent blur-3xl"></div>

                        @if($youtubeId)
                            <!-- Video Container -->
                            <div class="relative">
                                <!-- Outer glow frame -->
                                <div class="absolute -inset-1 rounded-2xl bg-gradient-to-r from-cyan-500/50 via-blue-500/50 to-emerald-500/50 opacity-60 blur-sm"></div>

                                <!-- Video wrapper -->
                                <div class="relative overflow-hidden rounded-2xl border border-white/10 bg-slate-900/80 shadow-2xl shadow-black/40 backdrop-blur-sm">
                                    <!-- Video thumbnail with play button (lazy load) -->
                                    <div
                                        x-data="{ loaded: false }"
                                        class="relative aspect-video w-full"
                                    >
                                        <template x-if="!loaded">
                                            <div class="absolute inset-0">
                                                <!-- Thumbnail -->
                                                <img
                                                    src="https://img.youtube.com/vi/{{ $youtubeId }}/maxresdefault.jpg"
                                                    alt="{{ __('Watch our video') }}"
                                                    class="h-full w-full object-cover"
                                                    onerror="this.src='https://img.youtube.com/vi/{{ $youtubeId }}/hqdefault.jpg'"
                                                >
                                                <!-- Gradient overlay -->
                                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 via-transparent to-slate-900/20"></div>
                                                <!-- Play button -->
                                                <button
                                                    @click="loaded = true"
                                                    class="absolute inset-0 flex items-center justify-center transition-transform duration-300 hover:scale-105"
                                                >
                                                    <div class="flex h-20 w-20 items-center justify-center rounded-full bg-white/95 shadow-2xl shadow-black/30 transition-all duration-300 hover:bg-white">
                                                        <svg class="ml-1.5 h-8 w-8 text-slate-900" fill="currentColor" viewBox="0 0 24 24">
                                                            <path d="M8 5v14l11-7z"/>
                                                        </svg>
                                                    </div>
                                                </button>
                                                <!-- Video label -->
                                                <div class="absolute bottom-4 left-4 flex items-center gap-2 rounded-lg bg-black/50 px-3 py-1.5 backdrop-blur-sm">
                                                    <svg class="h-4 w-4 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814z"/>
                                                        <path fill="#fff" d="M9.545 15.568V8.432L15.818 12z"/>
                                                    </svg>
                                                    <span class="text-xs font-medium text-white">{{ __('Watch Video') }}</span>
                                                </div>
                                            </div>
                                        </template>
                                        <template x-if="loaded">
                                            <iframe
                                                src="https://www.youtube.com/embed/{{ $youtubeId }}?autoplay=1&rel=0&modestbranding=1"
                                                class="absolute inset-0 h-full w-full"
                                                frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen
                                            ></iframe>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        @else
                            <!-- Stats Card Fallback when no video -->
                            <div class="relative overflow-hidden rounded-2xl border border-white/10 bg-white/5 p-8 backdrop-blur-xl">
                                <!-- Card Header -->
                                <div class="mb-8 flex items-center gap-4">
                                    <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-gradient-to-br from-emerald-500 to-cyan-500 shadow-lg shadow-emerald-500/30">
                                        <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-slate-400">{{ __('Our Impact') }}</p>
                                        <p class="text-xl font-bold text-white">{{ __('Proven Results') }}</p>
                                    </div>
                                </div>

                                <!-- Main Stat -->
                                <div class="mb-8 text-center">
                                    <p class="bg-gradient-to-r from-white via-cyan-200 to-emerald-200 bg-clip-text text-6xl font-bold tracking-tight text-transparent sm:text-7xl">$50M+</p>
                                    <p class="mt-2 text-lg text-slate-300">{{ __('In Savings Achieved') }}</p>
                                </div>

                                <!-- Stats Grid -->
                                <div class="grid grid-cols-3 gap-4 border-t border-white/10 pt-8">
                                    <div class="text-center">
                                        <p class="text-2xl font-bold text-white">10K+</p>
                                        <p class="mt-1 text-xs text-slate-400">{{ __('Families Helped') }}</p>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-2xl font-bold text-white">98%</p>
                                        <p class="mt-1 text-xs text-slate-400">{{ __('Success Rate') }}</p>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-2xl font-bold text-white">24/7</p>
                                        <p class="mt-1 text-xs text-slate-400">{{ __('Support') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 z-10 -translate-x-1/2">
            <div
                x-show="shown"
                x-transition:enter="transition ease-out duration-700 delay-700"
                x-transition:enter-start="opacity-0 translate-y-4"
                x-transition:enter-end="opacity-100 translate-y-0"
                class="flex flex-col items-center gap-2"
            >
                <span class="text-[10px] font-semibold uppercase tracking-[0.2em] text-slate-500">{{ __('Scroll') }}</span>
                <div class="flex h-10 w-6 items-start justify-center rounded-full border-2 border-slate-600/50 p-1.5">
                    <div class="h-2 w-1 animate-bounce rounded-full bg-slate-500"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Trust Bar -->
    <section class="relative z-10 -mt-1 border-y border-slate-200 bg-white py-8 dark:border-slate-800 dark:bg-slate-900">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col items-center justify-between gap-6 md:flex-row">
                <p class="text-sm font-medium uppercase tracking-wider text-slate-500 dark:text-slate-400">{{ __('Trusted by thousands of families') }}</p>
                <div class="flex flex-wrap items-center justify-center gap-8 md:gap-12">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-900/30">
                            <svg class="h-5 w-5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-lg font-bold text-slate-900 dark:text-white">HUD</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400">{{ __('Approved') }}</p>
                        </div>
                    </div>
                    <div class="hidden h-8 w-px bg-slate-200 dark:bg-slate-700 sm:block"></div>
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-emerald-100 dark:bg-emerald-900/30">
                            <svg class="h-5 w-5 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-lg font-bold text-slate-900 dark:text-white">100%</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400">{{ __('Free') }}</p>
                        </div>
                    </div>
                    <div class="hidden h-8 w-px bg-slate-200 dark:bg-slate-700 sm:block"></div>
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-amber-100 dark:bg-amber-900/30">
                            <svg class="h-5 w-5 text-amber-600 dark:text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-lg font-bold text-slate-900 dark:text-white">100%</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400">{{ __('Confidential') }}</p>
                        </div>
                    </div>
                    <div class="hidden h-8 w-px bg-slate-200 dark:bg-slate-700 sm:block"></div>
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-purple-100 dark:bg-purple-900/30">
                            <svg class="h-5 w-5 text-purple-600 dark:text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-lg font-bold text-slate-900 dark:text-white">10K+</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400">{{ __('Families') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="relative bg-slate-50 py-24 dark:bg-slate-900/50 lg:py-32">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="mx-auto max-w-3xl text-center">
                <p class="text-sm font-semibold uppercase tracking-widest text-blue-600 dark:text-blue-400">{{ __('Our Services') }}</p>
                <h2 class="mt-4 text-3xl font-bold tracking-tight text-slate-900 dark:text-white sm:text-4xl lg:text-5xl">
                    {{ __('How We Can Help You') }}
                </h2>
                <p class="mt-6 text-lg leading-relaxed text-slate-600 dark:text-slate-400">
                    {{ __('Our HUD-approved housing counselors provide comprehensive, free assistance to help you navigate financial challenges and keep your home.') }}
                </p>
            </div>

            <!-- Services Grid -->
            <div class="mt-16 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                <!-- Service Card 1 -->
                <div
                    x-data="{ hover: false }"
                    @mouseenter="hover = true"
                    @mouseleave="hover = false"
                    class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-8 shadow-sm transition-all duration-500 hover:-translate-y-1 hover:shadow-xl dark:border-slate-700 dark:bg-slate-800"
                >
                    <div class="absolute -right-20 -top-20 h-40 w-40 rounded-full bg-gradient-to-br from-blue-500/10 to-cyan-500/10 transition-transform duration-500 group-hover:scale-150"></div>
                    <div class="relative">
                        <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 shadow-lg shadow-blue-500/30">
                            <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <h3 class="mt-6 text-xl font-bold text-slate-900 dark:text-white">{{ __('Foreclosure Prevention') }}</h3>
                        <p class="mt-3 leading-relaxed text-slate-600 dark:text-slate-400">
                            {{ __('Work with certified counselors to explore all available options and develop a strategy to avoid losing your home to foreclosure.') }}
                        </p>
                        <a href="{{ route('services') }}" wire:navigate class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-blue-600 transition-colors hover:text-blue-700 dark:text-blue-400">
                            {{ __('Learn more') }}
                            <svg class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Service Card 2 -->
                <div
                    x-data="{ hover: false }"
                    @mouseenter="hover = true"
                    @mouseleave="hover = false"
                    class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-8 shadow-sm transition-all duration-500 hover:-translate-y-1 hover:shadow-xl dark:border-slate-700 dark:bg-slate-800"
                >
                    <div class="absolute -right-20 -top-20 h-40 w-40 rounded-full bg-gradient-to-br from-emerald-500/10 to-teal-500/10 transition-transform duration-500 group-hover:scale-150"></div>
                    <div class="relative">
                        <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600 shadow-lg shadow-emerald-500/30">
                            <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="mt-6 text-xl font-bold text-slate-900 dark:text-white">{{ __('Loan Modification') }}</h3>
                        <p class="mt-3 leading-relaxed text-slate-600 dark:text-slate-400">
                            {{ __('Get expert help negotiating with your lender to modify your loan terms, potentially lowering your monthly payments.') }}
                        </p>
                        <a href="{{ route('services') }}" wire:navigate class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-emerald-600 transition-colors hover:text-emerald-700 dark:text-emerald-400">
                            {{ __('Learn more') }}
                            <svg class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Service Card 3 -->
                <div
                    x-data="{ hover: false }"
                    @mouseenter="hover = true"
                    @mouseleave="hover = false"
                    class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-8 shadow-sm transition-all duration-500 hover:-translate-y-1 hover:shadow-xl dark:border-slate-700 dark:bg-slate-800"
                >
                    <div class="absolute -right-20 -top-20 h-40 w-40 rounded-full bg-gradient-to-br from-amber-500/10 to-orange-500/10 transition-transform duration-500 group-hover:scale-150"></div>
                    <div class="relative">
                        <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-gradient-to-br from-amber-500 to-amber-600 shadow-lg shadow-amber-500/30">
                            <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <h3 class="mt-6 text-xl font-bold text-slate-900 dark:text-white">{{ __('Budget Counseling') }}</h3>
                        <p class="mt-3 leading-relaxed text-slate-600 dark:text-slate-400">
                            {{ __('Create a sustainable budget and financial plan to better manage your mortgage payments and household expenses.') }}
                        </p>
                        <a href="{{ route('services') }}" wire:navigate class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-amber-600 transition-colors hover:text-amber-700 dark:text-amber-400">
                            {{ __('Learn more') }}
                            <svg class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- View All Services -->
            <div class="mt-16 text-center">
                <a
                    href="{{ route('services') }}"
                    wire:navigate
                    class="inline-flex items-center gap-2 rounded-xl border-2 border-slate-900 bg-slate-900 px-8 py-4 text-base font-semibold text-white transition-all duration-300 hover:bg-transparent hover:text-slate-900 dark:border-white dark:bg-white dark:text-slate-900 dark:hover:bg-transparent dark:hover:text-white"
                >
                    {{ __('View All Services') }}
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    @if($ctas->count() > 0)
        @php $cta = $ctas->first(); @endphp
        <section class="relative overflow-hidden bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 py-24 lg:py-32">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-10">
                <svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <pattern id="cta-grid" x="0" y="0" width="60" height="60" patternUnits="userSpaceOnUse">
                            <path d="M60 0H0v60" fill="none" stroke="white" stroke-width="0.5"/>
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#cta-grid)"/>
                </svg>
            </div>

            <!-- Gradient Orbs -->
            <div class="absolute left-0 top-0 h-96 w-96 -translate-x-1/2 -translate-y-1/2 rounded-full bg-blue-500/30 blur-3xl"></div>
            <div class="absolute bottom-0 right-0 h-96 w-96 translate-x-1/2 translate-y-1/2 rounded-full bg-cyan-500/30 blur-3xl"></div>

            <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mx-auto max-w-3xl text-center">
                    @if($cta->icon)
                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-white/10 backdrop-blur-sm">
                            <x-flux::icon :name="$cta->icon" class="h-8 w-8 text-white" />
                        </div>
                    @endif
                    <h2 class="mt-8 text-3xl font-bold tracking-tight text-white sm:text-4xl lg:text-5xl">
                        {{ $cta->title }}
                    </h2>
                    @if($cta->description)
                        <p class="mx-auto mt-6 max-w-2xl text-lg leading-relaxed text-blue-100">
                            {{ $cta->description }}
                        </p>
                    @endif
                    @if($cta->button_text && $cta->button_url)
                        <div class="mt-10">
                            <a
                                href="{{ $cta->button_url }}"
                                class="group inline-flex items-center gap-3 rounded-xl bg-white px-8 py-4 text-base font-semibold text-slate-900 shadow-lg shadow-white/25 transition-all duration-300 hover:scale-105 hover:shadow-xl"
                            >
                                {{ $cta->button_text }}
                                <svg class="h-5 w-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endif

    <!-- Testimonials Section -->
    @if($testimonials->count() > 0)
        <section class="bg-white py-24 dark:bg-slate-900 lg:py-32">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <!-- Section Header -->
                <div class="mx-auto max-w-3xl text-center">
                    <p class="text-sm font-semibold uppercase tracking-widest text-blue-600 dark:text-blue-400">{{ __('Testimonials') }}</p>
                    <h2 class="mt-4 text-3xl font-bold tracking-tight text-slate-900 dark:text-white sm:text-4xl lg:text-5xl">
                        {{ __('Success Stories') }}
                    </h2>
                    <p class="mt-6 text-lg leading-relaxed text-slate-600 dark:text-slate-400">
                        {{ __('Hear from families who kept their homes with our help.') }}
                    </p>
                </div>

                <!-- Testimonials Carousel -->
                <div
                    x-data="{
                        currentIndex: 0,
                        testimonials: {{ $testimonials->count() }},
                        autoplay: null,
                        itemsPerPage() {
                            if (window.innerWidth >= 1024) return 3;
                            if (window.innerWidth >= 768) return 2;
                            return 1;
                        },
                        maxIndex() {
                            return Math.max(0, this.testimonials - this.itemsPerPage());
                        },
                        next() {
                            this.currentIndex = this.currentIndex >= this.maxIndex() ? 0 : this.currentIndex + 1;
                        },
                        prev() {
                            this.currentIndex = this.currentIndex <= 0 ? this.maxIndex() : this.currentIndex - 1;
                        },
                        init() {
                            this.autoplay = setInterval(() => this.next(), 5000);
                        }
                    }"
                    @mouseenter="clearInterval(autoplay)"
                    @mouseleave="autoplay = setInterval(() => next(), 5000)"
                    class="relative mt-16"
                >
                    <!-- Carousel Container -->
                    <div class="overflow-hidden">
                        <div
                            class="flex transition-transform duration-500 ease-out"
                            :style="'transform: translateX(-' + (currentIndex * (100 / itemsPerPage())) + '%)'"
                        >
                            @foreach($testimonials as $testimonial)
                                <div class="w-full flex-shrink-0 px-4 md:w-1/2 lg:w-1/3">
                                    <div class="h-full rounded-2xl border border-slate-200 bg-slate-50 p-8 dark:border-slate-700 dark:bg-slate-800">
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
                                            "{{ Str::limit($testimonial->content, 180) }}"
                                        </blockquote>

                                        <!-- Author -->
                                        <div class="mt-8 flex items-center gap-4">
                                            <div class="flex h-12 w-12 items-center justify-center rounded-full bg-gradient-to-br from-blue-500 to-cyan-500 text-sm font-bold text-white">
                                                {{ strtoupper(substr($testimonial->author_name, 0, 2)) }}
                                            </div>
                                            <div>
                                                <p class="font-semibold text-slate-900 dark:text-white">{{ $testimonial->author_name }}</p>
                                                @if($testimonial->author_location)
                                                    <p class="text-sm text-slate-500 dark:text-slate-400">{{ $testimonial->author_location }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Navigation Arrows -->
                    <button
                        @click="prev()"
                        class="absolute -left-4 top-1/2 flex h-12 w-12 -translate-y-1/2 items-center justify-center rounded-full border border-slate-200 bg-white shadow-lg transition-all duration-300 hover:border-blue-500 hover:text-blue-600 dark:border-slate-700 dark:bg-slate-800 dark:hover:border-blue-500 lg:-left-6"
                    >
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>
                    <button
                        @click="next()"
                        class="absolute -right-4 top-1/2 flex h-12 w-12 -translate-y-1/2 items-center justify-center rounded-full border border-slate-200 bg-white shadow-lg transition-all duration-300 hover:border-blue-500 hover:text-blue-600 dark:border-slate-700 dark:bg-slate-800 dark:hover:border-blue-500 lg:-right-6"
                    >
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>

                    <!-- Dots Indicator -->
                    <div class="mt-8 flex justify-center gap-2">
                        @for($i = 0; $i < $testimonials->count(); $i++)
                            <button
                                @click="currentIndex = {{ $i }}"
                                :class="currentIndex === {{ $i }} ? 'bg-blue-600 w-8' : 'bg-slate-300 dark:bg-slate-600 w-2'"
                                class="h-2 rounded-full transition-all duration-300"
                            ></button>
                        @endfor
                    </div>
                </div>

                <!-- View All -->
                <div class="mt-12 text-center">
                    <a
                        href="{{ route('testimonials') }}"
                        wire:navigate
                        class="inline-flex items-center gap-2 text-base font-semibold text-blue-600 transition-colors hover:text-blue-700 dark:text-blue-400"
                    >
                        {{ __('Read More Success Stories') }}
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        </section>
    @endif

    <!-- Final CTA Section -->
    <section class="relative bg-slate-50 py-24 dark:bg-slate-900/50 lg:py-32">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 p-12 shadow-2xl lg:p-16">
                <!-- Background Pattern -->
                <div class="absolute inset-0 opacity-10">
                    <svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <pattern id="final-pattern" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                                <circle cx="20" cy="20" r="1" fill="white"/>
                            </pattern>
                        </defs>
                        <rect width="100%" height="100%" fill="url(#final-pattern)"/>
                    </svg>
                </div>

                <!-- Gradient Orbs -->
                <div class="absolute -left-20 -top-20 h-80 w-80 rounded-full bg-blue-500/30 blur-3xl"></div>
                <div class="absolute -bottom-20 -right-20 h-80 w-80 rounded-full bg-cyan-500/30 blur-3xl"></div>

                <div class="relative text-center">
                    <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl lg:text-5xl">
                        {{ __('Ready to Get Help?') }}
                    </h2>
                    <p class="mx-auto mt-6 max-w-2xl text-lg leading-relaxed text-blue-100">
                        {{ __('Contact us today for free, confidential housing counseling. Our certified counselors are here to help you keep your home.') }}
                    </p>
                    <div class="mt-10 flex flex-col items-center justify-center gap-4 sm:flex-row">
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
                        @php $phone = SiteSetting::get('phone_primary'); @endphp
                        @if($phone)
                            <a
                                href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}"
                                class="inline-flex items-center gap-2 rounded-xl border border-white/20 bg-white/5 px-8 py-4 text-base font-semibold text-white backdrop-blur-sm transition-all duration-300 hover:border-white/40 hover:bg-white/10"
                            >
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                {{ $phone }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
