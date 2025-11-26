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

<div
    x-data="{ shown: false }"
    x-init="setTimeout(() => shown = true, 100)"
    class="space-y-6"
>
    <!-- Page Header -->
    <div
        x-show="shown"
        x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="opacity-0 -translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between"
    >
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">{{ __('Users') }}</h1>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ __('Manage user accounts and permissions') }}</p>
        </div>
    </div>

    <!-- Content Card -->
    <div
        x-show="shown"
        x-transition:enter="transition ease-out duration-500 delay-100"
        x-transition:enter-start="opacity-0 translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        class="overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900"
    >
        <!-- Search Bar -->
        <div class="border-b border-slate-200/80 p-4 dark:border-slate-800">
            <div class="relative max-w-sm">
                <svg class="absolute left-3 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input
                    type="text"
                    wire:model.live.debounce.300ms="search"
                    placeholder="{{ __('Search users...') }}"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 py-2.5 pl-10 pr-4 text-sm text-slate-900 transition-all duration-200 placeholder:text-slate-400 focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 dark:focus:border-blue-500 dark:focus:bg-slate-800"
                />
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="border-b border-slate-200/80 bg-slate-50/50 dark:border-slate-800 dark:bg-slate-800/50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">{{ __('User') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">{{ __('Email') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">{{ __('Roles') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">{{ __('Joined') }}</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200/80 dark:divide-slate-800">
                    @forelse ($users as $user)
                        <tr wire:key="user-{{ $user->id }}" class="group transition-colors hover:bg-slate-50/50 dark:hover:bg-slate-800/30">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-gradient-to-br from-blue-500 to-cyan-500 text-sm font-semibold text-white shadow-lg shadow-blue-500/20">
                                        {{ strtoupper(substr($user->name, 0, 2)) }}
                                    </div>
                                    <span class="font-medium text-slate-900 dark:text-white">{{ $user->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm text-slate-500 dark:text-slate-400">{{ $user->email }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-1.5">
                                    @forelse ($user->roles as $role)
                                        @if($role->name === 'admin')
                                            <span class="inline-flex items-center gap-1 rounded-full bg-red-500/10 px-2.5 py-1 text-xs font-medium text-red-600 dark:bg-red-500/20 dark:text-red-400">
                                                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                                </svg>
                                                {{ ucfirst($role->name) }}
                                            </span>
                                        @else
                                            <span class="inline-flex items-center rounded-full bg-blue-500/10 px-2.5 py-1 text-xs font-medium text-blue-600 dark:bg-blue-500/20 dark:text-blue-400">
                                                {{ ucfirst($role->name) }}
                                            </span>
                                        @endif
                                    @empty
                                        <span class="inline-flex items-center rounded-full bg-slate-500/10 px-2.5 py-1 text-xs font-medium text-slate-500 dark:bg-slate-500/20 dark:text-slate-400">
                                            {{ __('No role') }}
                                        </span>
                                    @endforelse
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm text-slate-500 dark:text-slate-400">{{ $user->created_at->format('M j, Y') }}</span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a
                                    href="{{ route('admin.users.edit', $user) }}"
                                    wire:navigate
                                    class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs font-medium text-slate-600 transition-all duration-200 hover:border-slate-300 hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-400 dark:hover:border-slate-600 dark:hover:bg-slate-700"
                                >
                                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    {{ __('Edit') }}
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100 dark:bg-slate-800">
                                        <svg class="h-8 w-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                        </svg>
                                    </div>
                                    <h3 class="mt-4 font-medium text-slate-900 dark:text-white">{{ __('No users found') }}</h3>
                                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ __('No users match your search criteria.') }}</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($users->hasPages())
            <div class="border-t border-slate-200/80 px-6 py-4 dark:border-slate-800">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>
