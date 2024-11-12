@extends('admin.layouts.content')

@section('content')
<div class="container mx-auto py-8">
<div class=" flex justify-between items-center">
    <h2 class="text-3xl font-semibold text-gray-700 text-center mb-8">{{ $title }}</h2>
    <a href="{{ route('admin.features.create') }}"
    class=" text-gray-800 px-4 py-2 hover:bg-gray-800 hover:text-white border-2 border-gray-800 rounded ">
    Add New Feature
</a>

</div>
    <!-- Features Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        @foreach ($features as $feature)
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <!-- Feature Title -->
            <div class="p-4">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $feature->title }}</h3>
                <p class="text-gray-600 text-sm">{!! Str::limit($feature->description, 100) !!}</p>
            </div>

            <!-- Action Icons -->
            <div class="flex space-x-5 items-center px-4 py-2 bg-gray-100 border-t">
                <!-- View Icon -->
                <a href="{{ route('admin.features.show', $feature->id) }}" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-eye"></i> <span class="sr-only">View</span>
                </a>

                <!-- Edit Icon -->
                <a href="{{ route('admin.features.edit', $feature->id) }}" class="text-blue-500 hover:text-blue-700">
                    <i class="fas fa-edit"></i> <span class="sr-only">Edit</span>
                </a>

                <!-- Delete Icon -->
                <form action="{{ route('admin.features.destroy', $feature->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this feature?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:text-red-700">
                        <i class="fas fa-trash-alt"></i> <span class="sr-only">Delete</span>
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
