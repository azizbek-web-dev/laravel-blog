<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Builder;

/**
 * Category Model
 * 
 * Represents a blog category with SEO optimization and visual customization.
 * Includes color schemes, icons, and metadata for better content organization.
 */
class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'description',
        'slug',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_title',
        'og_description',
        'og_image',
        'canonical_url',
        'color',
        'icon'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'color' => 'string',
        'icon' => 'string',
    ];

    /**
     * Get the posts for the category.
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Get the latest post for hero display.
     */
    public function hero(): HasOne
    {
        return $this->hasOne(Post::class)->latest();
    }

    /**
     * Scope a query to only include categories with posts.
     */
    public function scopeWithPosts(Builder $query): void
    {
        $query->has('posts');
    }

    /**
     * Scope a query to only include empty categories.
     */
    public function scopeEmpty(Builder $query): void
    {
        $query->doesntHave('posts');
    }

    /**
     * Get the category's URL.
     */
    public function getUrlAttribute(): string
    {
        return route('categories.show', $this->slug);
    }

    /**
     * Check if the category has posts.
     */
    public function hasPosts(): bool
    {
        return $this->posts()->count() > 0;
    }

    /**
     * Get the category's display color or default.
     */
    public function getDisplayColorAttribute(): string
    {
        return $this->color ?: '#6366f1';
    }

    /**
     * Get the category's display icon or default.
     */
    public function getDisplayIconAttribute(): string
    {
        return $this->icon ?: 'fas fa-folder';
    }
}
