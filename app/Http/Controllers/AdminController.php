<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Author;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

/**
 * Admin Controller
 * 
 * Handles main admin panel functionality including authentication,
 * dashboard statistics, and profile management.
 */
class AdminController extends Controller
{
    public function showLogin()
    {
        if (Auth::guard('author')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('author')->attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('author')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    public function dashboard()
    {
        $stats = [
            'total_posts' => Post::count(),
            'total_authors' => Author::count(),
            'total_categories' => Category::count(),
            'recent_posts' => Post::with(['author', 'category'])->latest()->take(5)->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function profile()
    {
        $author = Auth::guard('author')->user();
        return view('admin.profile', compact('author'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:authors,email,' . Auth::guard('author')->id(),
            'bio' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $author = Auth::guard('author')->user();
        
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'bio' => $request->bio,
        ];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img/authors'), $imageName);
            $data['image'] = 'img/authors/' . $imageName;
        }

        $author->update($data);

        return redirect()->route('admin.profile')->with('success', 'Profile updated successfully!');
    }
}



