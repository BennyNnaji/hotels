@extends('admin.layouts.content')

@section('content')
<div class="container mx-auto py-8">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Header with Title -->
        <div class="bg-gray-800 px-6 py-4">
            <h1 class="text-2xl font-semibold text-white">Edit Blog Post</h1>
        </div>

 @if ($errors->any())
            <div class="mb-4">
                <div class="bg-red-100 text-red-700 px-4 py-2 rounded">
                    <strong>Whoops!</strong> There were some problems with your input.<br>
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        <!-- Edit Blog Form -->
        <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <!-- Title Input -->
            <div>
                <label for="title" class="block text-gray-700 font-semibold">Title</label>
                <input type="text" id="title" name="title" value="{{ old('title', $blog->title) }}" class="w-full mt-2 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('title') border-red-500 @enderror">
                @error('title')
                    <p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                @enderror
            </div>

            <!-- Content Textarea -->
            <div>
                <label for="content" class="block text-gray-700 font-semibold">Content</label>
                <textarea id="content" name="content" rows="8" class="summernote w-full mt-2 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('content') border-red-500 @enderror">{{ old('content', $blog->content) }}</textarea>
                @error('content')
                    <p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                @enderror
            </div>

            <!-- Current Image Display -->
            <div>
                <label class="block text-gray-700 font-semibold">Current Image</label>
                <img src="{{ Storage::url($blog->image) }}" alt="{{ $blog->title }}" class="w-48 mt-4 rounded-lg">
            </div>

            <!-- Image Upload -->
            <div>
                <label for="image" class="block text-gray-700 font-semibold">Change Image</label>
                <input type="file" id="image" name="image" class="w-full mt-2 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('image') border-red-500 @enderror">
                @error('image')
                    <p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                @enderror
            </div>

            <!-- Save Button -->
            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.blogs.index') }}" class="bg-gray-500 text-white font-semibold py-2 px-4 rounded-lg shadow hover:bg-gray-600 transition duration-200">
                    Cancel
                </a>
                <button type="submit" class="bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg shadow hover:bg-blue-600 transition duration-200">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
