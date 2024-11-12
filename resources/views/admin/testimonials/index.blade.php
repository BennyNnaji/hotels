@extends('admin.layouts.content')

@section('content')
    <div class="container mx-auto px-4 py-10">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold text-center text-gray-800 mb-8">Guests' Testimonials</h1>
            <button class="rounded px-6 py-3 border-gray-800 text-gray-700 border-2 hover:bg-gray-800 hover:text-white">
                <a href="{{ route('admin.testimonials.create') }}">Add Testimonial</a>
            </button>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @foreach ($testimonials as $testimonial)
                <div class="bg-gray-50 p-6 rounded-lg shadow-lg flex flex-col justify-between">
                    <!-- Testimonial Content -->
                    <div>
                        <p class="text-gray-700 leading-relaxed mb-4">"{{ $testimonial->testimonial }}"</p>
                        <div class="flex items-center mt-4">
                            @if ($testimonial->image)
                                <img src="{{ Storage::url($testimonial->image) }}" alt="{{ $testimonial->guest }}"
                                     class="w-12 h-12 rounded-full mr-4">
                            @else
                                <div class="w-12 h-12 rounded-full bg-gray-300 mr-4"></div>
                            @endif
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">{{ $testimonial->guest }}</h3>
                                <p class="text-sm text-gray-500">Stayed in {{ $testimonial->roomType }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-6 flex justify-end space-x-2">
                        <!-- Edit Button -->
                        <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}"
                           class="text-blue-600 hover:text-blue-800">
                            <i class="fas fa-edit"></i> 
                        </a>

                        <!-- Delete Button -->
                        <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this testimonial?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">
                                <i class="fas fa-trash-alt"></i> 
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $testimonials->links() }}
        </div>
    </div>
@endsection
