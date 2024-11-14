@extends('admin.layouts.content')

@section('content')
    <div class="p-6">

        <!-- Page Header -->
        <header class="mb-8">
            <h1 class="text-3xl font-semibold text-gray-800">Edit Room: {{ $room->title }}</h1>
            <p class="text-gray-500">Update the details of the room below.</p>
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

            <!-- Room Ref -->
            <div>
                <label for="refId" class="block text-gray-700 font-semibold">Reference ID</label>
                <div class="relative">
                    <i class="fas fa-bed absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="text" id="refId" name="refId" value="{{ old('refId', $room->refId) }}"
                        class="w-full mt-2 p-3 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-primary"
                        placeholder="Del" required>
                    @error('refId')
                        <div class="flex items-center mt-1 text-red-500">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>
            </div>

            <!-- Room Quantity -->
            <div>
                <label for="quantity" class="block text-gray-700 font-semibold">How many Rooms</label>
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

            <!-- Room Numbers -->
            <div>
                <label for="room_numbers" class="block text-gray-700 font-semibold">Room Numbers</label>
                <div id="roomNumbersWrapper" class="space-y-2">
                    @if ($room->room_numbers)
                        @foreach (old('room_numbers', $room->room_numbers) as $roomNumber)
                            <div class="flex items-center space-x-2">
                                <input type="text" name="room_numbers[]" value="{{ $roomNumber }}"
                                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-primary"
                                    placeholder="e.g., 101" required>
                                <button type="button" class="removeRoomNumber text-red-500">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        @endforeach
                    @endif
                </div>
                <button type="button" id="addRoomNumber" class="text-primary mt-3">
                    <i class="fas fa-plus"></i> Add More Room Numbers
                </button>
                @error('room_numbers')
                    <div class="flex items-center mt-1 text-red-500">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <!-- Max Guests -->
            <div>
                <label for="maxGuest" class="block text-gray-700 font-semibold">Max Guests</label>
                <input type="number" id="maxGuest" name="maxGuest" value="{{ old('maxGuest', $room->maxGuest) }}"
                    class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-primary"
                    placeholder="e.g., 4" required>
                @error('maxGuest')
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
                            <input type="checkbox" name="amenities[]" value="{{ $amenity }} "
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
                            <div class="relative">
                                <img src="{{ asset('storage/' . $photo) }}" alt="Room Photo"
                                    class="w-full h-32 object-cover rounded-lg">
                                <button type="button"
                                    class="absolute top-0 right-0 p-1 bg-red-600 text-white rounded-full text-xs">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        @endforeach
                    @else
                        <p class="text-gray-500">No photos uploaded yet.</p>
                    @endif
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit"
                    class="px-6 py-3 bg-primary text-white font-semibold rounded-lg shadow hover:bg-primary-dark">
                    Update Room
                </button>
            </div>
        </form>
    </div>

    <!-- JavaScript for Dynamic Room Numbers -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roomNumbersWrapper = document.getElementById('roomNumbersWrapper');
            const addRoomNumberButton = document.getElementById('addRoomNumber');
            const removeRoomNumberButtons = document.querySelectorAll('.removeRoomNumber');

            // Function to add room number input fields dynamically
            addRoomNumberButton.addEventListener('click', function() {
                const roomNumberDiv = document.createElement('div');
                roomNumberDiv.classList.add('flex', 'items-center', 'space-x-2');

                const roomNumberInput = document.createElement('input');
                roomNumberInput.type = 'text';
                roomNumberInput.name = 'room_numbers[]';
                roomNumberInput.classList.add('w-full', 'p-3', 'border', 'border-gray-300', 'rounded-lg',
                    'focus:outline-none', 'focus:ring', 'focus:border-primary');
                roomNumberInput.placeholder = 'e.g., 102';
                roomNumberDiv.appendChild(roomNumberInput);

                const removeButton = document.createElement('button');
                removeButton.type = 'button';
                removeButton.classList.add('removeRoomNumber', 'text-red-500');
                removeButton.innerHTML = '<i class="fas fa-trash-alt"></i>';
                roomNumberDiv.appendChild(removeButton);

                roomNumbersWrapper.appendChild(roomNumberDiv);

                // Reattach remove button functionality
                removeButton.addEventListener('click', function() {
                    roomNumberDiv.remove();
                });
            });

            // Attach remove functionality to existing buttons
            removeRoomNumberButtons.forEach(button => {
                button.addEventListener('click', function() {
                    button.closest('div').remove();
                });
            });
        });
    </script>
@endsection
