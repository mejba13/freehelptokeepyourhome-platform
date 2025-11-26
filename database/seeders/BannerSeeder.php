<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        $banners = [
            [
                'name' => 'Home Page Banner',
                'title' => 'Free Housing Counseling Available',
                'description' => 'Our HUD-approved counselors are ready to help you explore your options. All services are free and confidential.',
                'button_text' => 'Get Help Now',
                'button_url' => '/contact',
                'position' => 'inline',
                'status' => 'published',
                'start_date' => now(),
                'end_date' => now()->addYear(),
            ],
            [
                'name' => 'Urgent Foreclosure Banner',
                'title' => 'Facing Foreclosure?',
                'description' => 'Don\'t wait until it\'s too late. Contact us today for free, confidential assistance.',
                'button_text' => 'Contact Us',
                'button_url' => '/contact',
                'position' => 'top',
                'status' => 'published',
                'start_date' => now(),
                'end_date' => now()->addYear(),
            ],
            [
                'name' => 'New Programs Banner',
                'title' => 'New Programs Available',
                'description' => 'Ask about the latest mortgage assistance programs. You may qualify for help you didn\'t know existed.',
                'button_text' => 'Learn More',
                'button_url' => '/services',
                'position' => 'bottom',
                'status' => 'published',
                'start_date' => now(),
                'end_date' => now()->addYear(),
            ],
        ];

        foreach ($banners as $banner) {
            Banner::updateOrCreate(
                ['name' => $banner['name']],
                $banner
            );
        }
    }
}
