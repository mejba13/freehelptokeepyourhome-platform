<?php

use App\Models\SiteSetting;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new
#[Layout('components.layouts.admin')]
#[Title('Site Settings')]
class extends Component {
    public array $settings = [];

    public function mount(): void
    {
        $this->settings = [
            'site_name' => SiteSetting::get('site_name', 'Free Help To Keep Your Home'),
            'site_tagline' => SiteSetting::get('site_tagline', ''),
            'hero_video_url' => SiteSetting::get('hero_video_url', ''),
            'phone_primary' => SiteSetting::get('phone_primary', ''),
            'phone_secondary' => SiteSetting::get('phone_secondary', ''),
            'email' => SiteSetting::get('email', ''),
            'address' => SiteSetting::get('address', ''),
            'business_hours' => SiteSetting::get('business_hours', ''),
            'facebook_url' => SiteSetting::get('facebook_url', ''),
            'twitter_url' => SiteSetting::get('twitter_url', ''),
            'linkedin_url' => SiteSetting::get('linkedin_url', ''),
            'footer_text' => SiteSetting::get('footer_text', ''),
            'disclosure_text' => SiteSetting::get('disclosure_text', ''),
            'google_analytics_id' => SiteSetting::get('google_analytics_id', ''),
        ];
    }

    public function save(): void
    {
        SiteSetting::set('site_name', $this->settings['site_name'], 'general');
        SiteSetting::set('site_tagline', $this->settings['site_tagline'], 'general');
        SiteSetting::set('hero_video_url', $this->settings['hero_video_url'], 'general');
        SiteSetting::set('phone_primary', $this->settings['phone_primary'], 'contact');
        SiteSetting::set('phone_secondary', $this->settings['phone_secondary'], 'contact');
        SiteSetting::set('email', $this->settings['email'], 'contact');
        SiteSetting::set('address', $this->settings['address'], 'contact');
        SiteSetting::set('business_hours', $this->settings['business_hours'], 'contact');
        SiteSetting::set('facebook_url', $this->settings['facebook_url'], 'social');
        SiteSetting::set('twitter_url', $this->settings['twitter_url'], 'social');
        SiteSetting::set('linkedin_url', $this->settings['linkedin_url'], 'social');
        SiteSetting::set('footer_text', $this->settings['footer_text'], 'footer');
        SiteSetting::set('disclosure_text', $this->settings['disclosure_text'], 'disclosure');
        SiteSetting::set('google_analytics_id', $this->settings['google_analytics_id'], 'general');

        session()->flash('success', __('Settings saved successfully.'));
    }
}; ?>

<div
    x-data="{ shown: false }"
    x-init="setTimeout(() => shown = true, 100)"
    class="space-y-6"
