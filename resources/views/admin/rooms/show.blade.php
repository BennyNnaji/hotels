@extends('admin.layouts.content')

@section('content')
    <div class="p-6">
        <!-- Page Header -->
        <header class="mb-8">
            <h1 class="text-3xl font-semibold text-gray-800">{{ $room->title }}</h1>
            <p class="text-gray-500">Room Details</p>
        </header>

        <!-- Room Details -->
        <div class="bg-white p-6 rounded-lg shadow-md space-y-6">
            <div class="mb-4">
                <h2 class="text-xl font-semibold text-gray-700">Description</h2>
                <p class="text-gray-600">{{ $room->description }}</p>
            </div>

            <div class="mb-4">
                <h2 class="text-xl font-semibold text-gray-700">Amenities</h2>
                <ul class="list-disc list-inside text-gray-600">
                    @if(!empty($room->amenities))
                        @foreach($room->amenities as $amenity)
                            <li>{{ $amenity }}</li>
                        @endforeach
                    @else
                        <li>No amenities available.</li>
                    @endif
                </ul>
            </div>

            <div class="mb-4">
                <h2 class="text-xl font-semibold text-gray-700">Price</h2>
                <p class="text-gray-600">₦{{ number_format($room->price, 2) }} per night</p>
            </div>

            <div class="mb-4">
                <h2 class="text-xl font-semibold text-gray-700">Photos</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @if(!empty($room->photos))
                        @foreach($room->photos as $photo)
                            <div class="h-32">
                                <img src="{{ Storage::url($photo) }}" alt="Room Photo" class="w-full h-full object-cover rounded-lg shadow-sm">
                            </div>
                        @endforeach
                    @else
                        <p class="text-gray-600">No photos available.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex space-x-4 mt-6">
            <a href="{{ route('admin.rooms.edit', $room->id) }}" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition">
                Edit Room
            </a>

            <form action="{{ route('admin.rooms.destroy', $room->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this room?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600 transition">
                    Delete Room
                </button>
            </form>
        </div>

        <!-- Back Button -->
        <div class="mt-6">
            <a href="{{ route('admin.rooms.index') }}" class="text-primary underline">Back to Rooms List</a>
        </div>
    </div>
@endsection
