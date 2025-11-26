<?php

namespace Database\Seeders;

use App\Models\HeroSection;
use Illuminate\Database\Seeder;

class HeroSectionSeeder extends Seeder
{
    public function run(): void
    {
        HeroSection::updateOrCreate(
            ['name' => 'Homepage Hero'],
            [
                'title' => 'Free Help to Keep Your Home',
                'subtitle' => 'Get confidential assistance to avoid foreclosure and stay in your home. Our HUD-approved housing counselors are here to help - completely free of charge.',
                'cta_text' => 'Get Free Help Today',
                'cta_url' => '/contact',
                'cta_secondary_text' => 'Learn About Our Services',
                'cta_secondary_url' => '/services',
                'status' => 'published',
            ]
        );
    }
}
