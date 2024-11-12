<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
     /**
     * Display a listing of the blog posts.
     */
    public function index()
    {
        $blogs = Blog::latest()->paginate(9); // Fetch 9 blogs per page
        $title = 'All Blog Posts';
        $setting = Setting::first();
        return view('admin.blogs.index', compact('blogs', 'title', 'setting'));
    }

    /**
     * Show the form for creating a new blog post.
     */
    public function create()
    {
        $title = 'Create New Blog Post';
        $setting = Setting::first();
        return view('admin.blogs.create', compact('title', 'setting'));
    }

    /**
     * Store a newly created blog post in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
        ]);

        $data = $request->only(['title', 'content']);

        // Handle image upload if exists
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('blog', 'public');
        }

        Blog::create($data);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog post created successfully.');
    }

    /**
     * Display the specified blog post.
     */
    public function show(Blog $blog)
    {
        $title = $blog->title; // Set dynamic title to blog post title
        $setting = Setting::first();
        return view('admin.blogs.show', compact('blog', 'title', 'setting'));
    }

    /**
     * Show the form for editing the specified blog post.
     */
    public function edit(Blog $blog)
    {
        $title = 'Edit Blog Post: ' . $blog->title;
        $setting = Setting::first();
        return view('admin.blogs.edit', compact('blog', 'title', 'setting'));
    }

    /**
     * Update the specified blog post in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['title', 'content']);

        // Update image if a new one is uploaded
        if ($request->hasFile('image')) {
            // Delete the old image
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }

            // Store new image
            $data['image'] = $request->file('image')->store('blogs', 'public');
        }

        $blog->update($data);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog post updated successfully.');
    }

    /**
     * Remove the specified blog post from storage.
     */
    public function destroy(Blog $blog)
    {
        if ($blog->image) {
            Storage::disk('public')->delete($blog->image); // Delete the image file
        }

        $blog->delete();

        return redirect()->route('admin.blogs.index')->with('success', 'Blog post deleted successfully.');
    }
}
