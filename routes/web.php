<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

// Public Routes
Volt::route('/', 'public.home')->name('home');
Volt::route('/about', 'public.about')->name('about');
Volt::route('/services', 'public.services')->name('services');
Volt::route('/why-is-it-free', 'public.why-is-it-free')->name('why-is-it-free');
Volt::route('/testimonials', 'public.testimonials')->name('testimonials');
Volt::route('/contact', 'public.contact')->name('contact');

// Sitemap
Route::get('/sitemap.xml', function () {
    $path = public_path('sitemap.xml');
    if (file_exists($path)) {
        return response()->file($path, ['Content-Type' => 'application/xml']);
    }
    abort(404);
})->name('sitemap');

// Dashboard (redirect to admin for authenticated users)
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

// Admin Routes
Route::middleware(['auth', 'verified', 'role:admin|editor'])->prefix('admin')->name('admin.')->group(function () {
    Volt::route('/', 'admin.dashboard')->name('dashboard');

    // Pages
    Volt::route('pages', 'admin.pages.index')->name('pages.index');
    Volt::route('pages/create', 'admin.pages.create')->name('pages.create');
    Volt::route('pages/{page}/edit', 'admin.pages.edit')->name('pages.edit');

    // Testimonials
    Volt::route('testimonials', 'admin.testimonials.index')->name('testimonials.index');
    Volt::route('testimonials/create', 'admin.testimonials.create')->name('testimonials.create');
    Volt::route('testimonials/{testimonial}/edit', 'admin.testimonials.edit')->name('testimonials.edit');

    // Hero Sections
    Volt::route('hero', 'admin.hero.index')->name('hero.index');
    Volt::route('hero/create', 'admin.hero.create')->name('hero.create');
    Volt::route('hero/{heroSection}/edit', 'admin.hero.edit')->name('hero.edit');

    // Banners
    Volt::route('banners', 'admin.banners.index')->name('banners.index');
    Volt::route('banners/create', 'admin.banners.create')->name('banners.create');
    Volt::route('banners/{banner}/edit', 'admin.banners.edit')->name('banners.edit');

    // CTAs
    Volt::route('ctas', 'admin.ctas.index')->name('ctas.index');
    Volt::route('ctas/create', 'admin.ctas.create')->name('ctas.create');
    Volt::route('ctas/{callToAction}/edit', 'admin.ctas.edit')->name('ctas.edit');

    // Form Submissions
    Volt::route('submissions', 'admin.submissions.index')->name('submissions.index');
    Volt::route('submissions/{submission}', 'admin.submissions.show')->name('submissions.show');

    // Site Settings
    Volt::route('settings', 'admin.settings.index')->name('settings.index');

    // Admin-only routes
    Route::middleware('role:admin')->group(function () {
        Volt::route('users', 'admin.users.index')->name('users.index');
        Volt::route('users/{user}/edit', 'admin.users.edit')->name('users.edit');
    });
});

// Dynamic Pages (must be at the end to avoid catching other routes)
Volt::route('/{page:slug}', 'public.page')->name('page.show');
