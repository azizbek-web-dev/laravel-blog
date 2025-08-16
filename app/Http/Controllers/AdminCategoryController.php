<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

/**
 * Admin Category Controller
 * 
 * Handles CRUD operations for blog categories in the admin panel.
 * Includes SEO management and image handling for Open Graph images.
 */
class AdminCategoryController extends Controller
{
    /**
     * Display a paginated list of all categories
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $categories = Category::withCount('posts')
            ->orderBy('name')
            ->paginate(15);
            
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category
     * 
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created category
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate input data
        $validated = $this->validateCategoryData($request);
        
        // Prepare data for storage
        $categoryData = $this->prepareCategoryData($request, $validated);
        
        // Handle Open Graph image upload if provided
        if ($request->hasFile('og_image')) {
            $categoryData['og_image'] = $this->handleImageUpload($request->file('og_image'));
        }
        
        // Create the category
        Category::create($categoryData);
        
        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category created successfully!');
    }

    /**
     * Display the specified category with its posts
     * 
     * @param Category $category
     * @return \Illuminate\View\View
     */
    public function show(Category $category)
    {
        // Load recent posts for this category
        $category->load(['posts' => function($query) {
            $query->latest()->paginate(10);
        }]);
        
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified category
     * 
     * @param Category $category
     * @return \Illuminate\View\View
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified category
     * 
     * @param Request $request
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Category $category)
    {
        // Validate input data
        $validated = $this->validateCategoryData($request, $category->id);
        
        // Prepare data for update
        $categoryData = $this->prepareCategoryData($request, $validated);
        
        // Handle new Open Graph image upload if provided
        if ($request->hasFile('og_image')) {
            // Remove old image if exists
            if ($category->og_image) {
                $this->removeOldImage($category->og_image);
            }
            
            $categoryData['og_image'] = $this->handleImageUpload($request->file('og_image'));
        }
        
        // Update the category
        $category->update($categoryData);
        
        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified category
     * 
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category)
    {
        // Check if category has posts
        if ($category->posts()->count() > 0) {
            return back()->with('error', 'Cannot delete category with existing posts!');
        }
        
        // Remove associated image if exists
        if ($category->og_image) {
            $this->removeOldImage($category->og_image);
        }
        
        // Delete the category
        $category->delete();
        
        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category deleted successfully!');
    }

    /**
     * Validate category input data
     * 
     * @param Request $request
     * @param int|null $categoryId
     * @return array
     */
    private function validateCategoryData(Request $request, ?int $categoryId = null): array
    {
        $uniqueRule = $categoryId 
            ? "unique:categories,name,{$categoryId}"
            : 'unique:categories,name';
            
        return $request->validate([
            'name' => "required|string|max:255|{$uniqueRule}",
            'description' => 'nullable|string|max:1000',
            'color' => 'nullable|string|max:7',
            'icon' => 'nullable|string|max:50',
            'meta_title' => 'nullable|string|max:60',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string|max:255',
            'og_title' => 'nullable|string|max:95',
            'og_description' => 'nullable|string|max:200',
            'og_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'canonical_url' => 'nullable|url|max:255',
        ]);
    }

    /**
     * Prepare category data for storage/update
     * 
     * @param Request $request
     * @param array $validated
     * @return array
     */
    private function prepareCategoryData(Request $request, array $validated): array
    {
        $data = $request->only([
            'name', 'description', 'color', 'icon',
            'meta_title', 'meta_description', 'meta_keywords',
            'og_title', 'og_description', 'canonical_url'
        ]);
        
        // Generate SEO-friendly slug from name
        $data['slug'] = Str::slug($request->name);
        
        return $data;
    }

    /**
     * Handle image upload for Open Graph
     * 
     * @param \Illuminate\Http\UploadedFile $image
     * @return string
     */
    private function handleImageUpload($image): string
    {
        $fileName = 'og_image_' . time() . '_' . Str::random(8) . '.' . $image->getClientOriginalExtension();
        
        // Store in public directory for easy access
        $image->move(public_path('img/categories'), $fileName);
        
        return 'img/categories/' . $fileName;
    }

    /**
     * Remove old image file
     * 
     * @param string $imagePath
     * @return void
     */
    private function removeOldImage(string $imagePath): void
    {
        $fullPath = public_path($imagePath);
        
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
    }
}
