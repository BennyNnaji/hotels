@extends('admin.layouts.content')

@section('content')
    <div class="p-6">
        <!-- Page Header -->
        <header class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-semibold text-gray-800">Reservations</h1>
                <p class="text-gray-500">Overview of recent reservations and their status.</p>
            </div>
            <button class="rounded px-6 py-3 border-gray-800 text-gray-700 border-2 hover:bg-gray-800 hover:text-white"><a
                    href="{{ route('admin.reservations.create') }}">Add Reservation</a></button>

        </header>

        <!-- Reservations Table -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <table id="myTable" class="w-full divide-y divide-gray-200 overflow-x-auto">
                <thead>
                    <tr class="text-left border-b">
                        <th class="py-2">S/N</th>
                        <th class="py-2">Ref</th>
                        <th class="py-2">Guest Name</th>
                        <th class="py-2">Phone </th>
                        <th class="py-2">Guests </th>
                        <th class="py-2">Room Type</th>
                        <th class="py-2">Payment</th>
                        <th class="py-2">Price(₦)</th>
                        <th class="py-2">Check-in</th>
                        <th class="py-2">Check-out</th>
                        <th class="py-2">Status</th>
                        <th class="py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservations as $reservation)
                        <tr class="text-gray-700 border-b">
                            <td class="py-2">{{ $loop->iteration }}</td>
                            <td class="py-2">{{ $reservation->ref }}</td>
                            <td class="py-2">{{ $reservation->fullName }}</td>
                            <td class="py-2">{{ $reservation->phone }}</td>
                            <td class="py-2">{{ $reservation->guests }}</td>
                            <td class="py-2">{{ $reservation->roomType }}</td>
                            <td class="py-2">
                                @if ($reservation->payment == 1)
                                    <span class=" text-green-500">Paid</span>
                                @else
                                    <span class=" text-red-500">No Paid</span>
                                @endif
                            </td>
                            <td class="py-2">{{ number_format($reservation->price, 2) }}</td>
                            <td class="py-2">{{ \Carbon\Carbon::parse($reservation->checkIn)->format('M j, y') }}</td>
                            <td class="py-2">{{ \Carbon\Carbon::parse($reservation->checkOut)->format('M j, y') }}</td>
                            <td class="py-2">
                                <span
                                    class="px-2 py-1 rounded-lg 
                               @if ($reservation->status == 'active') bg-green-100 text-green-800
                               @elseif($reservation->status == 'canceled') bg-red-100 text-red-800
                                        @elseif($reservation->status == 'pending') bg-gray-100 text-gray-500
                                                 @elseif($reservation->status == 'completed') bg-black text-white
                               @elseif($reservation->status == 'timed out') bg-yellow-100 text-yellow-800 @endif">
                                    {{ ucfirst($reservation->status) }}
                                </span>
                            </td>
                            <td class="py-2">
                                <a href="{{ route('admin.reservations.show', $reservation->id) }}" class="text-blue-500"><i
                                        class="fas fa-eye"></i></a>
                                <a href="{{ route('admin.reservations.edit', $reservation->id) }}"
                                    class="text-yellow-500 hover:underline mx-2"> <i class="fas fa-edit"></i></a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
