<?php

use App\Models\Page;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new
#[Layout('components.layouts.admin')]
#[Title('Create Page')]
class extends Component {
    public string $title = '';
    public string $slug = '';
    public string $content = '';
    public string $status = 'draft';
    public string $meta_title = '';
    public string $meta_description = '';

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:pages,slug'],
            'content' => ['nullable', 'string'],
            'status' => ['required', 'in:draft,published'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function save(): void
    {
        $validated = $this->validate();

        $page = Page::create([
            ...$validated,
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
            'published_at' => $validated['status'] === 'published' ? now() : null,
        ]);

        session()->flash('success', __('Page created successfully.'));
        $this->redirect(route('admin.pages.edit', $page), navigate: true);
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
        class="flex items-center gap-4"
    >
        <a
            href="{{ route('admin.pages.index') }}"
            wire:navigate
            class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-500 transition-all duration-200 hover:border-slate-300 hover:bg-slate-50 hover:text-slate-700 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-400 dark:hover:border-slate-600 dark:hover:bg-slate-700"
        >
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">{{ __('Create Page') }}</h1>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ __('Add a new page to your website') }}</p>
        </div>
    </div>

    <form wire:submit="save" class="space-y-6">
        <div
            x-show="shown"
            x-transition:enter="transition ease-out duration-500 delay-100"
            x-transition:enter-start="opacity-0 translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            class="grid gap-6 lg:grid-cols-3"
        >
            <!-- Main Content -->
            <div class="space-y-6 lg:col-span-2">
                <div class="overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">
                    <div class="border-b border-slate-200/80 px-6 py-4 dark:border-slate-800">
                        <h2 class="font-semibold text-slate-900 dark:text-white">{{ __('Page Content') }}</h2>
                    </div>
                    <div class="space-y-5 p-6">
                        <!-- Title -->
                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">
                                {{ __('Title') }} <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                wire:model="title"
                                placeholder="{{ __('Page title') }}"
                                class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 transition-all duration-200 placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 dark:focus:border-blue-500"
                            />
                            @error('title')
                                <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Slug -->
                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">
                                {{ __('Slug') }}
                            </label>
                            <input
                                type="text"
                                wire:model="slug"
                                placeholder="{{ __('auto-generated-from-title') }}"
                                class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 transition-all duration-200 placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 dark:focus:border-blue-500"
                            />
                            <p class="mt-1.5 text-xs text-slate-500 dark:text-slate-400">{{ __('Leave empty to auto-generate from title.') }}</p>
                            @error('slug')
                                <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Content -->
                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">
                                {{ __('Content') }}
                            </label>
                            <textarea
                                wire:model="content"
                                rows="15"
                                placeholder="{{ __('Page content...') }}"
                                class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 transition-all duration-200 placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 dark:focus:border-blue-500"
                            ></textarea>
                            @error('content')
                                <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Publish Settings -->
                <div class="overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">
                    <div class="border-b border-slate-200/80 px-6 py-4 dark:border-slate-800">
                        <h2 class="font-semibold text-slate-900 dark:text-white">{{ __('Publish') }}</h2>
                    </div>
                    <div class="space-y-5 p-6">
                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">
                                {{ __('Status') }}
                            </label>
                            <select
                                wire:model="status"
                                class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 transition-all duration-200 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:focus:border-blue-500"
                            >
                                <option value="draft">{{ __('Draft') }}</option>
                                <option value="published">{{ __('Published') }}</option>
                            </select>
                        </div>

                        <button
                            type="submit"
                            class="w-full rounded-xl bg-gradient-to-r from-blue-600 to-cyan-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-500/30 transition-all duration-300 hover:scale-[1.02] hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-blue-500/20"
                        >
                            {{ __('Create Page') }}
                        </button>
                    </div>
                </div>

                <!-- SEO Settings -->
                <div class="overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">
                    <div class="border-b border-slate-200/80 px-6 py-4 dark:border-slate-800">
                        <div class="flex items-center gap-2">
                            <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <h2 class="font-semibold text-slate-900 dark:text-white">{{ __('SEO') }}</h2>
                        </div>
                    </div>
                    <div class="space-y-5 p-6">
                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">
                                {{ __('Meta Title') }}
                            </label>
                            <input
                                type="text"
                                wire:model="meta_title"
                                placeholder="{{ __('SEO title') }}"
                                class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 transition-all duration-200 placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 dark:focus:border-blue-500"
                            />
                            @error('meta_title')
                                <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">
                                {{ __('Meta Description') }}
                            </label>
                            <textarea
                                wire:model="meta_description"
                                rows="3"
                                placeholder="{{ __('SEO description') }}"
                                class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 transition-all duration-200 placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 dark:focus:border-blue-500"
                            ></textarea>
                            @error('meta_description')
                                <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
