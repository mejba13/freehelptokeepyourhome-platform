<?php

use App\Models\CallToAction;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new
#[Layout('components.layouts.admin')]
#[Title('CTAs')]
class extends Component {
    public function delete(CallToAction $cta): void
    {
        $cta->delete();
    }

    public function with(): array
    {
        return ['ctas' => CallToAction::latest()->get()];
    }
}; ?>

<div class="space-y-6">
        <div class="flex items-center justify-between">
            <flux:heading size="xl">{{ __('Call to Actions') }}</flux:heading>
            <flux:button :href="route('admin.ctas.create')" wire:navigate icon="plus" variant="primary">{{ __('Add CTA') }}</flux:button>
        </div>

        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            @forelse ($ctas as $cta)
                <div wire:key="cta-{{ $cta->id }}" class="rounded-lg border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
                    <div class="mb-4 flex items-start justify-between">
                        <flux:heading size="lg">{{ $cta->name }}</flux:heading>
                        @if ($cta->status === 'published')
                            <flux:badge color="green">{{ __('Published') }}</flux:badge>
                        @else
                            <flux:badge color="amber">{{ __('Draft') }}</flux:badge>
                        @endif
                    </div>
                    <flux:text class="mb-2 font-medium">{{ $cta->title }}</flux:text>
                    @if ($cta->description)
                        <flux:text class="mb-4 text-sm text-zinc-500">{{ Str::limit($cta->description, 80) }}</flux:text>
                    @endif
                    <div class="mb-4"><flux:badge>{{ ucfirst($cta->style) }}</flux:badge></div>
                    <div class="flex gap-2">
                        <flux:button size="sm" :href="route('admin.ctas.edit', $cta)" wire:navigate icon="pencil">{{ __('Edit') }}</flux:button>
                        <flux:button size="sm" variant="danger" wire:click="delete({{ $cta->id }})" wire:confirm="{{ __('Are you sure?') }}" icon="trash">{{ __('Delete') }}</flux:button>
                    </div>
                </div>
            @empty
                <div class="col-span-full rounded-lg border border-zinc-200 bg-white p-8 text-center dark:border-zinc-700 dark:bg-zinc-900">
                    <flux:text class="text-zinc-500">{{ __('No CTAs found.') }}</flux:text>
                </div>
            @endforelse
        </div>
    </div>
