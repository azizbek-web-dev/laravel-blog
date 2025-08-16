<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\View\View;

/**
 * Category Controller
 * 
 * Handles public category display functionality including
 * category listing and individual category views with posts.
 */
class CategoryController extends Controller
{
    /**
     * Display a listing of all categories
     *
     * @return View
     */
    public function index(): View
    {
        $categories = Category::all();
        
        return view('categories', compact('categories'));
    }

    /**
     * Display the specified category with its posts
     *
     * @param string $slug
     * @return View
     */
    public function show(string $slug): View
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $posts = $category->posts()->paginate(12);
        
        return view('category', compact('category', 'posts'));
    }
}
