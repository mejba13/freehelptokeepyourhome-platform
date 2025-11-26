@php
    use App\Models\SiteSetting;
    $siteName = SiteSetting::get('site_name', 'Free Help To Keep Your Home');
    $tagline = SiteSetting::get('site_tagline', '');
    $phonePrimary = SiteSetting::get('phone_primary', '');
@endphp

<header class="sticky top-0 z-50 border-b border-zinc-200 bg-white/95 backdrop-blur supports-[backdrop-filter]:bg-white/80 dark:border-zinc-800 dark:bg-zinc-950/95 dark:supports-[backdrop-filter]:bg-zinc-950/80">
    <!-- Top Bar -->
    @if($phonePrimary)
        <div class="bg-blue-600 text-white">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-2 sm:px-6 lg:px-8">
                <p class="text-sm font-medium">{{ __('Free & Confidential Help Available') }}</p>
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phonePrimary) }}" class="flex items-center gap-2 text-sm font-semibold hover:underline">
                    <x-flux::icon name="phone" class="h-4 w-4" />
                    {{ $phonePrimary }}
                </a>
            </div>
        </div>
    @endif

    <!-- Main Navigation -->
    <nav class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-3" wire:navigate>
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-600 text-white">
                    <x-flux::icon name="home" class="h-6 w-6" />
                </div>
                <div>
                    <span class="block text-lg font-bold leading-tight text-zinc-900 dark:text-white">{{ $siteName }}</span>
                    @if($tagline)
                        <span class="block text-xs text-zinc-500">{{ $tagline }}</span>
                    @endif
                </div>
            </a>

            <!-- Desktop Navigation -->
            <div class="hidden items-center gap-8 md:flex">
                <a href="{{ route('home') }}" class="text-sm font-medium text-zinc-700 transition hover:text-blue-600 dark:text-zinc-300 dark:hover:text-blue-400" wire:navigate>{{ __('Home') }}</a>
                <a href="{{ route('about') }}" class="text-sm font-medium text-zinc-700 transition hover:text-blue-600 dark:text-zinc-300 dark:hover:text-blue-400" wire:navigate>{{ __('About Us') }}</a>
                <a href="{{ route('services') }}" class="text-sm font-medium text-zinc-700 transition hover:text-blue-600 dark:text-zinc-300 dark:hover:text-blue-400" wire:navigate>{{ __('Services') }}</a>
                <a href="{{ route('testimonials') }}" class="text-sm font-medium text-zinc-700 transition hover:text-blue-600 dark:text-zinc-300 dark:hover:text-blue-400" wire:navigate>{{ __('Testimonials') }}</a>
                <a href="{{ route('contact') }}" class="text-sm font-medium text-zinc-700 transition hover:text-blue-600 dark:text-zinc-300 dark:hover:text-blue-400" wire:navigate>{{ __('Contact') }}</a>
            </div>

            <!-- CTA Button -->
            <div class="hidden md:block">
                <flux:button variant="primary" :href="route('contact')" wire:navigate>{{ __('Get Free Help') }}</flux:button>
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <flux:modal.trigger name="mobile-menu">
                    <flux:button variant="ghost" icon="bars-3" aria-label="{{ __('Open menu') }}" />
                </flux:modal.trigger>
            </div>
        </div>
    </nav>
</header>

<!-- Mobile Menu Modal -->
<flux:modal name="mobile-menu" class="md:hidden">
    <div class="space-y-4 p-4">
        <flux:heading size="lg">{{ __('Menu') }}</flux:heading>
        <nav class="space-y-2">
            <a href="{{ route('home') }}" class="block rounded-lg px-4 py-2 text-sm font-medium text-zinc-700 hover:bg-zinc-100 dark:text-zinc-300 dark:hover:bg-zinc-800" wire:navigate>{{ __('Home') }}</a>
            <a href="{{ route('about') }}" class="block rounded-lg px-4 py-2 text-sm font-medium text-zinc-700 hover:bg-zinc-100 dark:text-zinc-300 dark:hover:bg-zinc-800" wire:navigate>{{ __('About Us') }}</a>
            <a href="{{ route('services') }}" class="block rounded-lg px-4 py-2 text-sm font-medium text-zinc-700 hover:bg-zinc-100 dark:text-zinc-300 dark:hover:bg-zinc-800" wire:navigate>{{ __('Services') }}</a>
            <a href="{{ route('testimonials') }}" class="block rounded-lg px-4 py-2 text-sm font-medium text-zinc-700 hover:bg-zinc-100 dark:text-zinc-300 dark:hover:bg-zinc-800" wire:navigate>{{ __('Testimonials') }}</a>
            <a href="{{ route('contact') }}" class="block rounded-lg px-4 py-2 text-sm font-medium text-zinc-700 hover:bg-zinc-100 dark:text-zinc-300 dark:hover:bg-zinc-800" wire:navigate>{{ __('Contact') }}</a>
        </nav>
        <flux:button variant="primary" :href="route('contact')" wire:navigate class="w-full">{{ __('Get Free Help') }}</flux:button>
    </div>
</flux:modal>
