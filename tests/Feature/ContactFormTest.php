<?php

use App\Mail\ContactSubmissionNotification;
use App\Models\ContactSubmission;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Mail;

test('contact submission can be created', function () {
    $submission = ContactSubmission::create([
        'form_type' => 'contact',
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'phone' => '1234567890',
        'message' => 'I need help with my mortgage.',
        'status' => 'new',
    ]);

    expect(ContactSubmission::count())->toBe(1);
    expect($submission->name)->toBe('John Doe');
    expect($submission->email)->toBe('john@example.com');
    expect($submission->message)->toBe('I need help with my mortgage.');
    expect($submission->status)->toBe('new');
});

test('contact submission sends email notification when created', function () {
    Mail::fake();

    SiteSetting::set('email', 'admin@example.com', 'contact');

    ContactSubmission::create([
        'form_type' => 'contact',
        'name' => 'Jane Doe',
        'email' => 'jane@example.com',
        'message' => 'Please help me.',
        'status' => 'new',
    ]);

    Mail::assertQueued(ContactSubmissionNotification::class, function ($mail) {
        return $mail->hasTo('admin@example.com');
    });
});

test('contact submission can be marked as read', function () {
    $submission = ContactSubmission::create([
        'form_type' => 'contact',
        'name' => 'Test',
        'email' => 'test@example.com',
        'message' => 'Message',
        'status' => 'new',
    ]);

    $submission->markAsRead();

    expect($submission->fresh()->status)->toBe('read');
});

test('contact submission can be marked as responded', function () {
    $submission = ContactSubmission::create([
        'form_type' => 'contact',
        'name' => 'Test',
        'email' => 'test@example.com',
        'message' => 'Message',
        'status' => 'read',
    ]);

    $submission->markAsResponded();

    expect($submission->fresh()->status)->toBe('responded');
});
