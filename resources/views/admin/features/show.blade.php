@extends('admin.layouts.content')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-md shadow-md mt-10">
    <h2 class="text-2xl font-semibold text-gray-700 text-center mb-6">Feature Details</h2>

    <!-- Feature Details -->
    <div class="mb-6">
        <h3 class="text-lg font-semibold text-gray-800">Title:</h3>
        <p class="text-gray-700">{{ $feature->title }}</p>
    </div>

    <div class="mb-6">
        <h3 class="text-lg font-semibold text-gray-800">Description:</h3>
        <p class="text-gray-700">{!! $feature->description !!}</p>
    </div>

    <!-- Action Buttons -->
    <div class="flex justify-between mt-8">
        <a href="{{ route('admin.features.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
            Back to Features List
        </a>
        
        <div class="flex space-x-4">
            <!-- Edit Button -->
            <a href="{{ route('admin.features.edit', $feature->id) }}" 
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Edit Feature
            </a>

            <!-- Delete Form -->
            <form action="{{ route('admin.features.destroy', $feature->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this feature?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                    Delete Feature
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
