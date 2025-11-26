<?php

use App\Models\Page;
use App\Models\Testimonial;

test('page model generates slug correctly', function () {
    $page = Page::create([
        'title' => 'Test Page Title',
        'content' => 'Test content',
        'status' => 'published',
    ]);

    expect($page->slug)->toBe('test-page-title');
});

test('page model published scope works', function () {
    Page::create(['title' => 'Published Page', 'content' => 'Content', 'status' => 'published']);
    Page::create(['title' => 'Draft Page', 'content' => 'Content', 'status' => 'draft']);

    expect(Page::published()->count())->toBe(1);
    expect(Page::published()->first()->title)->toBe('Published Page');
});

test('testimonial model generates slug from author name', function () {
    $testimonial = Testimonial::create([
        'author_name' => 'Jane Smith',
        'content' => 'Great service!',
        'status' => 'published',
    ]);

    expect($testimonial->slug)->toBe('jane-smith');
});

test('testimonial model featured scope works', function () {
    Testimonial::create([
        'author_name' => 'Featured User',
        'content' => 'Featured testimonial',
        'featured' => true,
        'status' => 'published',
    ]);
    Testimonial::create([
        'author_name' => 'Normal User',
        'content' => 'Normal testimonial',
        'featured' => false,
        'status' => 'published',
    ]);

    expect(Testimonial::published()->featured()->count())->toBe(1);
    expect(Testimonial::published()->featured()->first()->author_name)->toBe('Featured User');
});
