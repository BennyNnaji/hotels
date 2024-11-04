@extends('admin.layouts.content')

@section('content')
    <div class="p-6">
        <!-- Page Header -->
        <header class="mb-8">
            <h1 class="text-3xl font-semibold text-gray-800">Edit Reservation</h1>
            <p class="text-gray-500">Update the details of this reservation.</p>
        </header>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class=" text-red-300">{{ $error }}</div>
            @endforeach
        @endif
        <!-- Edit Reservation Form -->
        <form action="{{ route('admin.reservations.update', $reservation->id) }}" method="POST"
            class="bg-white p-6 rounded-lg shadow-lg space-y-6">
            @csrf
            @method('PUT')

            <!-- Guest Information -->
            <div>
                <label for="fullName" class="block text-gray-700 font-semibold">Guest Name</label>
                <input type="text" id="fullName" name="fullName" value="{{ old('fullName', $reservation->fullName) }}"
                    class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-primary"
                    required>
                @error('fullName')
                    <p class="text-red-500 mt-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-gray-700 font-semibold">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $reservation->email) }}"
                    class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-primary"
                    required>
                @error('email')
                    <p class="text-red-500 mt-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="phone" class="block text-gray-700 font-semibold">Phone</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone', $reservation->phone) }}"
                    class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-primary"
                    required>
                @error('phone')
                    <p class="text-red-500 mt-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                @enderror
            </div>

            <!-- Room & Reservation Details -->
            <div>
                <label for="roomType" class="block text-gray-700 font-semibold">Room Type</label>
                <select id="roomType" name="roomType"
                    class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-primary"
                    required>
                    <option value="">Select...</option>
                    <option value="single" {{ old('roomType', $reservation->roomType) == 'single' ? 'selected' : '' }}>
                        Single</option>
                    <option value="double" {{ old('roomType', $reservation->roomType) == 'double' ? 'selected' : '' }}>
                        Double</option>
                    <option value="suite" {{ old('roomType', $reservation->roomType) == 'suite' ? 'selected' : '' }}>Suite
                    </option>
                </select>
                @error('roomType')
                    <div class="text-red-500 text-xs mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div>
                <label for="checkIn" class="block text-gray-700 font-semibold">Check-in Date</label>
                <input type="date" id="checkIn" name="checkIn" value="{{ old('checkIn', $reservation->checkIn) }}"
                    class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-primary"
                    required>
                @error('checkIn')
                    <p class="text-red-500 mt-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="checkOut" class="block text-gray-700 font-semibold">Check-out Date</label>
                <input type="date" id="checkOut" name="checkOut" value="{{ old('checkOut', $reservation->checkOut) }}"
                    class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-primary"
                    required>
                @error('checkOut')
                    <p class="text-red-500 mt-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="guests" class="block text-gray-700 font-semibold">Number of Guests</label>
                <input type="number" id="guests" name="guests" value="{{ old('guests', $reservation->guests) }}"
                    class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-primary"
                    required>
                @error('guests')
                    <p class="text-red-500 mt-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                @enderror
            </div>

            <!-- Status -->
            <div>
                <label for="status" class="block text-gray-700 font-semibold">Status</label>
                <select id="status" name="status"
                    class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-primary"
                    required>
                    <option value="active" {{ old('status', $reservation->status) == 'active' ? 'selected' : '' }}>Active
                    </option>
                    <option value="canceled" {{ old('status', $reservation->status) == 'canceled' ? 'selected' : '' }}>
                        Canceled</option>
                    <option value="timed out" {{ old('status', $reservation->status) == 'timed out' ? 'selected' : '' }}>
                        Timed Out</option>
                </select>
                @error('status')
                    <p class="text-red-500 mt-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit"
                    class="w-full bg-primary text-white py-3 rounded-lg font-semibold hover:bg-primary-dark transition">
                    Update Reservation
                </button>
            </div>
        </form>
    </div>
@endsection
