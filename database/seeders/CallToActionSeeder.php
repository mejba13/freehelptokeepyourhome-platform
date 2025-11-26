<?php

namespace Database\Seeders;

use App\Models\CallToAction;
use Illuminate\Database\Seeder;

class CallToActionSeeder extends Seeder
{
    public function run(): void
    {
        $ctas = [
            [
                'name' => 'Main CTA',
                'title' => 'Don\'t Face Foreclosure Alone',
                'description' => 'Our certified HUD counselors have helped thousands of families keep their homes. Let us help you explore your options - it\'s completely free and confidential.',
                'button_text' => 'Get Free Help Today',
                'button_url' => '/contact',
                'icon' => 'home',
                'style' => 'primary',
                'status' => 'published',
            ],
            [
                'name' => 'Phone CTA',
                'title' => 'Call Us Now',
                'description' => 'Speak directly with a housing counselor who can answer your questions and help you understand your options.',
                'button_text' => 'Call 1-800-555-0123',
                'button_url' => 'tel:+18005550123',
                'icon' => 'phone',
                'style' => 'secondary',
                'status' => 'published',
            ],
            [
                'name' => 'Schedule CTA',
                'title' => 'Schedule a Free Consultation',
                'description' => 'Book a one-on-one session with a certified housing counselor. We\'ll review your situation and discuss all available options.',
                'button_text' => 'Schedule Now',
                'button_url' => '/contact',
                'icon' => 'calendar',
                'style' => 'accent',
                'status' => 'published',
            ],
        ];

        foreach ($ctas as $cta) {
            CallToAction::updateOrCreate(
                ['name' => $cta['name']],
                $cta
            );
        }
    }
}
