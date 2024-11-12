@extends('admin.layouts.content')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-semibold text-gray-800">{{ $title }}</h1>

    <div class="mt-6 bg-white p-6 rounded-lg shadow-lg">
        <!-- Success/Error Message Display -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Guest Name Field -->
            <div class="mb-4">
                <label for="guest" class="block text-gray-700 font-semibold">Guest Name</label>
                <input type="text" id="guest" name="guest" value="{{ old('guest', $testimonial->guest) }}"
                       class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-primary"
                       placeholder="Guest Name" required>
                @error('guest')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Room Type Field -->
            <div class="mb-4">
                <label for="roomType" class="block text-gray-700 font-semibold">Room Type</label>
                <input type="text" id="roomType" name="roomType" value="{{ old('roomType', $testimonial->roomType) }}"
                       class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-primary"
                       placeholder="Room Type" required>
                @error('roomType')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Testimonial Text Field -->
            <div class="mb-4">
                <label for="testimonial" class="block text-gray-700 font-semibold">Testimonial</label>
                <textarea id="testimonial" name="testimonial"
                          class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-primary"
                          placeholder="Write the testimonial here..." rows="4" required>{{ old('testimonial', $testimonial->testimonial) }}</textarea>
                @error('testimonial')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Image Upload Field -->
            <div class="mb-4">
                <label for="image" class="block text-gray-700 font-semibold">Image</label>
                @if($testimonial->image)
                    <div class="mb-2">
                        <img src="{{ Storage::url($testimonial->image) }}" alt="Current Image" class="w-16 h-16 rounded-lg shadow-sm">
                    </div>
                @endif
                <input type="file" id="image" name="image"
                       class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-primary"
                       accept="image/*">
                @error('image')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end mt-6">
                <button type="submit"
                        class="px-6 py-2 text-white bg-primary rounded-lg hover:bg-primary-dark focus:outline-none">
                    Update Testimonial
                </button>
            </div>
        </form>
    </div>
</div>
@endsection