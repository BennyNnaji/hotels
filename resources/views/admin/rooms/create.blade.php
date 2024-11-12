@extends('admin.layouts.content')

@section('content')
    <div class="p-6">
        <!-- Page Header -->
        <header class="mb-8">
            <h1 class="text-3xl font-semibold text-gray-800">Add New Room</h1>
            <p class="text-gray-500">Fill out the details to add a new room to the listing.</p>
        </header>

        <!-- Room Form -->
        <form action="{{ route('admin.rooms.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-6 rounded-lg shadow-md space-y-6">
            @csrf

            <!-- Room Title -->
            <div>
                <label for="title" class="block text-gray-700 font-semibold">Room Title</label>
                <div class="relative">
                    <i class="fas fa-bed absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="text" id="title" name="title" value="{{ old('title') }}"
                        class="w-full mt-2 p-3 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-primary"
                        placeholder="e.g., Deluxe Suite" required>
                </div>
            </div>
            <!-- Room Ref -->
            <div>
                <label for="refId" class="block text-gray-700 font-semibold">Reference ID</label>
                <div class="relative">
                    <i class="fas fa-bed absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="text" id="refId" name="refId" value="{{ old('refId') }}"
                        class="w-full mt-2 p-3 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-primary"
                        placeholder="Del" required>
                </div>
            </div>
            <!-- Room Quantity -->
            <div>
                <label for="quantity" class="block text-gray-700 font-semibold">Room Quantity</label>
                <div class="relative">
                    <i class="fas fa-hashtag absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="number" id="quantity" name="quantity" value="{{ old('quantity') }}"
                        class="w-full mt-2 p-3 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-primary"
                        placeholder="e.g., 8 "required>
                </div>
            </div>
            <!-- Room Description -->
            <div>
                <label for="description" class="block text-gray-700 font-semibold">Description</label>
                <div class="relative">
                    <i class="fas fa-info-circle absolute left-3 top-4 text-gray-400"></i>
                    <textarea id="description" name="description"
                        class="w-full mt-2 p-3 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-primary"
                        rows="4" placeholder="Describe the room features, ambiance, etc." required>{{ old('description') }}</textarea>
                </div>
            </div>

            <!-- Amenities -->
            <div>
                <label class="block text-gray-700 font-semibold">Amenities</label>
                <div class="flex flex-wrap gap-3 mt-2">
                    @php
                        $amenities = [
                            'King-size Bed',
                            'Queen-size Bed',
                            'Double-size Bed',
                            'Twin-size Bed',
                            'Wi-Fi',
                            'TV',
                            'Air Conditioning',
                        ];
                    @endphp
                    @foreach ($amenities as $amenity)
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="amenities[]" value="{{ $amenity }}"
                                {{ in_array($amenity, old('amenities', [])) ? 'checked' : '' }}
                                class="rounded text-primary">
                            <span>{{ $amenity }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Room Price -->
            <div>
                <label for="price" class="block text-gray-700 font-semibold">Price (₦) per Night</label>
                <div class="relative">
                    <i class="fas fa-money-bill-wave absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="number" id="price" name="price" value="{{ old('price') }}"
                        class="w-full mt-2 p-3 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-primary"
                        placeholder="e.g., 15000" required>
                </div>
            </div>

            <!-- Room Photos -->
            <div>
                <label for="photos" class="block text-gray-700 font-semibold">Upload Photos</label>
                <div class="relative">
                    <i class="fas fa-camera absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="file" id="photos" name="photos[]"
                        class="w-full mt-2 p-3 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-primary"
                        multiple required>
                </div>
                <small class="text-gray-500">You can upload multiple images</small>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit"
                    class="w-full bg-primary text-white py-3 rounded-lg font-semibold hover:bg-primary-dark transition">
                    Add Room
                </button>
            </div>
        </form>
    </div>
@endsection
