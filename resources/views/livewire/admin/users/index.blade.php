<?php

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new
#[Layout('components.layouts.admin')]
#[Title('Users')]
class extends Component {
    use WithPagination;

    public string $search = '';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function with(): array
    {
        return [
            'users' => User::query()
                ->when($this->search, fn ($q) => $q->where('name', 'like', "%{$this->search}%")->orWhere('email', 'like', "%{$this->search}%"))
                ->with('roles')
                ->latest()
                ->paginate(15),
        ];
    }
}; ?>

<div class="space-y-6">
    <div class="flex items-center justify-between">
        <flux:heading size="xl">{{ __('Users') }}</flux:heading>
    </div>

    <div class="rounded-lg border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-900">
        <div class="border-b border-zinc-200 p-4 dark:border-zinc-700">
            <flux:input wire:model.live.debounce.300ms="search" placeholder="{{ __('Search users...') }}" icon="magnifying-glass" class="max-w-sm" />
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-800">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-zinc-500">{{ __('User') }}</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-zinc-500">{{ __('Email') }}</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-zinc-500">{{ __('Roles') }}</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-zinc-500">{{ __('Joined') }}</th>
                        <th class="px-6 py-3 text-right text-sm font-medium text-zinc-500">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                    @forelse ($users as $user)
                        <tr wire:key="user-{{ $user->id }}">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-zinc-200 text-sm font-medium dark:bg-zinc-700">
                                        {{ strtoupper(substr($user->name, 0, 2)) }}
                                    </div>
                                    <flux:text class="font-medium">{{ $user->name }}</flux:text>
                                </div>
                            </td>
                            <td class="px-6 py-4"><flux:text class="text-sm text-zinc-500">{{ $user->email }}</flux:text></td>
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-1">
                                    @forelse ($user->roles as $role)
                                        <flux:badge color="{{ $role->name === 'admin' ? 'red' : 'blue' }}">{{ ucfirst($role->name) }}</flux:badge>
                                    @empty
                                        <flux:badge color="zinc">{{ __('No role') }}</flux:badge>
                                    @endforelse
                                </div>
                            </td>
                            <td class="px-6 py-4"><flux:text class="text-sm text-zinc-500">{{ $user->created_at->format('M j, Y') }}</flux:text></td>
                            <td class="px-6 py-4 text-right">
                                <flux:button size="sm" :href="route('admin.users.edit', $user)" wire:navigate icon="pencil">{{ __('Edit') }}</flux:button>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-6 py-8 text-center"><flux:text class="text-zinc-500">{{ __('No users found.') }}</flux:text></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($users->hasPages())
            <div class="border-t border-zinc-200 p-4 dark:border-zinc-700">{{ $users->links() }}</div>
        @endif
    </div>
</div>
