<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Author;
use Illuminate\Support\Str;

/**
 * Admin Author Controller
 * 
 * Manages blog authors through the admin panel.
 * Handles author profiles, authentication, and SEO optimization.
 */
class AdminAuthorController extends Controller
{
    public function index()
    {
        $authors = Author::withCount('posts')->paginate(10);
        return view('admin.authors.index', compact('authors'));
    }

    public function create()
    {
        return view('admin.authors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:authors,email',
            'password' => 'required|string|min:8|confirmed',
            'bio' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'twitter' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'github' => 'nullable|url|max:255',
            'meta_title' => 'nullable|string|max:60',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string|max:255',
            'og_title' => 'nullable|string|max:95',
            'og_description' => 'nullable|string|max:200',
            'og_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'canonical_url' => 'nullable|url|max:255',
        ]);

        $data = $request->only([
            'name', 
            'email', 
            'bio', 
            'twitter', 
            'linkedin', 
            'github',
            'meta_title',
            'meta_description',
            'meta_keywords',
            'og_title',
            'og_description',
            'canonical_url'
        ]);
        $data['password'] = Hash::make($request->password);

        // Generate unique slug from name
        $data['slug'] = $this->generateUniqueSlug(Str::slug($request->name));

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . Str::random(8) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img/authors'), $imageName);
            $data['image'] = 'img/authors/' . $imageName;
        }
        
        if ($request->hasFile('og_image')) {
            $ogImage = $request->file('og_image');
            $ogImageName = 'og_' . time() . '_' . Str::random(8) . '.' . $ogImage->getClientOriginalExtension();
            $ogImage->move(public_path('img/authors'), $ogImageName);
            $data['og_image'] = 'img/authors/' . $ogImageName;
        }

        Author::create($data);

        return redirect()->route('admin.authors.index')->with('success', 'Author created successfully!');
    }

    public function show(Author $author)
    {
        $author->load('posts');
        return view('admin.authors.show', compact('author'));
    }

    public function edit(Author $author)
    {
        return view('admin.authors.edit', compact('author'));
    }

    public function update(Request $request, Author $author)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:authors,email,' . $author->id,
            'password' => 'nullable|string|min:8|confirmed',
            'bio' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'twitter' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'github' => 'nullable|url|max:255',
            'meta_title' => 'nullable|string|max:60',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string|max:255',
            'og_title' => 'nullable|string|max:95',
            'og_description' => 'nullable|string|max:200',
            'og_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'canonical_url' => 'nullable|url|max:255',
        ]);

        $data = $request->only([
            'name', 
            'email', 
            'bio', 
            'twitter', 
            'linkedin', 
            'github',
            'meta_title',
            'meta_description',
            'meta_keywords',
            'og_title',
            'og_description',
            'canonical_url'
        ]);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
        
        // Generate unique slug from name if name changed
        $slug = Str::slug($request->name);
        if ($slug !== $author->slug) {
            $data['slug'] = $this->generateUniqueSlug($slug, $author->id);
        }

        if ($request->hasFile('image')) {
            // Remove old image
            if ($author->image && file_exists(public_path($author->image))) {
                unlink(public_path($author->image));
            }
            
            $image = $request->file('image');
            $imageName = time() . '_' . Str::random(8) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img/authors'), $imageName);
            $data['image'] = 'img/authors/' . $imageName;
        }
        
        if ($request->hasFile('og_image')) {
            // Remove old og_image
            if ($author->og_image && file_exists(public_path($author->og_image))) {
                unlink(public_path($author->og_image));
            }
            
            $ogImage = $request->file('og_image');
            $ogImageName = 'og_' . time() . '_' . Str::random(8) . '.' . $ogImage->getClientOriginalExtension();
            $ogImage->move(public_path('img/authors'), $ogImageName);
            $data['og_image'] = 'img/authors/' . $ogImageName;
        }

        $author->update($data);

        return redirect()->route('admin.authors.index')->with('success', 'Author updated successfully!');
    }

    public function destroy(Author $author)
    {
        if ($author->posts()->count() > 0) {
            return back()->with('error', 'Cannot delete author with existing posts!');
        }

        // Remove associated images
        if ($author->image && file_exists(public_path($author->image))) {
            unlink(public_path($author->image));
        }
        if ($author->og_image && file_exists(public_path($author->og_image))) {
            unlink(public_path($author->og_image));
        }

        $author->delete();
        return redirect()->route('admin.authors.index')->with('success', 'Author deleted successfully!');
    }

    /**
     * Generate a unique slug for authors
     * 
     * @param string $slug
     * @param int|null $excludeId
     * @return string
     */
    private function generateUniqueSlug(string $slug, ?int $excludeId = null): string
    {
        $originalSlug = $slug;
        $counter = 1;

        while (Author::where('slug', $slug)
            ->when($excludeId, function ($query) use ($excludeId) {
                return $query->where('id', '!=', $excludeId);
            })
            ->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}




