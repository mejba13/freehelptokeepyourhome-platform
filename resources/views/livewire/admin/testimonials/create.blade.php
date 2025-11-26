<?php

use App\Models\Testimonial;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new
#[Layout('components.layouts.admin')]
#[Title('Add Testimonial')]
class extends Component {
    public string $author_name = '';
    public string $author_title = '';
    public string $author_location = '';
    public string $content = '';
    public int $rating = 5;
    public bool $featured = false;
    public string $status = 'draft';

    public function rules(): array
    {
        return [
            'author_name' => ['required', 'string', 'max:255'],
            'author_title' => ['nullable', 'string', 'max:255'],
            'author_location' => ['nullable', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'featured' => ['boolean'],
            'status' => ['required', 'in:draft,published'],
        ];
    }

    public function save(): void
    {
        $validated = $this->validate();
        $testimonial = Testimonial::create($validated);

        session()->flash('success', __('Testimonial created successfully.'));
        $this->redirect(route('admin.testimonials.edit', $testimonial), navigate: true);
    }
}; ?>

<div class="space-y-6">
        <div class="flex items-center gap-4">
            <flux:button :href="route('admin.testimonials.index')" wire:navigate icon="arrow-left" variant="ghost">
                {{ __('Back') }}
            </flux:button>
            <flux:heading size="xl">{{ __('Add Testimonial') }}</flux:heading>
        </div>

        <form wire:submit="save" class="space-y-6">
            <div class="grid gap-6 lg:grid-cols-3">
                <div class="space-y-6 lg:col-span-2">
                    <div class="rounded-lg border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
                        <div class="space-y-4">
                            <flux:field>
                                <flux:label>{{ __('Author Name') }}</flux:label>
                                <flux:input wire:model="author_name" placeholder="{{ __('John Doe') }}" />
                                <flux:error name="author_name" />
                            </flux:field>

                            <div class="grid gap-4 sm:grid-cols-2">
                                <flux:field>
                                    <flux:label>{{ __('Title/Position') }}</flux:label>
                                    <flux:input wire:model="author_title" placeholder="{{ __('Homeowner') }}" />
                                    <flux:error name="author_title" />
                                </flux:field>

                                <flux:field>
                                    <flux:label>{{ __('Location') }}</flux:label>
                                    <flux:input wire:model="author_location" placeholder="{{ __('Los Angeles, CA') }}" />
                                    <flux:error name="author_location" />
                                </flux:field>
                            </div>

                            <flux:field>
                                <flux:label>{{ __('Testimonial') }}</flux:label>
                                <flux:textarea wire:model="content" rows="6" placeholder="{{ __('What did they say?') }}" />
                                <flux:error name="content" />
                            </flux:field>

                            <flux:field>
                                <flux:label>{{ __('Rating') }}</flux:label>
                                <flux:select wire:model="rating">
                                    @for ($i = 5; $i >= 1; $i--)
                                        <flux:select.option value="{{ $i }}">{{ $i }} {{ __('Stars') }}</flux:select.option>
                                    @endfor
                                </flux:select>
                                <flux:error name="rating" />
                            </flux:field>
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

                            <flux:field>
                                <flux:checkbox wire:model="featured" label="{{ __('Featured testimonial') }}" />
                            </flux:field>

                            <flux:button type="submit" variant="primary" class="w-full">
                                {{ __('Create Testimonial') }}
                            </flux:button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
