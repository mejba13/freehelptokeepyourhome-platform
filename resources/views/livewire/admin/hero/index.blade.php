<?php

use App\Models\HeroSection;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new
#[Layout('components.layouts.admin')]
#[Title('Hero Sections')]
class extends Component {
    public function delete(HeroSection $heroSection): void
    {
        $heroSection->delete();
    }

    public function with(): array
    {
        return [
            'heroSections' => HeroSection::latest()->get(),
        ];
    }
}; ?>

<div class="space-y-6">
        <div class="flex items-center justify-between">
            <flux:heading size="xl">{{ __('Hero Sections') }}</flux:heading>
            <flux:button :href="route('admin.hero.create')" wire:navigate icon="plus" variant="primary">
                {{ __('Add Hero Section') }}
            </flux:button>
        </div>

        <div class="grid gap-4 md:grid-cols-2">
            @forelse ($heroSections as $hero)
                <div wire:key="hero-{{ $hero->id }}" class="rounded-lg border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
                    <div class="mb-4 flex items-start justify-between">
                        <div>
                            <flux:heading size="lg">{{ $hero->name }}</flux:heading>
                            <flux:text class="text-zinc-500">{{ $hero->title }}</flux:text>
                        </div>
                        @if ($hero->status === 'published')
                            <flux:badge color="green">{{ __('Published') }}</flux:badge>
                        @else
                            <flux:badge color="amber">{{ __('Draft') }}</flux:badge>
                        @endif
                    </div>
                    @if ($hero->subtitle)
                        <flux:text class="mb-4 text-sm text-zinc-500">{{ Str::limit($hero->subtitle, 100) }}</flux:text>
                    @endif
                    <div class="flex gap-2">
                        <flux:button size="sm" :href="route('admin.hero.edit', $hero)" wire:navigate icon="pencil">
                            {{ __('Edit') }}
                        </flux:button>
                        <flux:button size="sm" variant="danger" wire:click="delete({{ $hero->id }})" wire:confirm="{{ __('Are you sure?') }}" icon="trash">
                            {{ __('Delete') }}
                        </flux:button>
                    </div>
                </div>
            @empty
                <div class="col-span-2 rounded-lg border border-zinc-200 bg-white p-8 text-center dark:border-zinc-700 dark:bg-zinc-900">
                    <flux:text class="text-zinc-500">{{ __('No hero sections found.') }}</flux:text>
                </div>
            @endforelse
        </div>
    </div>
