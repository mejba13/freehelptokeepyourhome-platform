<?php

use App\Models\CallToAction;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new
#[Layout('components.layouts.admin')]
#[Title('Add CTA')]
class extends Component {
    public string $name = '';
    public string $title = '';
    public string $description = '';
    public string $button_text = '';
    public string $button_url = '';
    public string $style = 'primary';
    public string $icon = '';
    public string $status = 'draft';

    public function save(): void
    {
        $cta = CallToAction::create($this->validate());
        session()->flash('success', __('CTA created successfully.'));
        $this->redirect(route('admin.ctas.edit', $cta), navigate: true);
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'button_text' => ['nullable', 'string', 'max:255'],
            'button_url' => ['nullable', 'string', 'max:255'],
            'style' => ['required', 'in:primary,secondary,accent'],
            'icon' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'in:draft,published'],
        ];
    }
}; ?>

<div class="space-y-6">
        <div class="flex items-center gap-4">
            <flux:button :href="route('admin.ctas.index')" wire:navigate icon="arrow-left" variant="ghost">{{ __('Back') }}</flux:button>
            <flux:heading size="xl">{{ __('Add CTA') }}</flux:heading>
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
                            <flux:field><flux:label>{{ __('Icon (Heroicon name)') }}</flux:label><flux:input wire:model="icon" placeholder="phone" /></flux:field>
                        </div>
                    </div>
                </div>
                <div class="space-y-6">
                    <div class="rounded-lg border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
                        <flux:heading size="lg" class="mb-4">{{ __('Settings') }}</flux:heading>
                        <div class="space-y-4">
                            <flux:field><flux:label>{{ __('Style') }}</flux:label>
                                <flux:select wire:model="style">
                                    <flux:select.option value="primary">{{ __('Primary') }}</flux:select.option>
                                    <flux:select.option value="secondary">{{ __('Secondary') }}</flux:select.option>
                                    <flux:select.option value="accent">{{ __('Accent') }}</flux:select.option>
                                </flux:select>
                            </flux:field>
                            <flux:field><flux:label>{{ __('Status') }}</flux:label>
                                <flux:select wire:model="status">
                                    <flux:select.option value="draft">{{ __('Draft') }}</flux:select.option>
                                    <flux:select.option value="published">{{ __('Published') }}</flux:select.option>
                                </flux:select>
                            </flux:field>
                            <flux:button type="submit" variant="primary" class="w-full">{{ __('Create CTA') }}</flux:button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
