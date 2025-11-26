@props(['title' => null])

<x-layouts.admin.sidebar :title="$title">
    <flux:main container>
        {{ $slot }}
    </flux:main>
</x-layouts.admin.sidebar>
