@php
    use App\Models\SiteSetting;
    $siteName = SiteSetting::get('site_name', 'Free Help To Keep Your Home');
@endphp

<div class="flex items-center gap-3">
    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-blue-500 to-cyan-500 shadow-lg shadow-blue-500/25">
        <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
        </svg>
    </div>
    <span class="truncate text-base font-bold leading-tight text-slate-900 dark:text-white">{{ Str::limit($siteName, 20) }}</span>
</div>
