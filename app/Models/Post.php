<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

/**
 * Post Model
 * 
 * Represents a blog post with SEO optimization and content management.
 * Includes relationships with authors, categories, and various metadata fields.
 */
class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'image',
        'meta_description',
        'meta_keywords',
        'meta_title',
        'og_title',
        'og_description',
        'og_image',
        'canonical_url',
        'status',
        'author_id',
        'category_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => 'string',
        'published_at' => 'datetime',
    ];

    /**
     * Get the author that owns the post.
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * Get the category that owns the post.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the comments for the post.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Scope a query to only include published posts.
     */
    public function scopePublished(Builder $query): void
    {
        $query->where('status', 'published');
    }

    /**
     * Scope a query to only include draft posts.
     */
    public function scopeDraft(Builder $query): void
    {
        $query->where('status', 'draft');
    }

    /**
     * Get the post's excerpt or generate one from content.
     */
    public function getExcerptAttribute($value): string
    {
        if ($value) {
            return $value;
        }

        return \Illuminate\Support\Str::limit(strip_tags($this->content), 150);
    }

    /**
     * Get the post's URL.
     */
    public function getUrlAttribute(): string
    {
        return route('posts.show', $this->slug);
    }

    /**
     * Check if the post is published.
     */
    public function isPublished(): bool
    {
        return $this->status === 'published';
    }

    /**
     * Check if the post is draft.
     */
    public function isDraft(): bool
    {
        return $this->status === 'draft';
    }

    /**
     * Generate automatic SEO meta title from post title
     */
    public function generateMetaTitle(): string
    {
        $title = $this->title;
        
        // Limit to 60 characters for optimal SEO
        if (strlen($title) > 60) {
            $title = substr($title, 0, 57) . '...';
        }
        
        return $title;
    }

    /**
     * Generate automatic meta description from content
     */
    public function generateMetaDescription(): string
    {
        // Remove HTML tags and get clean text
        $cleanContent = strip_tags($this->content);
        
        // Generate description from content (optimal length: 150-160 characters)
        $description = Str::limit($cleanContent, 155);
        
        // Ensure it ends with a complete word
        if (strlen($description) == 155) {
            $lastSpace = strrpos($description, ' ');
            if ($lastSpace !== false) {
                $description = substr($description, 0, $lastSpace);
            }
        }
        
        return $description;
    }

    /**
     * Generate automatic excerpt from content
     */
    public function generateExcerpt(): string
    {
        $cleanContent = strip_tags($this->content);
        return Str::limit($cleanContent, 150);
    }

    /**
     * Generate automatic keywords from title and content
     */
    public function generateKeywords(): string
    {
        $text = $this->title . ' ' . strip_tags($this->content);
        
        // Remove common words and punctuation
        $stopWords = ['the', 'a', 'an', 'and', 'or', 'but', 'in', 'on', 'at', 'to', 'for', 'of', 'with', 'by', 'is', 'are', 'was', 'were', 'be', 'been', 'have', 'has', 'had', 'do', 'does', 'did', 'will', 'would', 'could', 'should', 'may', 'might', 'can', 'this', 'that', 'these', 'those'];
        
        $words = strtolower($text);
        $words = preg_replace('/[^\w\s]/', '', $words);
        $words = explode(' ', $words);
        
        // Filter out stop words and short words
        $keywords = array_filter($words, function($word) use ($stopWords) {
            return strlen($word) > 3 && !in_array($word, $stopWords);
        });
        
        // Count word frequency
        $wordCount = array_count_values($keywords);
        arsort($wordCount);
        
        // Get top 10 most frequent words
        $topKeywords = array_slice(array_keys($wordCount), 0, 10);
        
        return implode(', ', $topKeywords);
    }

    /**
     * Generate automatic OG title for social media
     */
    public function generateOgTitle(): string
    {
        $title = $this->title;
        
        // Limit to 95 characters for optimal social media sharing
        if (strlen($title) > 95) {
            $title = substr($title, 0, 92) . '...';
        }
        
        return $title;
    }

    /**
     * Generate automatic OG description for social media
     */
    public function generateOgDescription(): string
    {
        $cleanContent = strip_tags($this->content);
        
        // Generate description for social media (optimal length: 200 characters)
        $description = Str::limit($cleanContent, 195);
        
        // Ensure it ends with a complete word
        if (strlen($description) == 195) {
            $lastSpace = strrpos($description, ' ');
            if ($lastSpace !== false) {
                $description = substr($description, 0, $lastSpace);
            }
        }
        
        return $description;
    }

    /**
     * Auto-fill all SEO fields with generated content
     */
    public function autoFillSeo(): void
    {
        $this->meta_title = $this->generateMetaTitle();
        $this->meta_description = $this->generateMetaDescription();
        $this->excerpt = $this->generateExcerpt();
        $this->meta_keywords = $this->generateKeywords();
        $this->og_title = $this->generateOgTitle();
        $this->og_description = $this->generateOgDescription();
        
        // Set canonical URL to current post URL
        $this->canonical_url = $this->url;
    }
}
