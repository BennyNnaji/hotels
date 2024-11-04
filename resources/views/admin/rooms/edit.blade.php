@extends('admin.layouts.content')

@section('content')
    <div class="p-6">
        <!-- Page Header -->
        <header class="mb-8">
            <h1 class="text-3xl font-semibold text-gray-800">Edit Room: {{ $room->title }}</h1>
            <p class="text-gray-500">Update the details of the room below.</p>
        </header>

        <!-- Room Edit Form -->
        <form action="{{ route('admin.rooms.update', $room->id) }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-6 rounded-lg shadow-md space-y-6">
            @csrf
            @method('PUT')

            <!-- Room Title -->
            <div>
                <label for="title" class="block text-gray-700 font-semibold">Room Title</label>
                <input type="text" id="title" name="title" value="{{ old('title', $room->title) }}"
                    class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-primary"
                    placeholder="e.g., Deluxe Suite" required>
                @error('title')
                    <div class="flex items-center mt-1 text-red-500">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>
            <!-- Room Quantity -->
            <div>
                <label for="quantity" class="block text-gray-700 font-semibold">Room Quantity</label>
                <input type="number" id="quantity" name="quantity" value="{{ old('quantity', $room->quantity) }}"
                    class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-primary"
                    placeholder="e.g., 8" required>
                @error('quantity')
                    <div class="flex items-center mt-1 text-red-500">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <!-- Room Description -->
            <div>
                <label for="description" class="block text-gray-700 font-semibold">Description</label>
                <textarea id="description" name="description"
                    class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-primary"
                    rows="4" placeholder="Describe the room features, ambiance, etc." required>{{ old('description', $room->description) }}</textarea>
                @error('description')
                    <div class="flex items-center mt-1 text-red-500">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <!-- Amenities -->
            <div>
                <label class="block text-gray-700 font-semibold">Amenities</label>
                <div class="flex flex-wrap gap-3 mt-2">
                    @php
                        $amenitiesList = [
                            'King-size bed',
                            'Queen-size bed',
                            'Double-size bed',
                            'Twin-size bed',
                            'Wi-Fi',
                            'TV',
                            'Air Conditioning',
                        ];
                    @endphp
                    @foreach ($amenitiesList as $amenity)
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="amenities[]" value="{{ $amenity }}"
                                class="rounded text-primary"
                                {{ in_array($amenity, old('amenities', $room->amenities)) ? 'checked' : '' }}>
                            <span>{{ $amenity }}</span>
                        </label>
                    @endforeach
                </div>
                @error('amenities')
                    <div class="flex items-center mt-1 text-red-500">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <!-- Room Price -->
            <div>
                <label for="price" class="block text-gray-700 font-semibold">Price (₦) per Night</label>
                <input type="number" id="price" name="price" value="{{ old('price', $room->price) }}"
                    class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-primary"
                    placeholder="e.g., 15000" required>
                @error('price')
                    <div class="flex items-center mt-1 text-red-500">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <!-- Room Photos -->
            <div>
                <label for="photos" class="block text-gray-700 font-semibold">Upload New Photos</label>
                <input type="file" id="photos" name="photos[]"
                    class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-primary"
                    multiple>
                <small class="text-gray-500">You can upload multiple images. (Leave empty to keep existing photos)</small>
                @error('photos')
                    <div class="flex items-center mt-1 text-red-500">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <!-- Existing Photos -->
            <div>
                <h2 class="text-lg font-semibold text-gray-700">Existing Photos</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-2">
                    @if (!empty($room->photos))
                        @foreach ($room->photos as $photo)
                            <div class="h-32">
                                <img src="{{ Storage::url($photo) }}" alt="Room Photo"
                                    class="w-full h-full object-cover rounded-lg shadow-sm">
                            </div>
                        @endforeach
                    @else
                        <p class="text-gray-600">No existing photos.</p>
                    @endif
                </div>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit"
                    class="w-full bg-primary text-white py-3 rounded-lg font-semibold hover:bg-primary-dark transition">
                    Update Room
                </button>
            </div>
        </form>
    </div>
@endsection
