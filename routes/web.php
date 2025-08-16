<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\AdminAuthorController;
use App\Http\Controllers\AdminSettingsController;
use App\Http\Controllers\AdminCategoryController;

/**
 * Web Routes
 * 
 * This file contains all the web routes for the blog application.
 * Routes are organized by functionality: public, admin, and utility routes.
 */


/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
| These routes are accessible to all visitors and handle the main
| blog functionality, contact forms, and legal pages.
|
*/

// Home and blog routes
Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/blog', [PostController::class, 'index_blog'])->name('blog');
Route::get('/post/{slug}', [PostController::class, 'show'])->name('single-post');

// Static pages
Route::get('/about', function () {
    return view('about');
})->name('about');

// Author profiles
Route::get('/authors', [AuthorController::class, 'show'])->name('authors');

// Contact and newsletter
Route::get('/contact', [ContactController::class, 'create'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Newsletter subscription management
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
Route::post('/newsletter/unsubscribe', [NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');

// Legal and policy pages
Route::get('/terms', function () {
    return view('terms');
})->name('terms');

Route::get('/privacy', function () {
    return view('privacy');
})->name('privacy');

Route::get('/cookie-policy', function () {
    return view('cookie-policy');
})->name('cookie-policy');

/*
|--------------------------------------------------------------------------
| Admin Panel Routes
|--------------------------------------------------------------------------
| These routes handle the administrative functionality including
| content management, user management, and system configuration.
| All routes are protected by authentication middleware.
|
*/

Route::prefix('admin')->name('admin.')->group(function () {
    // Default admin route - redirect to login
    Route::get('/', function () {
        return redirect()->route('admin.login');
    })->name('home');
    
    // Authentication routes (no middleware)
    Route::get('/login', [AdminController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.post');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    
    // Protected admin routes (require authentication)
    Route::middleware(['auth:author'])->group(function () {
        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        
        // Content management
        Route::resource('posts', AdminPostController::class);
        Route::resource('categories', AdminCategoryController::class);
        Route::resource('authors', AdminAuthorController::class);
        
        // System configuration
        Route::get('/settings', [AdminSettingsController::class, 'index'])->name('settings.index');
        Route::put('/settings', [AdminSettingsController::class, 'update'])->name('settings.update');
        Route::post('/settings/reset', [AdminSettingsController::class, 'reset'])->name('settings.reset');
        
        // User profile management
        Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
        Route::put('/profile', [AdminController::class, 'updateProfile'])->name('profile.update');
    });
});