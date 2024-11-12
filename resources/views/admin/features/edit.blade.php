@extends('admin.layouts.content')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-md shadow-md mt-10">
    <h2 class="text-2xl font-semibold text-gray-700 text-center">Edit Feature</h2>
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

    <!-- Edit Feature Form -->
    <form action="{{ route('admin.features.update', $feature->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Title Field -->
        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-semibold">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title', $feature->title) }}"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600 @error('title') border-red-500 @enderror">
            @error('title')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Description Field -->
        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-semibold">Description</label>
            <textarea name="description" id="description" rows="6" 
                class=" summernote w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600 @error('description') border-red-500 @enderror">{{ old('description', $feature->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit"
                class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                Update Feature
            </button>
        </div>
    </form>
</div>
@endsection
