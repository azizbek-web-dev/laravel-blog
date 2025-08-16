<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Author;
use Illuminate\Database\Eloquent\Builder;

/**
 * Post Controller
 * 
 * Handles public blog functionality including post display,
 * search, filtering, and pagination for visitors.
 */
class PostController extends Controller
{
    /**
     * Display the home page with hero post and recent posts
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $hero = Post::latest()->first();
        $posts = Post::latest()->take(9)->get();
        $categories = Category::all();
        $authors = Author::all();
        
        return view('main', compact('hero', 'posts', 'categories', 'authors'));
    }

    /**
     * Display a single blog post
     *
     * @param string $slug
     * @return \Illuminate\View\View
     */
    public function show(string $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        
        // Ensure content is properly decoded
        if (is_string($post->content)) {
            $post->content = html_entity_decode($post->content, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        }
        
        $posts = Post::latest()->take(6)->get(); // Related posts
        $categories = Category::all();
        $authors = Author::all();
        
        return view('post', compact('post', 'posts', 'categories', 'authors'));
    }

    /**
     * Display the blog index with search and filtering capabilities
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index_blog(Request $request)
    {
        $query = Post::query();
        
        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function(Builder $q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%")
                  ->orWhere('meta_description', 'like', "%{$search}%");
            });
        }
        
        // Category filter
        if ($request->filled('category')) {
            $query->whereHas('category', function(Builder $q) use ($request) {
                $q->where('name', 'like', "%{$request->category}%");
            });
        }
        
        $posts = $query->latest()->paginate(12);
        $categories = Category::all();
        $authors = Author::all();
        
        return view('blog', compact('posts', 'categories', 'authors'));
    }
}
