<?php

use App\Models\ContactSubmission;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new
#[Layout('components.layouts.admin')]
#[Title('Form Submissions')]
class extends Component {
    use WithPagination;

    public string $filter = '';

    public function updatedFilter(): void
    {
        $this->resetPage();
    }

    public function delete(ContactSubmission $submission): void
    {
        $submission->delete();
    }

    public function with(): array
    {
        return [
            'submissions' => ContactSubmission::query()
                ->when($this->filter, fn ($q) => $q->where('status', $this->filter))
                ->latest()
                ->paginate(15),
        ];
    }
}; ?>

<div class="space-y-6">
        <div class="flex items-center justify-between">
            <flux:heading size="xl">{{ __('Form Submissions') }}</flux:heading>
        </div>

        <div class="rounded-lg border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-900">
            <div class="border-b border-zinc-200 p-4 dark:border-zinc-700">
                <flux:select wire:model.live="filter" class="w-48">
                    <flux:select.option value="">{{ __('All Submissions') }}</flux:select.option>
                    <flux:select.option value="new">{{ __('New') }}</flux:select.option>
                    <flux:select.option value="read">{{ __('Read') }}</flux:select.option>
                    <flux:select.option value="responded">{{ __('Responded') }}</flux:select.option>
                </flux:select>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-800">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium text-zinc-500">{{ __('Contact') }}</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-zinc-500">{{ __('Type') }}</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-zinc-500">{{ __('Status') }}</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-zinc-500">{{ __('Date') }}</th>
                            <th class="px-6 py-3 text-right text-sm font-medium text-zinc-500">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                        @forelse ($submissions as $submission)
                            <tr wire:key="submission-{{ $submission->id }}" class="{{ $submission->status === 'new' ? 'bg-blue-50 dark:bg-blue-900/10' : '' }}">
                                <td class="px-6 py-4">
                                    <flux:text class="font-medium">{{ $submission->name }}</flux:text>
                                    <flux:text class="text-sm text-zinc-500">{{ $submission->email }}</flux:text>
                                </td>
                                <td class="px-6 py-4"><flux:badge>{{ ucfirst($submission->form_type) }}</flux:badge></td>
                                <td class="px-6 py-4">
                                    @if ($submission->status === 'new')
                                        <flux:badge color="red">{{ __('New') }}</flux:badge>
                                    @elseif ($submission->status === 'read')
                                        <flux:badge color="amber">{{ __('Read') }}</flux:badge>
                                    @else
                                        <flux:badge color="green">{{ __('Responded') }}</flux:badge>
                                    @endif
                                </td>
                                <td class="px-6 py-4"><flux:text class="text-sm text-zinc-500">{{ $submission->created_at->format('M j, Y g:i A') }}</flux:text></td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <flux:button size="sm" :href="route('admin.submissions.show', $submission)" wire:navigate icon="eye">{{ __('View') }}</flux:button>
                                        <flux:button size="sm" variant="danger" wire:click="delete({{ $submission->id }})" wire:confirm="{{ __('Are you sure?') }}" icon="trash">{{ __('Delete') }}</flux:button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="px-6 py-8 text-center"><flux:text class="text-zinc-500">{{ __('No submissions found.') }}</flux:text></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($submissions->hasPages())
                <div class="border-t border-zinc-200 p-4 dark:border-zinc-700">{{ $submissions->links() }}</div>
            @endif
        </div>
    </div>
