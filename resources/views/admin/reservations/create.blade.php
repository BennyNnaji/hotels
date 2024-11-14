@extends('admin.layouts.content')

@section('content')
    <section class=" container mx-auto">
        <div class="bg-gray-100 flex flex-col items-center justify-center min-h-screen">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class=" text-red-300">{{ $error }}</div>
                @endforeach
            @endif
            <form class="bg-white elevation-5 rounded-lg px-8 pt-6 pb-8 my-4 w-full max-w-lg" method="POST"
                action="{{ route('admin.reservations.store') }}">
                @csrf
                <h2 class="text-2xl font-bold mb-6 text-center">Room Reservation</h2>

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


                    <div>
                        <label for="payment" class="block text-gray-700 font-semibold">Payment</label>

                        <!-- Hidden field for false value when checkbox is unchecked -->
                        <input type="hidden" name="payment" value="0">

                        <div
                            class="relative inline-block w-12 h-6 align-middle select-none transition duration-200 ease-in">
                            <input type="checkbox" name="payment" id="payment" value="1"
                                {{ old('payment') ? 'checked' : '' }}
                                class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer transition-all duration-200 ease-in-out checked:right-0 right-6 checked:bg-green-500 checked:text-green-500"
                                onchange="togglePaymentStatusText()">
                            <label for="payment"
                                class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                        </div>

                        <!-- Status Text -->
                        <span id="payment-status-text" class="ml-2 text-gray-700">
                            {{ old('payment') ? 'Paid' : 'Not Paid' }}
                        </span>

                        @error('payment')
                            <p class="text-red-500 mt-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    @push('style')
                        <style>
                            /* Custom toggle styling */
                            .toggle-checkbox:checked {
                                background-color: #10B981;
                                /* Tailwind's green-500 */
                            }

                            .toggle-checkbox:checked+.toggle-label {
                                background-color: #10B981;
                                /* Tailwind's green-500 */
                            }

                            .toggle-checkbox {
                                /* Toggle positioning */
                                right: 0;
                                transform: translateX(0);
                            }

                            .toggle-checkbox:checked {
                                transform: translateX(100%);
                            }
                        </style>
                    @endpush

                </div>

                <!-- Agreement and Consent -->
                <div class="mt-6 hidden">
                    <h3 class="text-lg font-semibold mb-2">Agreement and Consent</h3>
                    <div class="mb-4">
                        <div class="flex items-center">
                            <input type="checkbox" checked id="terms" name="terms"
                                class="text-primary form-checkbox h-5 w-5 focus:ring focus:ring-indigo-400">
                            <label for="terms" class="ml-2 text-gray-700">I agree to the <a href="#"
                                    class="text-indigo-600 underline">Terms & Conditions</a></label>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" checked id="marketing" name="marketing" value="1"
                            class="text-primary form-checkbox h-5 w-5 focus:ring focus:ring-indigo-400">
                        <label for="marketing" class="ml-2 text-gray-700">I want to receive promotional emails and
                            updates</label>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit"
                        class="w-full bg-gray-800 hover:bg-accent text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Reserve Room
                    </button>
                </div>
            </form>
        </div>
    </section>
    <script>
        // Making sure that checkIn date is today's date or future's date
        const checkIn = document.querySelector("#checkIn");
        const checkOut = document.querySelector("#checkOut");

        // Set minimum check-in date to today's date
        const today = new Date().toISOString().split("T")[0];
        checkIn.setAttribute("min", today);

        // Update check-out date minimum when check-in date changes
        checkIn.addEventListener("change", function() {
            checkOut.value = "";
            checkOut.setAttribute("min", checkIn.value);
        });

        // Initially set check-out date minimum to today if no check-in date
        checkOut.setAttribute("min", today);


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
