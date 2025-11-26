<?php

use App\Models\Testimonial;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new
#[Layout('components.layouts.public')]
#[Title('Testimonials')]
class extends Component {
    use WithPagination;

    public function with(): array
    {
        return [
            'testimonials' => Testimonial::published()->ordered()->paginate(9),
        ];
    }
}; ?>

<div>
    <!-- Hero -->
    <section class="bg-gradient-to-br from-blue-600 to-blue-800 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-bold text-white sm:text-5xl">{{ __('Success Stories') }}</h1>
                <p class="mx-auto mt-4 max-w-2xl text-xl text-blue-100">{{ __('Hear from families who kept their homes with our help.') }}</p>
            </div>
        </div>
    </section>

    <!-- Testimonials Grid -->
    <section class="py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @if($testimonials->count() > 0)
                <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($testimonials as $testimonial)
                        <div class="rounded-xl border border-zinc-200 bg-white p-8 shadow-sm dark:border-zinc-700 dark:bg-zinc-900">
                            <!-- Rating -->
                            @if($testimonial->rating)
                                <div class="flex gap-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $testimonial->rating)
                                            <svg class="h-5 w-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        @else
                                            <svg class="h-5 w-5 text-zinc-200 dark:text-zinc-700" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        @endif
                                    @endfor
                                </div>
                            @endif

                            <blockquote class="mt-4 text-zinc-600 dark:text-zinc-400">
                                "{{ $testimonial->content }}"
                            </blockquote>

                            <div class="mt-6 flex items-center gap-4">
                                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-blue-100 text-sm font-medium text-blue-600 dark:bg-blue-900/30">
                                    {{ strtoupper(substr($testimonial->author_name, 0, 2)) }}
                                </div>
                                <div>
                                    <div class="font-medium text-zinc-900 dark:text-white">{{ $testimonial->author_name }}</div>
                                    @if($testimonial->author_title)
                                        <div class="text-sm text-zinc-500">{{ $testimonial->author_title }}</div>
                                    @endif
                                    @if($testimonial->author_location)
                                        <div class="text-sm text-zinc-500">{{ $testimonial->author_location }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if($testimonials->hasPages())
                    <div class="mt-12">{{ $testimonials->links() }}</div>
                @endif
            @else
                <div class="rounded-xl border border-zinc-200 bg-white p-12 text-center dark:border-zinc-700 dark:bg-zinc-900">
                    <x-flux::icon name="chat-bubble-bottom-center-text" class="mx-auto h-12 w-12 text-zinc-400" />
                    <h3 class="mt-4 text-lg font-medium text-zinc-900 dark:text-white">{{ __('No testimonials yet') }}</h3>
                    <p class="mt-2 text-zinc-500">{{ __('Check back soon for success stories from our clients.') }}</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Share Your Story CTA -->
    <section class="border-t border-zinc-200 bg-zinc-50 py-16 dark:border-zinc-800 dark:bg-zinc-900">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-2xl font-bold text-zinc-900 dark:text-white">{{ __('Share Your Story') }}</h2>
                <p class="mx-auto mt-4 max-w-2xl text-zinc-600 dark:text-zinc-400">{{ __('Have we helped you keep your home? We\'d love to hear about your experience. Your story can inspire others facing similar challenges.') }}</p>
                <div class="mt-8">
                    <flux:button variant="primary" :href="route('contact')" wire:navigate>{{ __('Contact Us to Share') }}</flux:button>
                </div>
            </div>
        </div>
    </section>

    <!-- Need Help CTA -->
    <section class="bg-blue-600 py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-bold text-white">{{ __('Need Help Keeping Your Home?') }}</h2>
                <p class="mx-auto mt-4 max-w-xl text-blue-100">{{ __('Our free housing counseling services have helped thousands of families. Let us help you too.') }}</p>
                <div class="mt-8">
                    <flux:button variant="primary" :href="route('contact')" wire:navigate class="bg-white text-blue-600 hover:bg-blue-50">{{ __('Get Free Help Today') }}</flux:button>
                </div>
            </div>
        </div>
    </section>
</div>
