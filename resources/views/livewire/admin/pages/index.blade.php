<?php

use App\Models\Page;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new
#[Layout('components.layouts.admin')]
#[Title('Pages')]
class extends Component {
    use WithPagination;

    public string $search = '';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function delete(Page $page): void
    {
        $page->delete();
        $this->dispatch('page-deleted');
    }

    public function with(): array
    {
        return [
            'pages' => Page::query()
                ->when($this->search, fn ($q) => $q->where('title', 'like', "%{$this->search}%"))
                ->ordered()
                ->paginate(10),
        ];
    }
}; ?>

<div class="space-y-6">
        <div class="flex items-center justify-between">
            <flux:heading size="xl">{{ __('Pages') }}</flux:heading>
            <flux:button :href="route('admin.pages.create')" wire:navigate icon="plus" variant="primary">
                {{ __('Create Page') }}
            </flux:button>
        </div>

        <div class="rounded-lg border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-900">
            <div class="border-b border-zinc-200 p-4 dark:border-zinc-700">
                <flux:input wire:model.live.debounce.300ms="search" placeholder="{{ __('Search pages...') }}" icon="magnifying-glass" />
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-800">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium text-zinc-500">{{ __('Title') }}</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-zinc-500">{{ __('Slug') }}</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-zinc-500">{{ __('Status') }}</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-zinc-500">{{ __('Updated') }}</th>
                            <th class="px-6 py-3 text-right text-sm font-medium text-zinc-500">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                        @forelse ($pages as $page)
                            <tr wire:key="page-{{ $page->id }}">
                                <td class="px-6 py-4">
                                    <flux:text class="font-medium">{{ $page->title }}</flux:text>
                                </td>
                                <td class="px-6 py-4">
                                    <flux:text class="text-sm text-zinc-500">/{{ $page->slug }}</flux:text>
                                </td>
                                <td class="px-6 py-4">
                                    @if ($page->status === 'published')
                                        <flux:badge color="green">{{ __('Published') }}</flux:badge>
                                    @else
                                        <flux:badge color="amber">{{ __('Draft') }}</flux:badge>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <flux:text class="text-sm text-zinc-500">{{ $page->updated_at->diffForHumans() }}</flux:text>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <flux:button size="sm" :href="route('admin.pages.edit', $page)" wire:navigate icon="pencil">
                                            {{ __('Edit') }}
                                        </flux:button>
                                        <flux:button size="sm" variant="danger" wire:click="delete({{ $page->id }})" wire:confirm="{{ __('Are you sure you want to delete this page?') }}" icon="trash">
                                            {{ __('Delete') }}
                                        </flux:button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center">
                                    <flux:text class="text-zinc-500">{{ __('No pages found.') }}</flux:text>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($pages->hasPages())
                <div class="border-t border-zinc-200 p-4 dark:border-zinc-700">
                    {{ $pages->links() }}
                </div>
            @endif
        </div>
    </div>
