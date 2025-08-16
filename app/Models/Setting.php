<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Builder;

/**
 * Setting Model
 * 
 * Manages website configuration settings with caching and grouping capabilities.
 * Provides a flexible system for storing and retrieving various site configurations.
 */
class Setting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
        'label',
        'description',
        'options',
        'is_public',
        'sort_order'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'options' => 'array',
        'is_public' => 'boolean',
        'sort_order' => 'integer'
    ];

    /**
     * Cache duration in seconds (1 hour)
     */
    private const CACHE_DURATION = 3600;

    /**
     * Get setting value by key with caching
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function getValue(string $key, $default = null)
    {
        $cacheKey = "setting_{$key}";
        
        return Cache::remember($cacheKey, self::CACHE_DURATION, function () use ($key, $default) {
            $setting = static::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }

    /**
     * Set setting value by key
     *
     * @param string $key
     * @param mixed $value
     * @return Setting
     */
    public static function setValue(string $key, $value): Setting
    {
        $setting = static::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );

        // Clear specific setting cache
        Cache::forget("setting_{$key}");
        
        return $setting;
    }

    /**
     * Get all settings by group
     *
     * @param string $group
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getByGroup(string $group)
    {
        return static::where('group', $group)
                    ->orderBy('sort_order')
                    ->get();
    }

    /**
     * Get all public settings
     *
     * @return \Illuminate\Support\Collection
     */
    public static function getPublic()
    {
        return static::where('is_public', true)
                    ->orderBy('sort_order')
                    ->get()
                    ->pluck('value', 'key');
    }

    /**
     * Clear all settings cache
     *
     * @return void
     */
    public static function clearCache(): void
    {
        $settings = static::all();
        
        foreach ($settings as $setting) {
            Cache::forget("setting_{$setting->key}");
        }
    }

    /**
     * Scope a query to only include settings by type
     *
     * @param Builder $query
     * @param string $type
     * @return void
     */
    public function scopeByType(Builder $query, string $type): void
    {
        $query->where('type', $type);
    }

    /**
     * Scope a query to only include public settings
     *
     * @param Builder $query
     * @return void
     */
    public function scopePublic(Builder $query): void
    {
        $query->where('is_public', true);
    }

    /**
     * Check if setting is public
     *
     * @return bool
     */
    public function isPublic(): bool
    {
        return $this->is_public;
    }

    /**
     * Get setting options as array
     *
     * @return array
     */
    public function getOptionsAttribute($value): array
    {
        if (is_array($value)) {
            return $value;
        }
        
        $decoded = json_decode($value, true);
        return $decoded ?: [];
    }

    /**
     * Set setting options as JSON
     *
     * @param mixed $value
     * @return void
     */
    public function setOptionsAttribute($value): void
    {
        $this->attributes['options'] = is_array($value) ? json_encode($value) : $value;
    }
}
