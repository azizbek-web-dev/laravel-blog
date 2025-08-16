<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Post;
use App\Models\Category;
use Illuminate\View\View;

/**
 * Author Controller
 * 
 * Handles public author display functionality including
 * author listing and individual author profiles with posts.
 */
class AuthorController extends Controller
{
    /**
     * Display a listing of all authors
     *
     * @return View
     */
    public function index(): View
    {
        $authors = Author::all();
        
        return view('authors', compact('authors'));
    }

    /**
     * Display the specified author with their posts
     *
     * @return View
     */
    public function show(): View
    {
        $author = Author::findOrFail(1);
        $posts = Post::latest()->take(9)->get();
        $categories = Category::all();
        $authors = Author::all();
        
        return view('authors', compact('author', 'posts', 'categories', 'authors'));
    }

}
