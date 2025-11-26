<?php

use App\Models\Page;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new
#[Layout('components.layouts.public')]
class extends Component {
    public Page $page;

    public function mount(Page $page): void
    {
        if ($page->status !== 'published') {
            abort(404);
        }
        $this->page = $page;
    }
}; ?>

<div>
    <!-- Hero -->
    <section class="bg-gradient-to-br from-blue-600 to-blue-800 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-bold text-white sm:text-5xl">{{ $page->title }}</h1>
            </div>
        </div>
    </section>

    <!-- Content -->
    <section class="py-16 lg:py-24">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <article class="prose prose-lg prose-zinc mx-auto dark:prose-invert">
                {!! $page->content !!}
            </article>
        </div>
    </section>

    <!-- CTA -->
    <section class="border-t border-zinc-200 bg-zinc-50 py-16 dark:border-zinc-800 dark:bg-zinc-900">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-2xl font-bold text-zinc-900 dark:text-white">{{ __('Need Assistance?') }}</h2>
                <p class="mx-auto mt-4 max-w-xl text-zinc-600 dark:text-zinc-400">{{ __('Contact us today for free, confidential housing counseling.') }}</p>
                <div class="mt-8">
                    <flux:button variant="primary" :href="route('contact')" wire:navigate>{{ __('Contact Us') }}</flux:button>
                </div>
            </div>
        </div>
    </section>
</div>
