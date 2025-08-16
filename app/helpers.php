<?php

/**
 * Global Helper Functions
 * 
 * Provides convenient access to common application functionality
 * throughout the application without needing to inject dependencies.
 */

if (!function_exists('setting')) {
    /**
     * Get setting value by key with optional default value
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function setting(string $key, $default = null)
    {
        return \App\Models\Setting::getValue($key, $default);
    }
}

if (!function_exists('setting_group')) {
    /**
     * Get all settings organized by group
     *
     * @param string $group
     * @return \Illuminate\Database\Eloquent\Collection
     */
    function setting_group(string $group)
    {
        return \App\Models\Setting::getByGroup($group);
    }
}

if (!function_exists('public_settings')) {
    /**
     * Get all public settings as key-value pairs
     *
     * @return \Illuminate\Support\Collection
     */
    function public_settings()
    {
        return \App\Models\Setting::getPublic();
    }
}

if (!function_exists('format_date')) {
    /**
     * Format date in a consistent way across the application
     *
     * @param string|Carbon $date
     * @param string $format
     * @return string
     */
    function format_date($date, string $format = 'M j, Y'): string
    {
        if (!$date) {
            return '';
        }

        return \Carbon\Carbon::parse($date)->format($format);
    }
}

if (!function_exists('truncate_text')) {
    /**
     * Truncate text to specified length with ellipsis
     *
     * @param string $text
     * @param int $length
     * @param string $end
     * @return string
     */
    function truncate_text(string $text, int $length = 100, string $end = '...'): string
    {
        if (strlen($text) <= $length) {
            return $text;
        }

        return substr($text, 0, $length) . $end;
    }
} 