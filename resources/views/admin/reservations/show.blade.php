@extends('admin.layouts.content')

@section('content')
    <div class="p-6">
        <!-- Page Header -->
        <header class="mb-8">
            <h1 class="text-3xl font-semibold text-gray-800">Reservation Details</h1>
            <p class="text-gray-500">Detailed information about this reservation.</p>
        </header>

        <!-- Reservation Details -->
        <div class="bg-white p-6 rounded-lg shadow-lg space-y-6">
            <!-- Guest Information -->
            <div>
                <h2 class="text-lg font-semibold text-gray-700">Guest Information</h2>
                <p class="text-gray-700"><strong>Guest Name:</strong> {{ $reservation->fullName }}</p>
                <p class="text-gray-700"><strong>Email:</strong> {{ $reservation->email }}</p>
                <p class="text-gray-700"><strong>Phone:</strong> {{ $reservation->phone }}</p>
            </div>

            <!-- Room & Reservation Details -->
            <div>
                <h2 class="text-lg font-semibold text-gray-700">Room & Reservation Details</h2>
                <p class="text-gray-700"><strong>Room Type:</strong> {{ $reservation->roomType }}</p>
                <p class="text-gray-700"><strong>Reservation Ref:</strong> {{ $reservation->ref }}</p>
                <p class="text-gray-700"><strong>Check-in:</strong> {{ $reservation->checkIn }}</p>
                <p class="text-gray-700"><strong>Check-out:</strong> {{ $reservation->checkOut }}</p>
                <p class="text-gray-700"><strong>Number of Guests:</strong> {{ $reservation->guests }}</p>
                <p class="text-gray-700"><strong>Price:</strong> ₦{{ number_format($reservation->price, 2 ) }}</p>
                <p> <strong>
                        @if ($reservation->payment == 1)
                            <span class=" text-green-500">Paid</span>
                        @else
                            <span class=" text-red-500">No Paid</span>
                        @endif
                    </strong></p>
            </div>
            <div>
                  <p class="text-gray-700"><strong>Created On:</strong> {{ $reservation->created_at->format('l, F j, Y |  g:i A') }}</p>
            </div>

            <!-- Status -->
            <div>
                <h2 class="text-lg font-semibold text-gray-700">Status</h2>
                <p
                    class="px-3 py-1 inline-block rounded-lg text-white 
                @if ($reservation->status == 'active') bg-green-500
                 @elseif($reservation->status == 'pending') bg-yellow-500
                @elseif($reservation->status == 'canceled') bg-red-500
                @elseif($reservation->status == 'timed out') bg-gray-500 @endif">
                    {{ ucfirst($reservation->status) }}
                </p>
            </div>

            <!-- Actions -->
            <div class="flex space-x-4">
                <a href="{{ route('admin.reservations.edit', $reservation->id) }}"
                    class="px-4 py-2 bg-yellow-500 text-white font-semibold rounded-lg hover:bg-yellow-600 transition">
                    Edit Reservation
                </a>

            </div>
        </div>
    </div>
@endsection
