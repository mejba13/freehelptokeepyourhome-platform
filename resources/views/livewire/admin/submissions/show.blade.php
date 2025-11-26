<?php

use App\Models\ContactSubmission;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new
#[Layout('components.layouts.admin')]
#[Title('View Submission')]
class extends Component {
    public ContactSubmission $submission;

    public function mount(ContactSubmission $submission): void
    {
        $this->submission = $submission;
        if ($submission->status === 'new') {
            $submission->markAsRead();
        }
    }

    public function markAsResponded(): void
    {
        $this->submission->markAsResponded();
        session()->flash('success', __('Marked as responded.'));
    }
}; ?>

<div class="space-y-6">
        <div class="flex items-center gap-4">
            <flux:button :href="route('admin.submissions.index')" wire:navigate icon="arrow-left" variant="ghost">{{ __('Back') }}</flux:button>
            <flux:heading size="xl">{{ __('Submission Details') }}</flux:heading>
        </div>

        @if (session('success'))
            <flux:callout variant="success" icon="check-circle">{{ session('success') }}</flux:callout>
        @endif

        <div class="grid gap-6 lg:grid-cols-3">
            <div class="space-y-6 lg:col-span-2">
                <div class="rounded-lg border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
                    <flux:heading size="lg" class="mb-4">{{ __('Message') }}</flux:heading>
                    <div class="prose dark:prose-invert max-w-none">
                        <p>{{ $submission->message ?: __('No message provided.') }}</p>
                    </div>
                </div>

                @if ($submission->data)
                    <div class="rounded-lg border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
                        <flux:heading size="lg" class="mb-4">{{ __('Additional Data') }}</flux:heading>
                        <pre class="overflow-x-auto rounded bg-zinc-100 p-4 text-sm dark:bg-zinc-800">{{ json_encode($submission->data, JSON_PRETTY_PRINT) }}</pre>
                    </div>
                @endif
            </div>

            <div class="space-y-6">
                <div class="rounded-lg border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
                    <flux:heading size="lg" class="mb-4">{{ __('Contact Info') }}</flux:heading>
                    <div class="space-y-3">
                        <div><flux:text class="text-sm text-zinc-500">{{ __('Name') }}</flux:text><flux:text class="font-medium">{{ $submission->name }}</flux:text></div>
                        <div><flux:text class="text-sm text-zinc-500">{{ __('Email') }}</flux:text><a href="mailto:{{ $submission->email }}" class="font-medium text-blue-600 hover:underline">{{ $submission->email }}</a></div>
                        @if ($submission->phone)
                            <div><flux:text class="text-sm text-zinc-500">{{ __('Phone') }}</flux:text><a href="tel:{{ $submission->phone }}" class="font-medium text-blue-600 hover:underline">{{ $submission->phone }}</a></div>
                        @endif
                    </div>
                </div>

                <div class="rounded-lg border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
                    <flux:heading size="lg" class="mb-4">{{ __('Details') }}</flux:heading>
                    <div class="space-y-3">
                        <div><flux:text class="text-sm text-zinc-500">{{ __('Type') }}</flux:text><flux:badge>{{ ucfirst($submission->form_type) }}</flux:badge></div>
                        <div><flux:text class="text-sm text-zinc-500">{{ __('Status') }}</flux:text>
                            @if ($submission->status === 'new')
                                <flux:badge color="red">{{ __('New') }}</flux:badge>
                            @elseif ($submission->status === 'read')
                                <flux:badge color="amber">{{ __('Read') }}</flux:badge>
                            @else
                                <flux:badge color="green">{{ __('Responded') }}</flux:badge>
                            @endif
                        </div>
                        <div><flux:text class="text-sm text-zinc-500">{{ __('Date') }}</flux:text><flux:text>{{ $submission->created_at->format('M j, Y g:i A') }}</flux:text></div>
                        @if ($submission->ip_address)
                            <div><flux:text class="text-sm text-zinc-500">{{ __('IP Address') }}</flux:text><flux:text>{{ $submission->ip_address }}</flux:text></div>
                        @endif
                    </div>
                </div>

                @if ($submission->status !== 'responded')
                    <flux:button wire:click="markAsResponded" variant="primary" class="w-full" icon="check">{{ __('Mark as Responded') }}</flux:button>
                @endif
            </div>
        </div>
    </div>
