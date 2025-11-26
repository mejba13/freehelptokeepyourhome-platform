<?php

use App\Models\Banner;
use App\Models\CallToAction;
use App\Models\HeroSection;
use App\Models\SiteSetting;

test('hero section published scope works', function () {
    HeroSection::create(['name' => 'Main', 'title' => 'Welcome', 'status' => 'published']);
    HeroSection::create(['name' => 'Draft', 'title' => 'Draft Hero', 'status' => 'draft']);

    expect(HeroSection::published()->count())->toBe(1);
});

test('banner active scope works', function () {
    Banner::create([
        'name' => 'Active',
        'title' => 'Active Banner',
        'status' => 'published',
        'start_date' => now()->subDay(),
        'end_date' => now()->addDay(),
    ]);
    Banner::create([
        'name' => 'Expired',
        'title' => 'Expired Banner',
        'status' => 'published',
        'start_date' => now()->subWeek(),
        'end_date' => now()->subDay(),
    ]);

    expect(Banner::active()->count())->toBe(1);
    expect(Banner::active()->first()->name)->toBe('Active');
});

test('call to action published scope works', function () {
    CallToAction::create(['name' => 'CTA 1', 'title' => 'Published CTA', 'status' => 'published']);
    CallToAction::create(['name' => 'CTA 2', 'title' => 'Draft CTA', 'status' => 'draft']);

    expect(CallToAction::published()->count())->toBe(1);
});

test('site setting can be set and retrieved', function () {
    SiteSetting::set('test_key', 'test_value', 'general');
    // Clear cache for testing
    cache()->forget('site_setting_test_key');

    $setting = SiteSetting::where('key', 'test_key')->first();
    expect($setting->value)->toBe('test_value');
});

test('site setting returns default when not found', function () {
    expect(SiteSetting::get('nonexistent', 'default'))->toBe('default');
});
