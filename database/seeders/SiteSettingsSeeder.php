<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // General
            ['key' => 'site_name', 'value' => 'Free Help To Keep Your Home', 'group' => 'general'],
            ['key' => 'site_tagline', 'value' => 'HUD-Approved Housing Counseling', 'group' => 'general'],
            ['key' => 'google_analytics_id', 'value' => '', 'group' => 'general'],

            // Contact
            ['key' => 'phone_primary', 'value' => '1-800-555-0123', 'group' => 'contact'],
            ['key' => 'phone_secondary', 'value' => '', 'group' => 'contact'],
            ['key' => 'email', 'value' => 'help@freehelptokeepyourhome.org', 'group' => 'contact'],
            ['key' => 'address', 'value' => "123 Main Street\nSuite 100\nAnytown, USA 12345", 'group' => 'contact'],
            ['key' => 'business_hours', 'value' => 'Mon-Fri 9AM-5PM EST', 'group' => 'contact'],

            // Social
            ['key' => 'facebook_url', 'value' => '', 'group' => 'social'],
            ['key' => 'twitter_url', 'value' => '', 'group' => 'social'],
            ['key' => 'linkedin_url', 'value' => '', 'group' => 'social'],

            // Footer
            ['key' => 'footer_text', 'value' => 'We are a HUD-approved housing counseling agency dedicated to helping families avoid foreclosure and achieve housing stability. Our services are free and confidential.', 'group' => 'footer'],

            // Disclosure
            ['key' => 'disclosure_text', 'value' => 'This organization is a HUD-approved housing counseling agency. Our services are provided free of charge. We do not provide legal advice. For legal assistance, please consult with a licensed attorney.', 'group' => 'disclosure'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value'], 'group' => $setting['group']]
            );
        }

        // Clear the cache
        SiteSetting::clearCache();
    }
}
