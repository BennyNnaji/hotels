@extends('admin.layouts.content')

@section('content')
    <div class="p-6">
        <!-- Page Header -->
        <header class="mb-8">
            <h1 class="text-3xl font-semibold text-gray-800">Manage Rooms</h1>
            <p class="text-gray-500">View, edit, or delete rooms in the listing.</p>
        </header>

        <!-- Add Room Button -->
        <div class="mb-4">
            <a href="{{ route('admin.rooms.create') }}"
                class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary-dark transition">
                Add New Room
            </a>
        </div>

        <!-- Rooms Table -->
        <div class="overflow-x-auto bg-white rounded-lg shadow-md p-5">
            <table id="myTable" class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">S/N</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Room
                            Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ref ID
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">QTY</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rm #</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Max
                            Guests</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price (₦)
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amenities
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($rooms as $room)
                        <tr class="divide-y divide-gray-200">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $room->title }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $room->refId }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $room->quantity }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($room->room_numbers)
                                    @foreach ($room->room_numbers as $room_number)
                                        <span
                                            class=" bg-gray-200 rounded-full px-2 m-2 py-1 text-xs font-semibold text-gray-700 block">
                                            {{ $room_number }}</span>
                                    @endforeach
                                @else
                                <span class="text-gray-500">N/A</span>
                                @endif

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $room->maxGuest }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">₦{{ number_format($room->price, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @foreach ($room->amenities as $amenity)
                                    <span
                                        class=" bg-gray-200 rounded-full px-2 m-2 py-1 text-xs font-semibold text-gray-700 block">{{ $amenity }}</span>
                                @endforeach
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <a href="{{ route('admin.rooms.show', $room->id) }}"
                                    class="text-gray-600 hover:text-gray-900"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('admin.rooms.edit', $room->id) }}"
                                    class="text-blue-600 hover:text-blue-900"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin.rooms.destroy', $room->id) }}" method="POST"
                                    class="inline-block"
                                    onsubmit="return confirm('Are you sure you want to delete this room?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900"><i
                                            class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