>
    <!-- Page Header -->
    <div
        x-show="shown"
        x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="opacity-0 -translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
    >
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">{{ __('Site Settings') }}</h1>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ __('Configure your website settings and contact information') }}</p>
    </div>

    <!-- Success Message -->
    @if (session('success'))
        <div
            x-data="{ show: true }"
            x-show="show"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            x-init="setTimeout(() => show = false, 5000)"
            class="flex items-center gap-3 rounded-xl border border-emerald-200 bg-emerald-50 p-4 dark:border-emerald-500/30 dark:bg-emerald-500/10"
        >
            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-500/20 text-emerald-600 dark:text-emerald-400">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <span class="text-sm font-medium text-emerald-700 dark:text-emerald-300">{{ session('success') }}</span>
        </div>
    @endif

    <form wire:submit="save" class="space-y-6">
        <!-- General Settings -->
        <div
            x-show="shown"
            x-transition:enter="transition ease-out duration-500 delay-100"
            x-transition:enter-start="opacity-0 translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            class="overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900"
        >
            <div class="flex items-center gap-3 border-b border-slate-200/80 px-6 py-4 dark:border-slate-800">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-500/10 text-blue-600 dark:bg-blue-500/20 dark:text-blue-400">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <h2 class="font-semibold text-slate-900 dark:text-white">{{ __('General') }}</h2>
            </div>
            <div class="grid gap-5 p-6 sm:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('Site Name') }}</label>
                    <input type="text" wire:model="settings.site_name" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 transition-all duration-200 placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 dark:focus:border-blue-500"/>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('Tagline') }}</label>
                    <input type="text" wire:model="settings.site_tagline" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 transition-all duration-200 placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 dark:focus:border-blue-500"/>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('Google Analytics ID') }}</label>
                    <input type="text" wire:model="settings.google_analytics_id" placeholder="G-XXXXXXXXXX" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 transition-all duration-200 placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 dark:focus:border-blue-500"/>
                </div>
                <div class="sm:col-span-2">
                    <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('Hero Video URL (Default)') }}</label>
                    <input type="text" wire:model="settings.hero_video_url" placeholder="https://www.youtube.com/watch?v=..." class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 transition-all duration-200 placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 dark:focus:border-blue-500"/>
                    <p class="mt-1.5 text-xs text-slate-500 dark:text-slate-400">{{ __('Default YouTube video for the homepage hero section. Can be overridden per hero section.') }}</p>
                </div>
            </div>
        </div>

        <!-- Contact Settings -->
        <div
            x-show="shown"
            x-transition:enter="transition ease-out duration-500 delay-150"
            x-transition:enter-start="opacity-0 translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            class="overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900"
        >
            <div class="flex items-center gap-3 border-b border-slate-200/80 px-6 py-4 dark:border-slate-800">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-cyan-500/10 text-cyan-600 dark:bg-cyan-500/20 dark:text-cyan-400">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                </div>
                <h2 class="font-semibold text-slate-900 dark:text-white">{{ __('Contact Information') }}</h2>
            </div>
            <div class="grid gap-5 p-6 sm:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('Primary Phone') }}</label>
                    <input type="text" wire:model="settings.phone_primary" placeholder="1-800-XXX-XXXX" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 transition-all duration-200 placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 dark:focus:border-blue-500"/>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('Secondary Phone') }}</label>
                    <input type="text" wire:model="settings.phone_secondary" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 transition-all duration-200 placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 dark:focus:border-blue-500"/>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('Email') }}</label>
                    <input type="email" wire:model="settings.email" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 transition-all duration-200 placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 dark:focus:border-blue-500"/>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('Business Hours') }}</label>
                    <input type="text" wire:model="settings.business_hours" placeholder="Mon-Fri 9AM-5PM" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 transition-all duration-200 placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 dark:focus:border-blue-500"/>
                </div>
                <div class="sm:col-span-2">
                    <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('Address') }}</label>
                    <textarea wire:model="settings.address" rows="2" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 transition-all duration-200 placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 dark:focus:border-blue-500"></textarea>
                </div>
            </div>
        </div>

        <!-- Social Settings -->
        <div
            x-show="shown"
            x-transition:enter="transition ease-out duration-500 delay-200"
            x-transition:enter-start="opacity-0 translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            class="overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900"
        >
            <div class="flex items-center gap-3 border-b border-slate-200/80 px-6 py-4 dark:border-slate-800">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-purple-500/10 text-purple-600 dark:bg-purple-500/20 dark:text-purple-400">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h2 class="font-semibold text-slate-900 dark:text-white">{{ __('Social Media') }}</h2>
            </div>
            <div class="grid gap-5 p-6 sm:grid-cols-3">
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('Facebook URL') }}</label>
                    <input type="url" wire:model="settings.facebook_url" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 transition-all duration-200 placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 dark:focus:border-blue-500"/>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('Twitter URL') }}</label>
                    <input type="url" wire:model="settings.twitter_url" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 transition-all duration-200 placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 dark:focus:border-blue-500"/>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('LinkedIn URL') }}</label>
                    <input type="url" wire:model="settings.linkedin_url" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 transition-all duration-200 placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 dark:focus:border-blue-500"/>
                </div>
            </div>
        </div>

        <!-- Footer & Disclosure -->
        <div
            x-show="shown"
            x-transition:enter="transition ease-out duration-500 delay-250"
            x-transition:enter-start="opacity-0 translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            class="overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900"
        >
            <div class="flex items-center gap-3 border-b border-slate-200/80 px-6 py-4 dark:border-slate-800">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-500/10 text-amber-600 dark:bg-amber-500/20 dark:text-amber-400">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h2 class="font-semibold text-slate-900 dark:text-white">{{ __('Footer & Disclosure') }}</h2>
            </div>
            <div class="space-y-5 p-6">
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('Footer Text') }}</label>
                    <textarea wire:model="settings.footer_text" rows="2" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 transition-all duration-200 placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 dark:focus:border-blue-500"></textarea>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('Disclosure Text') }}</label>
                    <textarea wire:model="settings.disclosure_text" rows="4" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 transition-all duration-200 placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 dark:focus:border-blue-500"></textarea>
                </div>
            </div>
        </div>

        <!-- Save Button -->
        <div
            x-show="shown"
            x-transition:enter="transition ease-out duration-500 delay-300"
            x-transition:enter-start="opacity-0 translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
        >
            <button
                type="submit"
                class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 to-cyan-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-500/30 transition-all duration-300 hover:scale-105 hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-blue-500/20"
            >
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                {{ __('Save Settings') }}
            </button>
        </div>
    </form>
</div>
