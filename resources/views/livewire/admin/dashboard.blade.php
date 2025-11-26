<?php

use App\Models\Page;
use App\Models\Testimonial;
use App\Models\ContactSubmission;
use App\Models\HeroSection;
use App\Models\Banner;
use App\Models\CallToAction;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new
#[Layout('components.layouts.admin')]
#[Title('Admin Dashboard')]
class extends Component {
    public function with(): array
    {
        return [
            'stats' => [
                'pages' => Page::count(),
                'testimonials' => Testimonial::count(),
                'hero_sections' => HeroSection::count(),
                'banners' => Banner::count(),
                'ctas' => CallToAction::count(),
                'new_submissions' => ContactSubmission::new()->count(),
            ],
            'recentSubmissions' => ContactSubmission::latest()->take(5)->get(),
        ];
    }
}; ?>

<div class="space-y-6">
        <div class="flex items-center justify-between">
            <flux:heading size="xl">{{ __('Dashboard') }}</flux:heading>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
            <a href="{{ route('admin.pages.index') }}" wire:navigate class="rounded-lg border border-zinc-200 bg-white p-6 transition hover:shadow-md dark:border-zinc-700 dark:bg-zinc-900">
                <div class="flex items-center justify-between">
                    <div>
                        <flux:text class="text-zinc-500">{{ __('Pages') }}</flux:text>
                        <flux:heading size="xl">{{ $stats['pages'] }}</flux:heading>
                    </div>
                    <flux:icon name="document-text" class="h-8 w-8 text-zinc-400" />
                </div>
            </a>

            <a href="{{ route('admin.testimonials.index') }}" wire:navigate class="rounded-lg border border-zinc-200 bg-white p-6 transition hover:shadow-md dark:border-zinc-700 dark:bg-zinc-900">
                <div class="flex items-center justify-between">
                    <div>
                        <flux:text class="text-zinc-500">{{ __('Testimonials') }}</flux:text>
                        <flux:heading size="xl">{{ $stats['testimonials'] }}</flux:heading>
                    </div>
                    <flux:icon name="chat-bubble-left-right" class="h-8 w-8 text-zinc-400" />
                </div>
            </a>

            <a href="{{ route('admin.submissions.index') }}" wire:navigate class="rounded-lg border border-zinc-200 bg-white p-6 transition hover:shadow-md dark:border-zinc-700 dark:bg-zinc-900">
                <div class="flex items-center justify-between">
                    <div>
                        <flux:text class="text-zinc-500">{{ __('New Submissions') }}</flux:text>
                        <flux:heading size="xl">{{ $stats['new_submissions'] }}</flux:heading>
                    </div>
                    <flux:icon name="envelope" class="h-8 w-8 text-zinc-400" />
                </div>
            </a>

            <a href="{{ route('admin.hero.index') }}" wire:navigate class="rounded-lg border border-zinc-200 bg-white p-6 transition hover:shadow-md dark:border-zinc-700 dark:bg-zinc-900">
                <div class="flex items-center justify-between">
                    <div>
                        <flux:text class="text-zinc-500">{{ __('Hero Sections') }}</flux:text>
                        <flux:heading size="xl">{{ $stats['hero_sections'] }}</flux:heading>
                    </div>
                    <flux:icon name="photo" class="h-8 w-8 text-zinc-400" />
                </div>
            </a>

            <a href="{{ route('admin.banners.index') }}" wire:navigate class="rounded-lg border border-zinc-200 bg-white p-6 transition hover:shadow-md dark:border-zinc-700 dark:bg-zinc-900">
                <div class="flex items-center justify-between">
                    <div>
                        <flux:text class="text-zinc-500">{{ __('Banners') }}</flux:text>
                        <flux:heading size="xl">{{ $stats['banners'] }}</flux:heading>
                    </div>
                    <flux:icon name="megaphone" class="h-8 w-8 text-zinc-400" />
                </div>
            </a>

            <a href="{{ route('admin.ctas.index') }}" wire:navigate class="rounded-lg border border-zinc-200 bg-white p-6 transition hover:shadow-md dark:border-zinc-700 dark:bg-zinc-900">
                <div class="flex items-center justify-between">
                    <div>
                        <flux:text class="text-zinc-500">{{ __('CTAs') }}</flux:text>
                        <flux:heading size="xl">{{ $stats['ctas'] }}</flux:heading>
                    </div>
                    <flux:icon name="cursor-arrow-rays" class="h-8 w-8 text-zinc-400" />
                </div>
            </a>
        </div>

        <!-- Recent Submissions -->
        <div class="rounded-lg border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-900">
            <div class="border-b border-zinc-200 px-6 py-4 dark:border-zinc-700">
                <flux:heading size="lg">{{ __('Recent Form Submissions') }}</flux:heading>
            </div>
            <div class="divide-y divide-zinc-200 dark:divide-zinc-700">
                @forelse ($recentSubmissions as $submission)
                    <a href="{{ route('admin.submissions.show', $submission) }}" wire:navigate class="flex items-center justify-between px-6 py-4 transition hover:bg-zinc-50 dark:hover:bg-zinc-800">
                        <div>
                            <flux:text class="font-medium">{{ $submission->name }}</flux:text>
                            <flux:text class="text-sm text-zinc-500">{{ $submission->email }}</flux:text>
                        </div>
                        <div class="flex items-center gap-2">
                            @if ($submission->status === 'new')
                                <flux:badge color="red">{{ __('New') }}</flux:badge>
                            @elseif ($submission->status === 'read')
                                <flux:badge color="amber">{{ __('Read') }}</flux:badge>
                            @else
                                <flux:badge color="green">{{ __('Responded') }}</flux:badge>
                            @endif
                            <flux:text class="text-sm text-zinc-500">{{ $submission->created_at->diffForHumans() }}</flux:text>
                        </div>
                    </a>
                @empty
                    <div class="px-6 py-8 text-center">
                        <flux:text class="text-zinc-500">{{ __('No form submissions yet.') }}</flux:text>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="rounded-lg border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:heading size="lg" class="mb-4">{{ __('Quick Actions') }}</flux:heading>
            <div class="flex flex-wrap gap-3">
                <flux:button :href="route('admin.pages.create')" wire:navigate icon="plus">{{ __('New Page') }}</flux:button>
                <flux:button :href="route('admin.testimonials.create')" wire:navigate icon="plus">{{ __('New Testimonial') }}</flux:button>
                <flux:button :href="route('admin.hero.create')" wire:navigate icon="plus">{{ __('New Hero') }}</flux:button>
                <flux:button :href="route('admin.banners.create')" wire:navigate icon="plus">{{ __('New Banner') }}</flux:button>
                <flux:button :href="route('admin.ctas.create')" wire:navigate icon="plus">{{ __('New CTA') }}</flux:button>
            </div>
        </div>
    </div>
</div>
