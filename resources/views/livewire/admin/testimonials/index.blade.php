<?php

use App\Models\Testimonial;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new
#[Layout('components.layouts.admin')]
#[Title('Testimonials')]
class extends Component {
    use WithPagination;

    public string $search = '';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function delete(Testimonial $testimonial): void
    {
        $testimonial->delete();
    }

    public function toggleFeatured(Testimonial $testimonial): void
    {
        $testimonial->update(['featured' => !$testimonial->featured]);
    }

    public function with(): array
    {
        return [
            'testimonials' => Testimonial::query()
                ->when($this->search, fn ($q) => $q->where('author_name', 'like', "%{$this->search}%"))
                ->ordered()
                ->paginate(10),
        ];
    }
}; ?>

<div class="space-y-6">
        <div class="flex items-center justify-between">
            <flux:heading size="xl">{{ __('Testimonials') }}</flux:heading>
            <flux:button :href="route('admin.testimonials.create')" wire:navigate icon="plus" variant="primary">
                {{ __('Add Testimonial') }}
            </flux:button>
        </div>

        <div class="rounded-lg border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-900">
            <div class="border-b border-zinc-200 p-4 dark:border-zinc-700">
                <flux:input wire:model.live.debounce.300ms="search" placeholder="{{ __('Search testimonials...') }}" icon="magnifying-glass" />
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-800">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium text-zinc-500">{{ __('Author') }}</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-zinc-500">{{ __('Rating') }}</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-zinc-500">{{ __('Status') }}</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-zinc-500">{{ __('Featured') }}</th>
                            <th class="px-6 py-3 text-right text-sm font-medium text-zinc-500">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                        @forelse ($testimonials as $testimonial)
                            <tr wire:key="testimonial-{{ $testimonial->id }}">
                                <td class="px-6 py-4">
                                    <div>
                                        <flux:text class="font-medium">{{ $testimonial->author_name }}</flux:text>
                                        @if ($testimonial->author_title)
                                            <flux:text class="text-sm text-zinc-500">{{ $testimonial->author_title }}</flux:text>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-1">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <flux:icon name="star" class="h-4 w-4 {{ $i <= $testimonial->rating ? 'text-amber-400' : 'text-zinc-300' }}" />
                                        @endfor
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @if ($testimonial->status === 'published')
                                        <flux:badge color="green">{{ __('Published') }}</flux:badge>
                                    @else
                                        <flux:badge color="amber">{{ __('Draft') }}</flux:badge>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <flux:switch wire:click="toggleFeatured({{ $testimonial->id }})" :checked="$testimonial->featured" />
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <flux:button size="sm" :href="route('admin.testimonials.edit', $testimonial)" wire:navigate icon="pencil">
                                            {{ __('Edit') }}
                                        </flux:button>
                                        <flux:button size="sm" variant="danger" wire:click="delete({{ $testimonial->id }})" wire:confirm="{{ __('Are you sure?') }}" icon="trash">
                                            {{ __('Delete') }}
                                        </flux:button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center">
                                    <flux:text class="text-zinc-500">{{ __('No testimonials found.') }}</flux:text>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($testimonials->hasPages())
                <div class="border-t border-zinc-200 p-4 dark:border-zinc-700">
                    {{ $testimonials->links() }}
                </div>
            @endif
        </div>
    </div>
