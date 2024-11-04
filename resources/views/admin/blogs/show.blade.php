@extends('admin.layouts.content')

@section('content')
<div class="container mx-auto py-8">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Action Buttons at the Top -->
        <div class="flex justify-end p-4 space-x-4">
            <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg shadow hover:bg-blue-600 transition duration-200">
                Edit
            </a>
            
            <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this blog post?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white font-semibold py-2 px-4 rounded-lg shadow hover:bg-red-600 transition duration-200">
                    Delete
                </button>
            </form>
            
            <a href="{{ route('admin.blogs.index') }}" class="text-blue-500 hover:underline font-semibold py-2 px-4">
                Back to Blog Posts
            </a>
        </div>
        
        <!-- Blog Post Image -->
        <img src="{{ Storage::url($blog->image) }}" alt="{{ $blog->title }}" class="w-full h-75 object-cover">

        <div class="p-6">
            <!-- Blog Title -->
            <h1 class="text-3xl font-bold text-gray-800">{{ $blog->title }}</h1>
            
            <!-- Published Date -->
            <p class="text-gray-600 mt-2"> 📅 Published on: {{ \Carbon\Carbon::parse($blog->created_at)->format('F j, Y') }}</p>
            
            <!-- Blog Content -->
            <p class="text-gray-700 mt-2 leading-relaxed">{!! $blog->content !!}</p>
        </div>
    </div>
</div>
@endsection
