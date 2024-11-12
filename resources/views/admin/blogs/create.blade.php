@extends('admin.layouts.content')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Create New Blog Post</h1>
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

    <div class="bg-white p-6 rounded-lg shadow-lg">
        <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Title Field -->
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-semibold">Title</label>
                <input type="text" name="title" id="title" class="w-full mt-2 p-3 border rounded-lg @error('title') border-red-500 @enderror" value="{{ old('title') }}" placeholder="Enter blog title">
                @error('title')
                    <p class="text-red-500 text-sm mt-2"><i class="text-red-500 mr-1">⚠️</i>{{ $message }}</p>
                @enderror
            </div>

            <!-- Content Field -->
            <div class="mb-4">
                <label for="content" class="block text-gray-700 font-semibold">Content</label>
                <textarea name="content" id="content" class="summernote w-full mt-2 p-3 border rounded-lg @error('content') border-red-500 @enderror" placeholder="Write blog content here">{{ old('content') }}</textarea>
                @error('content')
                    <p class="text-red-500 text-sm mt-2"><i class="text-red-500 mr-1">⚠️</i>{{ $message }}</p>
                @enderror
            </div>

            <!-- Image Upload Field -->
            <div class="mb-6">
                <label for="image" class="block text-gray-700 font-semibold">Image</label>
                <input type="file" name="image" id="image" class="mt-2 p-3 border rounded-lg w-full @error('image') border-red-500 @enderror">
                @error('image')
                    <p class="text-red-500 text-sm mt-2"><i class="text-red-500 mr-1">⚠️</i>{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-white font-semibold py-2 px-6 rounded-lg hover:bg-blue-600 transition duration-200">Create Blog Post</button>
            </div>
        </form>
    </div>
</div>
@endsection
