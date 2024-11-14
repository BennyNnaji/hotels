@extends('admin.layouts.content')

@section('content')
    <div class="p-6">
        <!-- Page Header -->
        <header class="mb-8">
            <h1 class="text-3xl font-semibold text-gray-800">Add New Room</h1>
            <p class="text-gray-500">Fill out the details to add a new room to the listing.</p>
        </header>
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
                    @error('title')
                        <div class="flex items-center mt-1 text-red-500">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>
            </div>
            <!-- Room Ref -->
            <div>
                <label for="refId" class="block text-gray-700 font-semibold">Reference ID</label>
                <div class="relative">
                    <i class="fas fa-bed absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="text" id="refId" name="refId" value="{{ old('refId') }}"
                        class="w-full mt-2 p-3 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-primary"
                        placeholder="e.g., Del001" required>
                </div>
                @error('refId')
                    <div class="flex items-center mt-1 text-red-500">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>
            <!-- Maximum number of guests allowed in the room -->
            <div>
                <label for="maxGuest" class="block text-gray-700 font-semibold">Maximum Guests</label>
                <div class="relative">
                    <i class="fas fa-users absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="number" id="maxGuest" name="maxGuest" value="{{ old('maxGuest') }}"
                        class="w-full mt-2 p-3 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-primary"
                        placeholder="e.g., 2" required>
                </div>
                @error('maxGuest')
                    <div class="flex items-center mt-1 text-red-500">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>
            <!-- Room Quantity -->
            <div>
                <label for="quantity" class="block text-gray-700 font-semibold">How many Rooms</label>
                <div class="relative">
                    <i class="fas fa-hashtag absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="number" id="quantity" name="quantity" value="{{ old('quantity') }}"
                        class="w-full mt-2 p-3 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-primary"
                        placeholder="e.g., 8" required oninput="generateRoomNumbers()">
                </div>
                @error('quantity')
                    <div class="flex items-center mt-1 text-red-500">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <!-- Room Numbers Section -->
            <div id="roomNumbersSection" class="mt-4 space-y-2">
                <!-- Room number inputs will be generated here -->
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
                @error('amenities[]')
                    <div class="flex items-center mt-1 text-red-500">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
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
                @error('price')
                    <div class="flex items-center mt-1 text-red-500">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
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
                @error('photos[]')
                    <div class="flex items-center mt-1 text-red-500">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
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
    <script>
        function generateRoomNumbers() {
            const quantity = document.getElementById('quantity').value;
            const roomNumbersSection = document.getElementById('roomNumbersSection');
            roomNumbersSection.innerHTML = ''; // Clear previous inputs

            for (let i = 1; i <= quantity; i++) {
                // Create a new input field for each room number
                const roomInput = document.createElement('input');
                roomInput.type = 'text';
                roomInput.name = `room_numbers[]`;
                roomInput.placeholder = `Room Number ${i}`;
                roomInput.classList.add('w-full', 'p-3', 'border', 'border-gray-300', 'rounded-lg', 'focus:outline-none',
                    'focus:ring', 'focus:border-primary', 'mt-2');

                // Add the input field to the room numbers section
                roomNumbersSection.appendChild(roomInput);
            }
        }
    </script>
@endsection
