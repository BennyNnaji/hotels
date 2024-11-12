@extends('layout/content')
@section('content')
    <section class=" container mx-auto">
        <div class="bg-gray-100 flex flex-col items-center justify-center min-h-screen">
       
            <form class="bg-white elevation-5 rounded-lg px-8 pt-6 pb-8 my-4 w-full max-w-lg" method="POST"
                action="{{ route('reservation') }}">
                @csrf
                <h2 class="text-2xl font-bold mb-6 text-center">Room Reservation</h2>
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

                <!-- Personal Information -->
                <div>
                    <h3 class="text-lg font-semibold mb-2">Personal Information</h3>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="fullName">Full Name</label>
                        <input type="text" id="fullName" name="fullName" value="{{ old('fullName') }}"
                            placeholder="Enter your full name"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @error('fullName')
                            <div class="text-red-500 text-xs mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email Address</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            placeholder="Enter your email address"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @error('email')
                            <div class="text-red-500 text-xs mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                            placeholder="Enter your phone number"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @error('phone')
                            <div class="text-red-500 text-xs mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <!-- Booking Details -->
                <div class="mt-6">
                    <h3 class="text-lg font-semibold mb-2">Booking Details</h3>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="checkIn">Check-in Date</label>
                        <input type="date" id="checkIn" name="checkIn" value="{{ old('checkIn') }}"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @error('checkIn')
                            <div class="text-red-500 text-xs mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="checkOut">Check-out Date</label>
                        <input type="date" id="checkOut" name="checkOut" value="{{ old('checkOut') }}"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @error('checkOut')
                            <div class="text-red-500 text-xs mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="roomType">Room Type</label>
                        <select id="roomType" name="roomType"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            onchange="updatePrice()">
                            <option value="">Select...</option>
                            @foreach ($rooms as $room)
                                <option value="{{ $room->title }}" data-price="{{ $room->price }}"
                                    {{ old('roomType') == $room->title ? 'selected' : '' }}>{{ $room->title }}
                                </option>
                            @endforeach
                        </select>

                        <!-- Price Display -->
                        <p>Price: <span id="priceDisplay" class="text-green-400 font-semibold">₦0</span></p>
                        <input type="hidden" name="price" id="priceInput">

                        @error('roomType')
                            <div class="text-red-500 text-xs mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="guests">Number of Guests</label>
                        <input type="number" id="guests" name="guests" value="{{ old('guests') }}"
                            placeholder="Enter number of guests"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @error('guests')
                            <div class="text-red-500 text-xs mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <!-- Agreement and Consent -->
                <div class="mt-6">
                    <h3 class="text-lg font-semibold mb-2">Agreement and Consent</h3>
                    <div class="mb-4">
                        <div class="flex items-center">
                            <input type="checkbox" id="terms" name="terms" {{ old('terms') ? 'checked' : '' }}
                                class="text-primary form-checkbox h-5 w-5 focus:ring focus:ring-indigo-400">
                            <label for="terms" class="ml-2 text-gray-700">I agree to the <a
                                    href="{{ route('guest', ['page' => 'privacy']) }}"
                                    class="text-indigo-600 underline">Privacy Policy</a> and <a
                                    href="{{ route('guest', ['page' => 'terms']) }}"
                                    class="text-indigo-600 underline">Terms & Conditions</a></label>
                        </div>
                        @error('terms')
                            <div class="text-red-500 text-xs mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" id="marketing" name="marketing" {{ old('marketing') ? 'checked' : '' }}
                            class="text-primary form-checkbox h-5 w-5 focus:ring focus:ring-indigo-400">
                        <label for="marketing" class="ml-2 text-gray-700">I want to receive promotional emails and
                            updates</label>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit"
                        class="w-full bg-primary hover:bg-accent text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Reserve Room
                    </button>
                </div>
            </form>
        </div>
    </section>
    <script>
        // DYnamic price update
        function updatePrice() {
            const roomSelect = document.getElementById("roomType");
            const priceInput = document.getElementById("priceInput");
            const selectedOption = roomSelect.options[roomSelect.selectedIndex];
            const price = selectedOption.getAttribute("data-price") || 0;
            document.getElementById("priceDisplay").textContent = `₦${price}`;
            priceInput.value = price;
        }

        // Initialize price display if a room type is preselected
        document.addEventListener("DOMContentLoaded", updatePrice);
    </script>
@endsection
