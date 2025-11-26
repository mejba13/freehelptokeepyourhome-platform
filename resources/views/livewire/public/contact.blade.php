<?php

use App\Models\ContactSubmission;
use App\Models\SiteSetting;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new
#[Layout('components.layouts.public')]
#[Title('Contact Us')]
class extends Component {
    public string $name = '';
    public string $email = '';
    public string $phone = '';
    public string $message = '';
    public bool $submitted = false;

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'message' => ['required', 'string', 'max:5000'],
        ];
    }

    public function submit(): void
    {
        $validated = $this->validate();

        ContactSubmission::create([
            'form_type' => 'contact',
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'message' => $validated['message'],
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'status' => 'new',
        ]);

        $this->submitted = true;
        $this->reset(['name', 'email', 'phone', 'message']);
    }
}; ?>

<div>
    <!-- Hero -->
    <section class="bg-gradient-to-br from-blue-600 to-blue-800 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-bold text-white sm:text-5xl">{{ __('Contact Us') }}</h1>
                <p class="mx-auto mt-4 max-w-2xl text-xl text-blue-100">{{ __('Get free, confidential help from our certified housing counselors.') }}</p>
            </div>
        </div>
    </section>

    <!-- Contact Content -->
    <section class="py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-12 lg:grid-cols-3">
                <!-- Contact Info -->
                <div class="space-y-8">
                    <div>
                        <h2 class="text-2xl font-bold text-zinc-900 dark:text-white">{{ __('Get in Touch') }}</h2>
                        <p class="mt-4 text-zinc-600 dark:text-zinc-400">{{ __('Our housing counselors are ready to help you. All consultations are free and confidential.') }}</p>
                    </div>

                    @php
                        $phonePrimary = SiteSetting::get('phone_primary');
                        $phoneSecondary = SiteSetting::get('phone_secondary');
                        $email = SiteSetting::get('email');
                        $address = SiteSetting::get('address');
                        $businessHours = SiteSetting::get('business_hours');
                    @endphp

                    <div class="space-y-6">
                        @if($phonePrimary)
                            <div class="flex items-start gap-4">
                                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-900/30">
                                    <x-flux::icon name="phone" class="h-5 w-5 text-blue-600" />
                                </div>
                                <div>
                                    <h3 class="font-medium text-zinc-900 dark:text-white">{{ __('Phone') }}</h3>
                                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phonePrimary) }}" class="text-blue-600 hover:underline">{{ $phonePrimary }}</a>
                                    @if($phoneSecondary)
                                        <br><a href="tel:{{ preg_replace('/[^0-9+]/', '', $phoneSecondary) }}" class="text-blue-600 hover:underline">{{ $phoneSecondary }}</a>
                                    @endif
                                </div>
                            </div>
                        @endif

                        @if($email)
                            <div class="flex items-start gap-4">
                                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-900/30">
                                    <x-flux::icon name="envelope" class="h-5 w-5 text-blue-600" />
                                </div>
                                <div>
                                    <h3 class="font-medium text-zinc-900 dark:text-white">{{ __('Email') }}</h3>
                                    <a href="mailto:{{ $email }}" class="text-blue-600 hover:underline">{{ $email }}</a>
                                </div>
                            </div>
                        @endif

                        @if($businessHours)
                            <div class="flex items-start gap-4">
                                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-900/30">
                                    <x-flux::icon name="clock" class="h-5 w-5 text-blue-600" />
                                </div>
                                <div>
                                    <h3 class="font-medium text-zinc-900 dark:text-white">{{ __('Business Hours') }}</h3>
                                    <p class="text-zinc-600 dark:text-zinc-400">{{ $businessHours }}</p>
                                </div>
                            </div>
                        @endif

                        @if($address)
                            <div class="flex items-start gap-4">
                                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-900/30">
                                    <x-flux::icon name="map-pin" class="h-5 w-5 text-blue-600" />
                                </div>
                                <div>
                                    <h3 class="font-medium text-zinc-900 dark:text-white">{{ __('Address') }}</h3>
                                    <p class="text-zinc-600 dark:text-zinc-400">{!! nl2br(e($address)) !!}</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Confidentiality Notice -->
                    <div class="rounded-xl bg-blue-50 p-6 dark:bg-blue-900/20">
                        <div class="flex items-center gap-3">
                            <x-flux::icon name="shield-check" class="h-6 w-6 text-blue-600" />
                            <h3 class="font-medium text-zinc-900 dark:text-white">{{ __('100% Confidential') }}</h3>
                        </div>
                        <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">{{ __('Your information is protected. We never share your personal details with third parties.') }}</p>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="lg:col-span-2">
                    <div class="rounded-xl border border-zinc-200 bg-white p-8 shadow-sm dark:border-zinc-700 dark:bg-zinc-900">
                        @if($submitted)
                            <div class="text-center">
                                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-green-100 dark:bg-green-900/30">
                                    <x-flux::icon name="check-circle" class="h-10 w-10 text-green-600" />
                                </div>
                                <h2 class="mt-6 text-2xl font-bold text-zinc-900 dark:text-white">{{ __('Thank You!') }}</h2>
                                <p class="mt-4 text-zinc-600 dark:text-zinc-400">{{ __('We\'ve received your message and will get back to you within 24-48 hours. If you need immediate assistance, please call us directly.') }}</p>
                                @if($phonePrimary)
                                    <div class="mt-6">
                                        <flux:button variant="primary" href="tel:{{ preg_replace('/[^0-9+]/', '', $phonePrimary) }}" icon="phone">{{ __('Call Us Now') }}: {{ $phonePrimary }}</flux:button>
                                    </div>
                                @endif
                            </div>
                        @else
                            <h2 class="text-xl font-bold text-zinc-900 dark:text-white">{{ __('Send Us a Message') }}</h2>
                            <p class="mt-2 text-zinc-600 dark:text-zinc-400">{{ __('Fill out the form below and we\'ll respond within 24-48 hours.') }}</p>

                            <form wire:submit="submit" class="mt-8 space-y-6">
                                <div class="grid gap-6 sm:grid-cols-2">
                                    <flux:field>
                                        <flux:label>{{ __('Full Name') }} <span class="text-red-500">*</span></flux:label>
                                        <flux:input wire:model="name" required />
                                        <flux:error name="name" />
                                    </flux:field>

                                    <flux:field>
                                        <flux:label>{{ __('Email Address') }} <span class="text-red-500">*</span></flux:label>
                                        <flux:input wire:model="email" type="email" required />
                                        <flux:error name="email" />
                                    </flux:field>
                                </div>

                                <flux:field>
                                    <flux:label>{{ __('Phone Number') }}</flux:label>
                                    <flux:input wire:model="phone" type="tel" placeholder="{{ __('(Optional)') }}" />
                                    <flux:error name="phone" />
                                </flux:field>

                                <flux:field>
                                    <flux:label>{{ __('Message') }} <span class="text-red-500">*</span></flux:label>
                                    <flux:textarea wire:model="message" rows="5" required placeholder="{{ __('Please describe your situation and how we can help you...') }}" />
                                    <flux:error name="message" />
                                </flux:field>

                                <flux:button type="submit" variant="primary" class="w-full sm:w-auto" wire:loading.attr="disabled">
                                    <span wire:loading.remove>{{ __('Send Message') }}</span>
                                    <span wire:loading>{{ __('Sending...') }}</span>
                                </flux:button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="border-t border-zinc-200 bg-zinc-50 py-16 dark:border-zinc-800 dark:bg-zinc-900">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-2xl font-bold text-zinc-900 dark:text-white">{{ __('Frequently Asked Questions') }}</h2>
            </div>
            <div class="mx-auto mt-12 max-w-3xl space-y-6">
                <div class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
                    <h3 class="font-semibold text-zinc-900 dark:text-white">{{ __('Is your service really free?') }}</h3>
                    <p class="mt-2 text-zinc-600 dark:text-zinc-400">{{ __('Yes, all of our housing counseling services are completely free. We are a HUD-approved agency funded to help homeowners in need.') }}</p>
                </div>
                <div class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
                    <h3 class="font-semibold text-zinc-900 dark:text-white">{{ __('Is my information kept confidential?') }}</h3>
                    <p class="mt-2 text-zinc-600 dark:text-zinc-400">{{ __('Absolutely. We maintain strict confidentiality and never share your personal information with third parties without your consent.') }}</p>
                </div>
                <div class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
                    <h3 class="font-semibold text-zinc-900 dark:text-white">{{ __('How quickly can I get help?') }}</h3>
                    <p class="mt-2 text-zinc-600 dark:text-zinc-400">{{ __('We typically respond within 24-48 hours. If your situation is urgent, please call us directly for immediate assistance.') }}</p>
                </div>
            </div>
        </div>
    </section>
</div>
