<?php

use App\Models\Page;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;
use Illuminate\Validation\Rule;

new
#[Layout('components.layouts.admin')]
#[Title('Edit Page')]
class extends Component {
    public Page $page;

    public string $title = '';
    public string $slug = '';
    public string $content = '';
    public string $status = 'draft';
    public string $meta_title = '';
    public string $meta_description = '';

    public function mount(Page $page): void
    {
        $this->page = $page;
        $this->title = $page->title;
        $this->slug = $page->slug;
        $this->content = $page->content ?? '';
        $this->status = $page->status;
        $this->meta_title = $page->meta_title ?? '';
        $this->meta_description = $page->meta_description ?? '';
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('pages', 'slug')->ignore($this->page->id)],
            'content' => ['nullable', 'string'],
            'status' => ['required', 'in:draft,published'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function save(): void
    {
        $validated = $this->validate();

        $wasPublished = $this->page->status === 'published';
        $isNowPublished = $validated['status'] === 'published';

        $this->page->update([
            ...$validated,
            'updated_by' => auth()->id(),
            'published_at' => $isNowPublished && !$wasPublished ? now() : $this->page->published_at,
        ]);

        session()->flash('success', __('Page updated successfully.'));
    }
}; ?>

<div class="space-y-6">
        <div class="flex items-center gap-4">
            <flux:button :href="route('admin.pages.index')" wire:navigate icon="arrow-left" variant="ghost">
                {{ __('Back') }}
            </flux:button>
            <flux:heading size="xl">{{ __('Edit Page') }}</flux:heading>
        </div>

        @if (session('success'))
            <flux:callout variant="success" icon="check-circle">
                {{ session('success') }}
            </flux:callout>
        @endif

        <form wire:submit="save" class="space-y-6">
            <div class="grid gap-6 lg:grid-cols-3">
                <!-- Main Content -->
                <div class="space-y-6 lg:col-span-2">
                    <div class="rounded-lg border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
                        <div class="space-y-4">
                            <flux:field>
                                <flux:label>{{ __('Title') }}</flux:label>
                                <flux:input wire:model="title" placeholder="{{ __('Page title') }}" />
                                <flux:error name="title" />
                            </flux:field>

                            <flux:field>
                                <flux:label>{{ __('Slug') }}</flux:label>
                                <flux:input wire:model="slug" placeholder="{{ __('page-slug') }}" />
                                <flux:error name="slug" />
                            </flux:field>

                            <flux:field>
                                <flux:label>{{ __('Content') }}</flux:label>
                                <flux:textarea wire:model="content" rows="15" placeholder="{{ __('Page content...') }}" />
                                <flux:error name="content" />
                            </flux:field>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Publish Settings -->
                    <div class="rounded-lg border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
                        <flux:heading size="lg" class="mb-4">{{ __('Publish') }}</flux:heading>
                        <div class="space-y-4">
                            <flux:field>
                                <flux:label>{{ __('Status') }}</flux:label>
                                <flux:select wire:model="status">
                                    <flux:select.option value="draft">{{ __('Draft') }}</flux:select.option>
                                    <flux:select.option value="published">{{ __('Published') }}</flux:select.option>
                                </flux:select>
                            </flux:field>

                            @if ($page->published_at)
                                <flux:text class="text-sm text-zinc-500">
                                    {{ __('Published:') }} {{ $page->published_at->format('M j, Y g:i A') }}
                                </flux:text>
                            @endif

                            <flux:button type="submit" variant="primary" class="w-full">
                                {{ __('Save Changes') }}
                            </flux:button>
                        </div>
                    </div>

                    <!-- SEO Settings -->
                    <div class="rounded-lg border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
                        <flux:heading size="lg" class="mb-4">{{ __('SEO') }}</flux:heading>
                        <div class="space-y-4">
                            <flux:field>
                                <flux:label>{{ __('Meta Title') }}</flux:label>
                                <flux:input wire:model="meta_title" placeholder="{{ __('SEO title') }}" />
                                <flux:error name="meta_title" />
                            </flux:field>

                            <flux:field>
                                <flux:label>{{ __('Meta Description') }}</flux:label>
                                <flux:textarea wire:model="meta_description" rows="3" placeholder="{{ __('SEO description') }}" />
                                <flux:error name="meta_description" />
                            </flux:field>
                        </div>
                    </div>

                    <!-- Info -->
                    <div class="rounded-lg border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
                        <flux:heading size="lg" class="mb-4">{{ __('Info') }}</flux:heading>
                        <div class="space-y-2 text-sm text-zinc-500">
                            <div>{{ __('Created:') }} {{ $page->created_at->format('M j, Y g:i A') }}</div>
                            <div>{{ __('Updated:') }} {{ $page->updated_at->format('M j, Y g:i A') }}</div>
                            @if ($page->createdBy)
                                <div>{{ __('Created by:') }} {{ $page->createdBy->name }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
