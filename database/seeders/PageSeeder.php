<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'title' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'content' => $this->getPrivacyPolicyContent(),
                'meta_title' => 'Privacy Policy - Free Help To Keep Your Home',
                'meta_description' => 'Learn how we protect your personal information and maintain confidentiality.',
                'status' => 'published',
            ],
            [
                'title' => 'Terms of Service',
                'slug' => 'terms-of-service',
                'content' => $this->getTermsContent(),
                'meta_title' => 'Terms of Service - Free Help To Keep Your Home',
                'meta_description' => 'Terms and conditions for using our housing counseling services.',
                'status' => 'published',
            ],
            [
                'title' => 'Frequently Asked Questions',
                'slug' => 'faq',
                'content' => $this->getFaqContent(),
                'meta_title' => 'FAQ - Free Help To Keep Your Home',
                'meta_description' => 'Common questions about our free housing counseling services.',
                'status' => 'published',
            ],
            [
                'title' => 'Resources',
                'slug' => 'resources',
                'content' => $this->getResourcesContent(),
                'meta_title' => 'Homeowner Resources - Free Help To Keep Your Home',
                'meta_description' => 'Helpful resources for homeowners facing financial difficulties.',
                'status' => 'published',
            ],
        ];

        foreach ($pages as $page) {
            Page::updateOrCreate(
                ['slug' => $page['slug']],
                $page
            );
        }
    }

    private function getPrivacyPolicyContent(): string
    {
        return <<<'HTML'
<h2>Introduction</h2>
<p>Free Help To Keep Your Home ("we," "our," or "us") is committed to protecting your privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you use our housing counseling services.</p>

<h2>Information We Collect</h2>
<p>We may collect information about you in various ways, including:</p>
<ul>
    <li><strong>Personal Information:</strong> Name, address, phone number, email address, and other contact details you provide.</li>
    <li><strong>Financial Information:</strong> Income, expenses, mortgage details, and other financial information necessary to provide housing counseling services.</li>
    <li><strong>Usage Data:</strong> Information about how you use our website and services.</li>
</ul>

<h2>How We Use Your Information</h2>
<p>We use the information we collect to:</p>
<ul>
    <li>Provide housing counseling services</li>
    <li>Communicate with you about your case</li>
    <li>Improve our services</li>
    <li>Comply with legal obligations</li>
</ul>

<h2>Confidentiality</h2>
<p>As a HUD-approved housing counseling agency, we maintain strict confidentiality. Your personal and financial information will not be shared with third parties without your written consent, except as required by law or as necessary to provide our services.</p>

<h2>Data Security</h2>
<p>We implement appropriate technical and organizational measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction.</p>

<h2>Your Rights</h2>
<p>You have the right to:</p>
<ul>
    <li>Access your personal information</li>
    <li>Request corrections to your information</li>
    <li>Request deletion of your information</li>
    <li>Withdraw consent for data processing</li>
</ul>

<h2>Contact Us</h2>
<p>If you have questions about this Privacy Policy, please contact us through our website or call our office.</p>

<p><em>Last updated: November 2024</em></p>
HTML;
    }

    private function getTermsContent(): string
    {
        return <<<'HTML'
<h2>Agreement to Terms</h2>
<p>By accessing or using our services, you agree to be bound by these Terms of Service. If you disagree with any part of these terms, you may not access our services.</p>

<h2>Our Services</h2>
<p>Free Help To Keep Your Home is a HUD-approved housing counseling agency. We provide:</p>
<ul>
    <li>Foreclosure prevention counseling</li>
    <li>Loan modification assistance</li>
    <li>Budget and financial counseling</li>
    <li>Pre-purchase housing counseling</li>
    <li>Reverse mortgage counseling</li>
</ul>

<h2>Free Services</h2>
<p>All of our housing counseling services are provided free of charge. We will never ask you to pay for our counseling services.</p>

<h2>Not Legal Advice</h2>
<p>Our services do not constitute legal advice. We are housing counselors, not attorneys. If you need legal assistance, we can provide referrals to appropriate legal resources.</p>

<h2>Client Responsibilities</h2>
<p>To receive our services, you agree to:</p>
<ul>
    <li>Provide accurate and complete information</li>
    <li>Respond to communications in a timely manner</li>
    <li>Follow through on agreed-upon action plans</li>
    <li>Notify us of any changes to your situation</li>
</ul>

<h2>Limitation of Liability</h2>
<p>While we strive to provide the best possible service, we cannot guarantee specific outcomes. The success of any foreclosure prevention effort depends on many factors beyond our control.</p>

<h2>Changes to Terms</h2>
<p>We reserve the right to modify these terms at any time. Continued use of our services after changes constitutes acceptance of the new terms.</p>

<h2>Contact Us</h2>
<p>Questions about these Terms of Service should be directed to our office.</p>

<p><em>Last updated: November 2024</em></p>
HTML;
    }

    private function getFaqContent(): string
    {
        return <<<'HTML'
<h2>About Our Services</h2>

<h3>Is your service really free?</h3>
<p>Yes, absolutely. We are a HUD-approved housing counseling agency, and all of our services are provided at no cost to you. We are funded to help homeowners in need, and we will never ask you to pay for our counseling services.</p>

<h3>Who qualifies for your services?</h3>
<p>Any homeowner who is struggling with their mortgage or facing foreclosure can use our services. Whether you're behind on payments, have received a notice of default, or simply want to understand your options, we're here to help.</p>

<h3>Is my information kept confidential?</h3>
<p>Yes. We maintain strict confidentiality and never share your personal or financial information with third parties without your written consent, except as required by law.</p>

<h2>Getting Help</h2>

<h3>How do I get started?</h3>
<p>Simply contact us by phone or through our website. A housing counselor will speak with you about your situation and schedule an appointment to review your options.</p>

<h3>What should I bring to my appointment?</h3>
<p>Please bring:</p>
<ul>
    <li>Recent mortgage statements</li>
    <li>Proof of income (pay stubs, tax returns)</li>
    <li>Bank statements</li>
    <li>Monthly bills and expenses</li>
    <li>Any correspondence from your lender</li>
</ul>

<h3>How long does the process take?</h3>
<p>The timeline varies depending on your situation. A loan modification can take several months to complete. Our counselors will keep you informed throughout the process.</p>

<h2>Foreclosure Prevention</h2>

<h3>What options are available to avoid foreclosure?</h3>
<p>Options may include:</p>
<ul>
    <li>Loan modification (changing your loan terms)</li>
    <li>Forbearance (temporary payment reduction)</li>
    <li>Repayment plans</li>
    <li>Refinancing</li>
    <li>Government assistance programs</li>
</ul>

<h3>Is it too late if I've already received a foreclosure notice?</h3>
<p>It's not necessarily too late. Contact us immediately if you've received a foreclosure notice. There may still be options available to help you keep your home.</p>

<h3>Will you negotiate with my lender for me?</h3>
<p>Yes. With your authorization, our counselors will communicate directly with your lender or servicer to advocate on your behalf.</p>
HTML;
    }

    private function getResourcesContent(): string
    {
        return <<<'HTML'
<h2>Government Resources</h2>

<h3>HUD (U.S. Department of Housing and Urban Development)</h3>
<p>HUD offers information and resources for homeowners facing foreclosure. Visit <a href="https://www.hud.gov" target="_blank" rel="noopener">www.hud.gov</a> or call 1-800-569-4287.</p>

<h3>Making Home Affordable</h3>
<p>Information about federal programs designed to help homeowners avoid foreclosure. Visit <a href="https://www.makinghomeaffordable.gov" target="_blank" rel="noopener">www.makinghomeaffordable.gov</a>.</p>

<h3>Consumer Financial Protection Bureau (CFPB)</h3>
<p>The CFPB provides tools and resources for homeowners, including information about your rights. Visit <a href="https://www.consumerfinance.gov" target="_blank" rel="noopener">www.consumerfinance.gov</a>.</p>

<h2>Understanding Your Mortgage</h2>

<h3>Know Your Rights</h3>
<p>As a homeowner, you have important rights under federal and state law, including:</p>
<ul>
    <li>The right to receive clear information about your loan</li>
    <li>Protection against dual tracking (continuing foreclosure while reviewing your application)</li>
    <li>The right to appeal a denied modification</li>
</ul>

<h3>Warning Signs of Scams</h3>
<p>Beware of foreclosure rescue scams. Legitimate housing counselors will NEVER:</p>
<ul>
    <li>Charge upfront fees for their services</li>
    <li>Ask you to sign over your deed</li>
    <li>Tell you to stop communicating with your lender</li>
    <li>Guarantee to stop foreclosure</li>
</ul>

<h2>Financial Education</h2>

<h3>Budgeting Tips</h3>
<ul>
    <li>Track all income and expenses</li>
    <li>Prioritize essential expenses (housing, utilities, food)</li>
    <li>Look for ways to reduce non-essential spending</li>
    <li>Build an emergency fund when possible</li>
</ul>

<h3>Credit Resources</h3>
<p>Understanding and improving your credit can help with future housing options. You're entitled to one free credit report per year from each of the three major bureaus at <a href="https://www.annualcreditreport.com" target="_blank" rel="noopener">www.annualcreditreport.com</a>.</p>

<h2>Need Help?</h2>
<p>If you're struggling with your mortgage, don't wait. Contact us today for free, confidential assistance.</p>
HTML;
    }
}
