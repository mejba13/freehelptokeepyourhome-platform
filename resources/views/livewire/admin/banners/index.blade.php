<?php

use App\Models\Banner;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new
#[Layout('components.layouts.admin')]
#[Title('Banners')]
class extends Component {
    public function delete(Banner $banner): void
    {
        $banner->delete();
    }

    public function with(): array
    {
        return ['banners' => Banner::latest()->get()];
    }
}; ?>

<div class="space-y-6">
        <div class="flex items-center justify-between">
            <flux:heading size="xl">{{ __('Banners') }}</flux:heading>
            <flux:button :href="route('admin.banners.create')" wire:navigate icon="plus" variant="primary">{{ __('Add Banner') }}</flux:button>
        </div>

        <div class="rounded-lg border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-900">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-800">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium text-zinc-500">{{ __('Name') }}</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-zinc-500">{{ __('Position') }}</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-zinc-500">{{ __('Status') }}</th>
                            <th class="px-6 py-3 text-right text-sm font-medium text-zinc-500">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                        @forelse ($banners as $banner)
                            <tr wire:key="banner-{{ $banner->id }}">
                                <td class="px-6 py-4">
                                    <flux:text class="font-medium">{{ $banner->name }}</flux:text>
                                    <flux:text class="text-sm text-zinc-500">{{ $banner->title }}</flux:text>
                                </td>
                                <td class="px-6 py-4"><flux:badge>{{ ucfirst($banner->position) }}</flux:badge></td>
                                <td class="px-6 py-4">
                                    @if ($banner->status === 'published')
                                        <flux:badge color="green">{{ __('Published') }}</flux:badge>
                                    @else
                                        <flux:badge color="amber">{{ __('Draft') }}</flux:badge>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <flux:button size="sm" :href="route('admin.banners.edit', $banner)" wire:navigate icon="pencil">{{ __('Edit') }}</flux:button>
                                        <flux:button size="sm" variant="danger" wire:click="delete({{ $banner->id }})" wire:confirm="{{ __('Are you sure?') }}" icon="trash">{{ __('Delete') }}</flux:button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="px-6 py-8 text-center"><flux:text class="text-zinc-500">{{ __('No banners found.') }}</flux:text></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
