<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaults = [
            // General Settings
            [
                'key' => 'site_name',
                'value' => 'DevMed.uz Blog',
                'type' => 'text',
                'group' => 'general',
                'label' => 'Site Name',
                'description' => 'The name of your website',
                'is_public' => true,
                'sort_order' => 1
            ],
            [
                'key' => 'site_description',
                'value' => 'Professional medical blog and news platform',
                'type' => 'textarea',
                'group' => 'general',
                'label' => 'Site Description',
                'description' => 'Brief description of your website',
                'is_public' => true,
                'sort_order' => 2
            ],
            [
                'key' => 'site_keywords',
                'value' => 'medical, blog, health, news',
                'type' => 'textarea',
                'group' => 'general',
                'label' => 'Site Keywords',
                'description' => 'SEO keywords for your website',
                'is_public' => true,
                'sort_order' => 3
            ],

            // Appearance
            [
                'key' => 'site_logo',
                'value' => '',
                'type' => 'image',
                'group' => 'appearance',
                'label' => 'Site Logo',
                'description' => 'Your website logo',
                'is_public' => true,
                'sort_order' => 1
            ],
            [
                'key' => 'site_favicon',
                'value' => '',
                'type' => 'image',
                'group' => 'appearance',
                'label' => 'Site Favicon',
                'description' => 'Your website favicon',
                'is_public' => true,
                'sort_order' => 2
            ],
            [
                'key' => 'primary_color',
                'value' => '#6366f1',
                'type' => 'text',
                'group' => 'appearance',
                'label' => 'Primary Color',
                'description' => 'Main color for your website',
                'is_public' => true,
                'sort_order' => 3
            ],

            // Social Media
            [
                'key' => 'facebook_url',
                'value' => '',
                'type' => 'text',
                'group' => 'social',
                'label' => 'Facebook URL',
                'description' => 'Your Facebook page URL',
                'is_public' => true,
                'sort_order' => 1
            ],
            [
                'key' => 'twitter_url',
                'value' => '',
                'type' => 'text',
                'group' => 'social',
                'label' => 'Twitter URL',
                'description' => 'Your Twitter profile URL',
                'is_public' => true,
                'sort_order' => 2
            ],
            [
                'key' => 'instagram_url',
                'value' => '',
                'type' => 'text',
                'group' => 'social',
                'label' => 'Instagram URL',
                'description' => 'Your Instagram profile URL',
                'is_public' => true,
                'sort_order' => 3
            ],

            // Contact Information
            [
                'key' => 'contact_email',
                'value' => 'info@devmed.uz',
                'type' => 'text',
                'group' => 'contact',
                'label' => 'Contact Email',
                'description' => 'Main contact email address',
                'is_public' => true,
                'sort_order' => 1
            ],
            [
                'key' => 'contact_phone',
                'value' => '',
                'type' => 'text',
                'group' => 'contact',
                'label' => 'Contact Phone',
                'description' => 'Main contact phone number',
                'is_public' => true,
                'sort_order' => 2
            ],
            [
                'key' => 'contact_address',
                'value' => '',
                'type' => 'textarea',
                'group' => 'contact',
                'label' => 'Contact Address',
                'description' => 'Your business address',
                'is_public' => true,
                'sort_order' => 3
            ],

            // SEO Settings
            [
                'key' => 'google_analytics',
                'value' => '',
                'type' => 'textarea',
                'group' => 'seo',
                'label' => 'Google Analytics Code',
                'description' => 'Google Analytics tracking code (GTM-XXXXXXX)',
                'is_public' => false,
                'sort_order' => 1
            ],
            [
                'key' => 'google_search_console',
                'value' => '',
                'type' => 'text',
                'group' => 'seo',
                'label' => 'Google Search Console',
                'description' => 'Google Search Console verification code',
                'is_public' => false,
                'sort_order' => 2
            ],
            [
                'key' => 'meta_author',
                'value' => 'DevMed.uz Team',
                'type' => 'text',
                'group' => 'seo',
                'label' => 'Meta Author',
                'description' => 'Default author for meta tags',
                'is_public' => true,
                'sort_order' => 3
            ],
            [
                'key' => 'meta_robots',
                'value' => 'index, follow',
                'type' => 'text',
                'group' => 'seo',
                'label' => 'Meta Robots',
                'description' => 'Default robots meta tag (index, follow, noindex, nofollow)',
                'is_public' => true,
                'sort_order' => 4
            ],
            [
                'key' => 'og_image',
                'value' => '',
                'type' => 'image',
                'group' => 'seo',
                'label' => 'Default OG Image',
                'description' => 'Default Open Graph image for social media sharing (1200x630px recommended)',
                'is_public' => true,
                'sort_order' => 5
            ],
            [
                'key' => 'twitter_card_type',
                'value' => 'summary_large_image',
                'type' => 'select',
                'group' => 'seo',
                'label' => 'Twitter Card Type',
                'description' => 'Type of Twitter card to display',
                'options' => [
                    'summary' => 'Summary',
                    'summary_large_image' => 'Summary Large Image',
                    'app' => 'App',
                    'player' => 'Player'
                ],
                'is_public' => true,
                'sort_order' => 6
            ],
            [
                'key' => 'canonical_url',
                'value' => '',
                'type' => 'text',
                'group' => 'seo',
                'label' => 'Canonical URL',
                'description' => 'Default canonical URL (leave empty to use current page)',
                'is_public' => true,
                'sort_order' => 7
            ],
            [
                'key' => 'structured_data_enabled',
                'value' => '1',
                'type' => 'boolean',
                'group' => 'seo',
                'label' => 'Enable Structured Data',
                'description' => 'Enable JSON-LD structured data for better search results',
                'is_public' => false,
                'sort_order' => 8
            ],
            [
                'key' => 'sitemap_enabled',
                'value' => '1',
                'type' => 'boolean',
                'group' => 'seo',
                'label' => 'Enable Sitemap',
                'description' => 'Generate XML sitemap for search engines',
                'is_public' => false,
                'sort_order' => 9
            ],
            [
                'key' => 'sitemap_priority',
                'value' => '0.8',
                'type' => 'select',
                'group' => 'seo',
                'label' => 'Default Sitemap Priority',
                'description' => 'Default priority for pages in sitemap',
                'options' => [
                    '0.1' => '0.1 (Lowest)',
                    '0.2' => '0.2',
                    '0.3' => '0.3',
                    '0.4' => '0.4',
                    '0.5' => '0.5 (Medium)',
                    '0.6' => '0.6',
                    '0.7' => '0.7',
                    '0.8' => '0.8 (High)',
                    '0.9' => '0.9',
                    '1.0' => '1.0 (Highest)'
                ],
                'is_public' => false,
                'sort_order' => 10
            ],
            [
                'key' => 'sitemap_changefreq',
                'value' => 'weekly',
                'type' => 'select',
                'group' => 'seo',
                'label' => 'Default Sitemap Change Frequency',
                'description' => 'How often pages are likely to change',
                'options' => [
                    'always' => 'Always',
                    'hourly' => 'Hourly',
                    'daily' => 'Daily',
                    'weekly' => 'Weekly',
                    'monthly' => 'Monthly',
                    'yearly' => 'Yearly',
                    'never' => 'Never'
                ],
                'is_public' => false,
                'sort_order' => 11
            ],

            // Email Settings
            [
                'key' => 'mail_from_name',
                'value' => 'DevMed.uz',
                'type' => 'text',
                'group' => 'email',
                'label' => 'Mail From Name',
                'description' => 'Name shown in outgoing emails',
                'is_public' => false,
                'sort_order' => 1
            ],
            [
                'key' => 'mail_from_address',
                'value' => 'noreply@devmed.uz',
                'type' => 'text',
                'group' => 'email',
                'label' => 'Mail From Address',
                'description' => 'Email address for outgoing emails',
                'is_public' => false,
                'sort_order' => 2
            ],

            // Advanced Settings
            [
                'key' => 'maintenance_mode',
                'value' => '0',
                'type' => 'boolean',
                'group' => 'advanced',
                'label' => 'Maintenance Mode',
                'description' => 'Enable maintenance mode',
                'is_public' => false,
                'sort_order' => 1
            ],
            [
                'key' => 'cache_enabled',
                'value' => '1',
                'type' => 'boolean',
                'group' => 'advanced',
                'label' => 'Enable Caching',
                'description' => 'Enable page caching',
                'is_public' => false,
                'sort_order' => 2
            ]
        ];

        foreach ($defaults as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
