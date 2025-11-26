<?php

use App\Models\HeroSection;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new
#[Layout('components.layouts.admin')]
#[Title('Edit Hero Section')]
class extends Component {
    public HeroSection $heroSection;

    public string $name = '';
    public string $title = '';
    public string $subtitle = '';
    public string $cta_text = '';
    public string $cta_url = '';
    public string $cta_secondary_text = '';
    public string $cta_secondary_url = '';
    public string $status = 'draft';

    public function mount(HeroSection $heroSection): void
    {
        $this->heroSection = $heroSection;
        $this->fill($heroSection->only(['name', 'title', 'status']));
        $this->subtitle = $heroSection->subtitle ?? '';
        $this->cta_text = $heroSection->cta_text ?? '';
        $this->cta_url = $heroSection->cta_url ?? '';
        $this->cta_secondary_text = $heroSection->cta_secondary_text ?? '';
        $this->cta_secondary_url = $heroSection->cta_secondary_url ?? '';
    }

    public function save(): void
    {
        $this->heroSection->update($this->validate());
        session()->flash('success', __('Hero section updated successfully.'));
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string'],
            'cta_text' => ['nullable', 'string', 'max:255'],
            'cta_url' => ['nullable', 'string', 'max:255'],
            'cta_secondary_text' => ['nullable', 'string', 'max:255'],
            'cta_secondary_url' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'in:draft,published'],
        ];
    }
}; ?>

<div class="space-y-6">
        <div class="flex items-center gap-4">
            <flux:button :href="route('admin.hero.index')" wire:navigate icon="arrow-left" variant="ghost">{{ __('Back') }}</flux:button>
            <flux:heading size="xl">{{ __('Edit Hero Section') }}</flux:heading>
        </div>

        @if (session('success'))
            <flux:callout variant="success" icon="check-circle">{{ session('success') }}</flux:callout>
        @endif

        <form wire:submit="save" class="space-y-6">
            <div class="grid gap-6 lg:grid-cols-3">
                <div class="space-y-6 lg:col-span-2">
                    <div class="rounded-lg border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
                        <div class="space-y-4">
                            <flux:field>
                                <flux:label>{{ __('Name (Internal)') }}</flux:label>
                                <flux:input wire:model="name" />
                                <flux:error name="name" />
                            </flux:field>
                            <flux:field>
                                <flux:label>{{ __('Title') }}</flux:label>
                                <flux:input wire:model="title" />
                                <flux:error name="title" />
                            </flux:field>
                            <flux:field>
                                <flux:label>{{ __('Subtitle') }}</flux:label>
                                <flux:textarea wire:model="subtitle" rows="3" />
                            </flux:field>
                            <div class="grid gap-4 sm:grid-cols-2">
                                <flux:field>
                                    <flux:label>{{ __('Primary Button Text') }}</flux:label>
                                    <flux:input wire:model="cta_text" />
                                </flux:field>
                                <flux:field>
                                    <flux:label>{{ __('Primary Button URL') }}</flux:label>
                                    <flux:input wire:model="cta_url" />
                                </flux:field>
                            </div>
                            <div class="grid gap-4 sm:grid-cols-2">
                                <flux:field>
                                    <flux:label>{{ __('Secondary Button Text') }}</flux:label>
                                    <flux:input wire:model="cta_secondary_text" />
                                </flux:field>
                                <flux:field>
                                    <flux:label>{{ __('Secondary Button URL') }}</flux:label>
                                    <flux:input wire:model="cta_secondary_url" />
                                </flux:field>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="space-y-6">
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
                            <flux:button type="submit" variant="primary" class="w-full">{{ __('Save Changes') }}</flux:button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
