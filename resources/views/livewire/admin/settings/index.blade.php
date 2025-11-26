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

<div class="space-y-6">
        <flux:heading size="xl">{{ __('Site Settings') }}</flux:heading>

        @if (session('success'))
            <flux:callout variant="success" icon="check-circle">{{ session('success') }}</flux:callout>
        @endif

        <form wire:submit="save" class="space-y-6">
            <!-- General Settings -->
            <div class="rounded-lg border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
                <flux:heading size="lg" class="mb-4">{{ __('General') }}</flux:heading>
                <div class="grid gap-4 sm:grid-cols-2">
                    <flux:field><flux:label>{{ __('Site Name') }}</flux:label><flux:input wire:model="settings.site_name" /></flux:field>
                    <flux:field><flux:label>{{ __('Tagline') }}</flux:label><flux:input wire:model="settings.site_tagline" /></flux:field>
                    <flux:field><flux:label>{{ __('Google Analytics ID') }}</flux:label><flux:input wire:model="settings.google_analytics_id" placeholder="G-XXXXXXXXXX" /></flux:field>
                </div>
            </div>

            <!-- Contact Settings -->
            <div class="rounded-lg border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
                <flux:heading size="lg" class="mb-4">{{ __('Contact Information') }}</flux:heading>
                <div class="grid gap-4 sm:grid-cols-2">
                    <flux:field><flux:label>{{ __('Primary Phone') }}</flux:label><flux:input wire:model="settings.phone_primary" placeholder="1-800-XXX-XXXX" /></flux:field>
                    <flux:field><flux:label>{{ __('Secondary Phone') }}</flux:label><flux:input wire:model="settings.phone_secondary" /></flux:field>
                    <flux:field><flux:label>{{ __('Email') }}</flux:label><flux:input wire:model="settings.email" type="email" /></flux:field>
                    <flux:field><flux:label>{{ __('Business Hours') }}</flux:label><flux:input wire:model="settings.business_hours" placeholder="Mon-Fri 9AM-5PM" /></flux:field>
                    <flux:field class="sm:col-span-2"><flux:label>{{ __('Address') }}</flux:label><flux:textarea wire:model="settings.address" rows="2" /></flux:field>
                </div>
            </div>

            <!-- Social Settings -->
            <div class="rounded-lg border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
                <flux:heading size="lg" class="mb-4">{{ __('Social Media') }}</flux:heading>
                <div class="grid gap-4 sm:grid-cols-3">
                    <flux:field><flux:label>{{ __('Facebook URL') }}</flux:label><flux:input wire:model="settings.facebook_url" /></flux:field>
                    <flux:field><flux:label>{{ __('Twitter URL') }}</flux:label><flux:input wire:model="settings.twitter_url" /></flux:field>
                    <flux:field><flux:label>{{ __('LinkedIn URL') }}</flux:label><flux:input wire:model="settings.linkedin_url" /></flux:field>
                </div>
            </div>

            <!-- Footer & Disclosure -->
            <div class="rounded-lg border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
                <flux:heading size="lg" class="mb-4">{{ __('Footer & Disclosure') }}</flux:heading>
                <div class="space-y-4">
                    <flux:field><flux:label>{{ __('Footer Text') }}</flux:label><flux:textarea wire:model="settings.footer_text" rows="2" /></flux:field>
                    <flux:field><flux:label>{{ __('Disclosure Text') }}</flux:label><flux:textarea wire:model="settings.disclosure_text" rows="4" /></flux:field>
                </div>
            </div>

            <flux:button type="submit" variant="primary" icon="check">{{ __('Save Settings') }}</flux:button>
        </form>
    </div>
