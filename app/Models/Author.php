<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

/**
 * Author Model
 * 
 * Represents a blog author with authentication capabilities and SEO optimization.
 * Extends Laravel's Authenticatable for admin panel access and content management.
 */
class Author extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'bio',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_title',
        'og_description',
        'og_image',
        'canonical_url',
        'slug',
        'twitter',
        'linkedin',
        'github'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the posts for the author.
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Scope a query to only include active authors.
     */
    public function scopeActive(Builder $query): void
    {
        $query->whereHas('posts');
    }

    /**
     * Get the author's display name.
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->name ?: 'Anonymous Author';
    }

    /**
     * Get the author's profile URL.
     */
    public function getProfileUrlAttribute(): string
    {
        return route('authors.show', $this->slug);
    }

    /**
     * Get the author's avatar image or default.
     */
    public function getAvatarAttribute(): string
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }

        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=6366f1&background=f3f4f6';
    }

    /**
     * Check if the author has a profile image.
     */
    public function hasImage(): bool
    {
        return !empty($this->image);
    }

    /**
     * Get the author's bio or generate a default one.
     */
    public function getDisplayBioAttribute(): string
    {
        if ($this->bio) {
            return $this->bio;
        }

        return "Professional author with expertise in various topics.";
    }

    /**
     * Check if the author has social media links.
     */
    public function hasSocialMedia(): bool
    {
        return !empty($this->twitter) || !empty($this->linkedin) || !empty($this->github);
    }

    /**
     * Get the author's post count.
     */
    public function getPostCountAttribute(): int
    {
        return $this->posts()->count();
    }
}
