<?php

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;
use Spatie\Permission\Models\Role;

new
#[Layout('components.layouts.admin')]
#[Title('Edit User')]
class extends Component {
    public User $user;
    public array $selectedRoles = [];

    public function mount(User $user): void
    {
        $this->user = $user;
        $this->selectedRoles = $user->roles->pluck('name')->toArray();
    }

    public function save(): void
    {
        $this->user->syncRoles($this->selectedRoles);
        session()->flash('success', __('User roles updated successfully.'));
    }

    public function with(): array
    {
        return [
            'roles' => Role::all(),
        ];
    }
}; ?>

<div class="space-y-6">
    <div class="flex items-center gap-4">
        <flux:button :href="route('admin.users.index')" wire:navigate icon="arrow-left" variant="ghost">{{ __('Back') }}</flux:button>
        <flux:heading size="xl">{{ __('Edit User') }}</flux:heading>
    </div>

    @if (session('success'))
        <flux:callout variant="success" icon="check-circle">{{ session('success') }}</flux:callout>
    @endif

    <div class="grid gap-6 lg:grid-cols-3">
        <div class="space-y-6 lg:col-span-2">
            <div class="rounded-lg border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
                <flux:heading size="lg" class="mb-4">{{ __('User Information') }}</flux:heading>
                <div class="space-y-4">
                    <div class="flex items-center gap-4">
                        <div class="flex h-16 w-16 items-center justify-center rounded-full bg-zinc-200 text-xl font-medium dark:bg-zinc-700">
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        </div>
                        <div>
                            <flux:text class="text-lg font-medium">{{ $user->name }}</flux:text>
                            <flux:text class="text-zinc-500">{{ $user->email }}</flux:text>
                        </div>
                    </div>
                    <div class="grid gap-4 pt-4 sm:grid-cols-2">
                        <div>
                            <flux:text class="text-sm text-zinc-500">{{ __('Joined') }}</flux:text>
                            <flux:text>{{ $user->created_at->format('F j, Y') }}</flux:text>
                        </div>
                        <div>
                            <flux:text class="text-sm text-zinc-500">{{ __('Email Verified') }}</flux:text>
                            <flux:text>{{ $user->email_verified_at ? $user->email_verified_at->format('F j, Y') : __('Not verified') }}</flux:text>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <form wire:submit="save">
                <div class="rounded-lg border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
                    <flux:heading size="lg" class="mb-4">{{ __('Roles') }}</flux:heading>
                    <div class="space-y-3">
                        @foreach ($roles as $role)
                            <label class="flex items-center gap-3">
                                <flux:checkbox wire:model="selectedRoles" value="{{ $role->name }}" />
                                <span class="text-sm font-medium">{{ ucfirst($role->name) }}</span>
                            </label>
                        @endforeach
                    </div>
                    <flux:button type="submit" variant="primary" class="mt-6 w-full">{{ __('Save Roles') }}</flux:button>
                </div>
            </form>

            <div class="rounded-lg border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
                <flux:heading size="lg" class="mb-4">{{ __('Permissions') }}</flux:heading>
                <div class="space-y-2">
                    @forelse ($user->getAllPermissions() as $permission)
                        <flux:badge color="zinc" class="mr-1">{{ $permission->name }}</flux:badge>
                    @empty
                        <flux:text class="text-sm text-zinc-500">{{ __('No permissions assigned.') }}</flux:text>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
