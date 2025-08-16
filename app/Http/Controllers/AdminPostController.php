<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\Category;
use App\Models\Author;
use Illuminate\Support\Facades\Storage;

/**
 * Admin Post Controller
 * 
 * Manages blog posts through the admin panel.
 * Handles post creation, editing, publishing, and SEO optimization.
 */
class AdminPostController extends Controller
{
    /**
     * Display a listing of all posts
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $posts = Post::with(['author', 'category'])->latest()->paginate(10);
        
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new post
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::all();
        
        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Simple validation
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'excerpt' => 'nullable|string|max:500',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:60',
            'og_title' => 'nullable|string|max:95',
            'og_description' => 'nullable|string|max:200',
            'og_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'canonical_url' => 'nullable|url|max:255',
        ]);

        $author = Auth::guard('author')->user();
        
        // Handle image
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('img/posts'), $imageName);

        try {
            // Create the post
            $post = Post::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'content' => $request->content,
                'excerpt' => $request->excerpt,
                'image' => 'img/posts/' . $imageName,
                'category_id' => $request->category_id,
                'author_id' => $author->id,
                'status' => 'published',
            ]);

            return redirect()->route('admin.posts.index')->with('success', 'Post created successfully!');
            
        } catch (\Exception $e) {
            
            return back()->with('error', 'Failed to create post: ' . $e->getMessage());
        }
    }

    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'excerpt' => 'nullable|string|max:500',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:60',
            'og_title' => 'nullable|string|max:95',
            'og_description' => 'nullable|string|max:200',
            'og_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'canonical_url' => 'nullable|url|max:255',
        ]);

        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'category_id' => $request->category_id,
            'excerpt' => $request->excerpt,
        ];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img/posts'), $imageName);
            $data['image'] = 'img/posts/' . $imageName;
        }

        try {
            $updated = $post->update($data);
            
            if ($updated) {
                return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully!');
            } else {
                return back()->with('error', 'No changes were made to the post.');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update post: ' . $e->getMessage());
        }
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Post deleted successfully!');
    }
}

