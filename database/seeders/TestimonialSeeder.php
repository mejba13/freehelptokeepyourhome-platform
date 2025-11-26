<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'author_name' => 'Maria Garcia',
                'author_title' => 'Homeowner',
                'author_location' => 'Houston, TX',
                'content' => 'When I lost my job during the pandemic, I thought I was going to lose my home. The counselors here helped me apply for a loan modification and worked with my lender for months. Today, my payments are affordable and I\'m still in my home. I can\'t thank them enough!',
                'rating' => 5,
                'featured' => true,
                'status' => 'published',
                'sort_order' => 1,
            ],
            [
                'author_name' => 'James Wilson',
                'author_title' => 'Veteran',
                'author_location' => 'Dallas, TX',
                'content' => 'As a veteran, I was struggling to keep up with my mortgage after returning from deployment. The team connected me with VA resources I didn\'t know existed and helped me get back on track. Their dedication to helping families is incredible.',
                'rating' => 5,
                'featured' => true,
                'status' => 'published',
                'sort_order' => 2,
            ],
            [
                'author_name' => 'Sandra Thompson',
                'author_title' => 'Single Mother',
                'author_location' => 'Austin, TX',
                'content' => 'I was three months behind on my mortgage and received a foreclosure notice. I was terrified. The counselors here explained all my options, helped me prepare my documents, and negotiated with my lender. They saved my family\'s home.',
                'rating' => 5,
                'featured' => true,
                'status' => 'published',
                'sort_order' => 3,
            ],
            [
                'author_name' => 'Robert & Linda Chen',
                'author_title' => 'Retired Couple',
                'author_location' => 'San Antonio, TX',
                'content' => 'After my husband\'s medical emergency, we fell behind on payments. We didn\'t know where to turn. The housing counselors treated us with dignity and respect, never judging our situation. They helped us find a solution that works for our fixed income.',
                'rating' => 5,
                'featured' => false,
                'status' => 'published',
                'sort_order' => 4,
            ],
            [
                'author_name' => 'Michael Johnson',
                'author_title' => 'Small Business Owner',
                'author_location' => 'Fort Worth, TX',
                'content' => 'My business struggled and I couldn\'t pay my mortgage. I thought bankruptcy was my only option. The counselors showed me alternatives I never knew existed. Thanks to their help, I kept my home and my business is recovering.',
                'rating' => 5,
                'featured' => false,
                'status' => 'published',
                'sort_order' => 5,
            ],
            [
                'author_name' => 'Angela Martinez',
                'author_title' => 'Teacher',
                'author_location' => 'El Paso, TX',
                'content' => 'I was overwhelmed by the paperwork required for a loan modification. The team here walked me through every document, every form, and every step. They made a complicated process manageable. I couldn\'t have done it without them.',
                'rating' => 4,
                'featured' => false,
                'status' => 'published',
                'sort_order' => 6,
            ],
            [
                'author_name' => 'David Brown',
                'author_title' => 'Construction Worker',
                'author_location' => 'Arlington, TX',
                'content' => 'Work in construction can be unpredictable. When I had a slow period and fell behind, these folks helped me create a budget and work out a repayment plan with my lender. Professional, caring, and effective.',
                'rating' => 5,
                'featured' => false,
                'status' => 'published',
                'sort_order' => 7,
            ],
            [
                'author_name' => 'Patricia Williams',
                'author_title' => 'Nurse',
                'author_location' => 'Corpus Christi, TX',
                'content' => 'After my divorce, managing the mortgage on a single income seemed impossible. The housing counselors helped me understand my options and guided me through a successful loan modification. I\'m grateful every day that I found this organization.',
                'rating' => 5,
                'featured' => false,
                'status' => 'published',
                'sort_order' => 8,
            ],
            [
                'author_name' => 'Thomas Anderson',
                'author_title' => 'Factory Worker',
                'author_location' => 'Lubbock, TX',
                'content' => 'I was embarrassed to ask for help, but the counselors made me feel comfortable from the first call. They never made me feel judged. If you\'re struggling, please reach out to them - they really do care and they really can help.',
                'rating' => 5,
                'featured' => false,
                'status' => 'published',
                'sort_order' => 9,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::updateOrCreate(
                ['author_name' => $testimonial['author_name']],
                $testimonial
            );
        }
    }
}
