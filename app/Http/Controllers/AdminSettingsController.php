<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

/**
 * Admin Settings Controller
 * 
 * Manages website configuration settings through the admin panel.
 * Handles general, appearance, social media, contact, SEO, email, and advanced settings.
 */
class AdminSettingsController extends Controller
{
    /**
     * Display the settings management page
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Define setting groups with their display labels
        $groups = $this->getSettingGroups();
        
        // Load settings organized by group
        $settings = $this->loadSettingsByGroup($groups);

        return view('admin.settings.index', compact('settings', 'groups'));
    }

    /**
     * Update multiple settings at once
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        // Validate the request
        $this->validateSettingsRequest($request);
        
        // Process each setting
        foreach ($request->settings as $key => $value) {
            $this->processSetting($request, $key, $value);
        }

        // Clear settings cache for immediate effect
        Setting::clearCache();

        return redirect()
            ->route('admin.settings.index')
            ->with('success', 'Settings updated successfully!');
    }

    /**
     * Reset all settings to their default values
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reset()
    {
        // Create or update default settings
        $this->createDefaultSettings();
        
        // Clear cache to ensure defaults are loaded
        Setting::clearCache();
        
        return redirect()
            ->route('admin.settings.index')
            ->with('success', 'Settings reset to defaults!');
    }

    private function createDefaultSettings()
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
                'description' => 'Google Analytics tracking code',
                'is_public' => false,
                'sort_order' => 1
            ],
            [
                'key' => 'meta_author',
                'value' => 'DevMed.uz Team',
                'type' => 'text',
                'group' => 'seo',
                'label' => 'Meta Author',
                'description' => 'Default author for meta tags',
                'is_public' => true,
                'sort_order' => 2
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

    /**
     * Get setting groups with their display labels
     * 
     * @return array
     */
    private function getSettingGroups(): array
    {
        return [
            'general' => 'General Settings',
            'appearance' => 'Appearance',
            'social' => 'Social Media',
            'contact' => 'Contact Information',
            'seo' => 'SEO Settings',
            'email' => 'Email Settings',
            'advanced' => 'Advanced Settings'
        ];
    }

    /**
     * Load settings organized by group
     * 
     * @param array $groups
     * @return array
     */
    private function loadSettingsByGroup(array $groups): array
    {
        $settings = [];
        
        foreach ($groups as $group => $label) {
            $settings[$group] = Setting::getByGroup($group);
        }
        
        return $settings;
    }

    /**
     * Validate settings update request
     * 
     * @param Request $request
     * @return void
     */
    private function validateSettingsRequest(Request $request): void
    {
        $request->validate([
            'settings' => 'required|array',
            'settings.*' => 'nullable|string'
        ]);
    }

    /**
     * Process individual setting update
     * 
     * @param Request $request
     * @param string $key
     * @param mixed $value
     * @return void
     */
    private function processSetting(Request $request, string $key, $value): void
    {
        // Handle file uploads for image settings
        if ($request->hasFile("settings.{$key}")) {
            $value = $this->handleImageUpload($request->file("settings.{$key}"), $key);
        }

        // Update the setting
        Setting::setValue($key, $value);
    }

    /**
     * Handle image upload for settings
     * 
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $key
     * @return string
     */
    private function handleImageUpload($file, string $key): string
    {
        $fileName = time() . '_' . $key . '.' . $file->getClientOriginalExtension();
        
        // Store in public directory for easy access
        $file->move(public_path('img/settings'), $fileName);
        
        return 'img/settings/' . $fileName;
    }
}
