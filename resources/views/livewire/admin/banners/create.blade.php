<?php

use App\Models\Banner;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new
#[Layout('components.layouts.admin')]
#[Title('Add Banner')]
class extends Component {
    public string $name = '';
    public string $title = '';
    public string $description = '';
    public string $button_text = '';
    public string $button_url = '';
    public string $position = 'inline';
    public string $status = 'draft';

    public function save(): void
    {
        $banner = Banner::create($this->validate());
        session()->flash('success', __('Banner created successfully.'));
        $this->redirect(route('admin.banners.edit', $banner), navigate: true);
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'button_text' => ['nullable', 'string', 'max:255'],
            'button_url' => ['nullable', 'string', 'max:255'],
            'position' => ['required', 'in:top,bottom,inline'],
            'status' => ['required', 'in:draft,published'],
        ];
    }
}; ?>

<div class="space-y-6">
        <div class="flex items-center gap-4">
            <flux:button :href="route('admin.banners.index')" wire:navigate icon="arrow-left" variant="ghost">{{ __('Back') }}</flux:button>
            <flux:heading size="xl">{{ __('Add Banner') }}</flux:heading>
        </div>

        <form wire:submit="save" class="space-y-6">
            <div class="grid gap-6 lg:grid-cols-3">
                <div class="space-y-6 lg:col-span-2">
                    <div class="rounded-lg border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
                        <div class="space-y-4">
                            <flux:field><flux:label>{{ __('Name (Internal)') }}</flux:label><flux:input wire:model="name" /><flux:error name="name" /></flux:field>
                            <flux:field><flux:label>{{ __('Title') }}</flux:label><flux:input wire:model="title" /><flux:error name="title" /></flux:field>
                            <flux:field><flux:label>{{ __('Description') }}</flux:label><flux:textarea wire:model="description" rows="3" /></flux:field>
                            <div class="grid gap-4 sm:grid-cols-2">
                                <flux:field><flux:label>{{ __('Button Text') }}</flux:label><flux:input wire:model="button_text" /></flux:field>
                                <flux:field><flux:label>{{ __('Button URL') }}</flux:label><flux:input wire:model="button_url" /></flux:field>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="space-y-6">
                    <div class="rounded-lg border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
                        <flux:heading size="lg" class="mb-4">{{ __('Settings') }}</flux:heading>
                        <div class="space-y-4">
                            <flux:field><flux:label>{{ __('Position') }}</flux:label>
                                <flux:select wire:model="position">
                                    <flux:select.option value="top">{{ __('Top') }}</flux:select.option>
                                    <flux:select.option value="bottom">{{ __('Bottom') }}</flux:select.option>
                                    <flux:select.option value="inline">{{ __('Inline') }}</flux:select.option>
                                </flux:select>
                            </flux:field>
                            <flux:field><flux:label>{{ __('Status') }}</flux:label>
                                <flux:select wire:model="status">
                                    <flux:select.option value="draft">{{ __('Draft') }}</flux:select.option>
                                    <flux:select.option value="published">{{ __('Published') }}</flux:select.option>
                                </flux:select>
                            </flux:field>
                            <flux:button type="submit" variant="primary" class="w-full">{{ __('Create Banner') }}</flux:button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
