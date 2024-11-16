
@extends('admin.layouts.content')

@section('content')
    <div class="p-6">
        <!-- Page Header -->
        <header class="mb-8">
            <h1 class="text-3xl font-semibold text-gray-800">Edit Reservation</h1>
            <p class="text-gray-500">Update the details of this reservation.</p>
            <h1 class="text-lg mt-3 font-semibold text-gray-800">Reservation Ref: {{ $reservation->ref }}</h1>
        </header>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="text-red-300">{{ $error }}</div>
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
                    <p class="text-red-500 mt-1">{{ $message }}</p>
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
            <!-- Room Type, Price, Guests, Payment -->

            <div>
                <label for="roomType" class="block text-gray-700 font-semibold">Room Type</label>
                <select id="roomType" name="roomType" onchange="updateDetails()"
                    class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-primary"
                    required>
                    <option value="">Select...</option>
                    @foreach ($rooms as $room)
                        <option value="{{ $room->title }}" data-price="{{ $room->price }}"
                            data-maxGuest="{{ $room->maxGuest }}"
                            {{ old('roomType', $reservation->roomType) == $room->title ? 'selected' : '' }}>
                            {{ $room->title }}
                        </option>
                    @endforeach
                </select>
                <p>Price Per Night: <span id="priceDisplay"
                        class="text-green-400 font-semibold">₦{{ old('price', number_format($reservation->price, 2)) }}</span>
                </p>
                {{-- <input type="hidden" name="" id="priceInput" value="{{ old('price', $reservation->price) }}"> --}}
                <p>Maximum Guests: <span id="maxGuest"
                        class="text-red-400 font-semibold">{{ old('maxGuest', $reservation->maxGuest) }}</span></p>
                @error('roomType')
                    <p class="text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="checkIn" class="block text-gray-700 font-semibold">Check-in Date</label>
                <input type="date" id="checkIn" name="checkIn" value="{{ old('checkIn', $reservation->checkIn) }}"
                    class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-primary"
                    required>
                @error('checkIn')
                    <p class="text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="checkOut" class="block text-gray-700 font-semibold">Check-out Date</label>
                <input type="date" id="checkOut" name="checkOut" value="{{ old('checkOut', $reservation->checkOut) }}"
                    class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-primary"
                    required>
                @error('checkOut')
                    <p class="text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            {{-- 
            <div>
                <label for="guests" class="block text-gray-700 font-semibold">Number of Guests</label>
                <input type="number" id="guests" name="guests" value="{{ old('guests', $reservation->guests) }}"
                    class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-primary" max="{{ $room->maxGuest }}"
                    required>
                @error('guests')
                    <p class="text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div> --}}
            <div>
                <label for="guests" class="block text-gray-700 font-semibold">Number of Guests</label>
                <input type="number" id="guests" name="guests" value="{{ old('guests', $reservation->guests) }}"
                    class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-primary"
                    required oninput="validateGuests()">
                @error('guests')
                    <p class="text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <p>Total Price : <span id="totalPrice"
                    class="text-green-400 font-semibold">₦0{{ old('totalPrice', number_format($reservation->totalPrice, 2)) }}</span>
            </p>
            <input type="hidden" name="price" id="totalPriceInput"
                value="{{ old('totalPrice', $reservation->totalPrice) }}">


            <div>
                <label for="payment" class="block text-gray-700 font-semibold">Payment</label>

                <!-- Hidden field for false value when checkbox is unchecked -->
                <input type="hidden" name="payment" value="0">

                <div class="relative inline-block w-12 h-6 align-middle select-none transition duration-200 ease-in">
                    <input type="checkbox" name="payment" id="payment" value="1"
                        {{ old('payment', $reservation->payment) ? 'checked' : '' }}
                        class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer transition-all duration-200 ease-in-out checked:right-0 right-6 checked:bg-green-500 checked:text-green-500"
                        onchange="togglePaymentStatusText()">
                    <label for="payment"
                        class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                </div>

                <!-- Status Text -->
                <span id="payment-status-text" class="ml-2 text-gray-700">
                    {{ old('payment', $reservation->payment) ? 'Paid' : 'Not Paid' }}
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

            @push('scripts')
                <script>
                    function togglePaymentStatusText() {
                        const paymentCheckbox = document.getElementById('payment');
                        const statusText = document.getElementById('payment-status-text');
                        statusText.textContent = paymentCheckbox.checked ? 'Paid' : 'Not Paid';
                    }
                </script>
            @endpush
            <!-- Status -->
            <div>
                <label for="status" class="block text-gray-700 font-semibold">Status</label>
                <select id="status" name="status"
                    class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-primary"
                    required>
                    <option value="timed out" {{ old('status', $reservation->status) == 'pending' ? 'selected' : '' }}>
                        Pending</option>
                    <option value="active" {{ old('status', $reservation->status) == 'active' ? 'selected' : '' }}>Active
                    </option>
                    <option value="canceled" {{ old('status', $reservation->status) == 'canceled' ? 'selected' : '' }}>
                        Canceled</option>
                    <option value="timed out" {{ old('status', $reservation->status) == 'timed out' ? 'selected' : '' }}>
                        Timed Out</option>
                    <option value="completed" {{ old('status', $reservation->status) == 'completed' ? 'selected' : '' }}>
                        Completed</option>
                </select>
                @error('status')
                    <p class="text-red-500 mt-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                @enderror
            </div>

            <div>
                <button type="submit"
                    class="w-full bg-primary text-white py-3 rounded-lg font-semibold hover:bg-primary-dark transition">
                    Update Reservation
                </button>
            </div>
        </form>
    </div>

    <script>
        // Preload values
        document.addEventListener("DOMContentLoaded", updateDetails);

        const roomType = document.querySelector("#roomType");
        const priceDisplay = document.querySelector("#priceDisplay");
        const maxGuest = document.querySelector("#maxGuest");
        const checkIn = document.querySelector("#checkIn");
        const checkOut = document.querySelector("#checkOut");
        const totalPrice = document.querySelector("#totalPrice");
        const guests = document.querySelector("#guests");



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


        // Make sure guests are not more than the room capacity
        function validateGuests() {
            const maxGuests = maxGuest.textContent.trim();
            const guestCount = guests.value;
            if (guestCount > maxGuests || guestCount.length > 1 || (guestCount.length === 1 && guestCount[0] === '0') ){
                alert(`The maximum allowed guests for this room is ${maxGuests}.`);
                guests.value = maxGuests;
            }
        }

        function updateDetails() {
            // Update Price & maximum Guest displays with respect to room selected
            const selectedOption = roomType.options[roomType.selectedIndex];
            const price = parseFloat(selectedOption.getAttribute("data-price")) || 0;
            const maxGuestValue = selectedOption.getAttribute("data-maxGuest") || 0;
            priceDisplay.textContent = `₦${price.toLocaleString()}`;
            maxGuest.textContent = maxGuestValue;
            if (checkIn.value && checkOut.value) {
                const startDate = new Date(checkIn.value);
                const endDate = new Date(checkOut.value);
                const diffInDays = (endDate - startDate) / (1000 * 60 * 60 * 24);

                if (diffInDays > 0) {
                    const calculatedPrice = price * diffInDays;
                    totalPrice.textContent = `₦${calculatedPrice.toLocaleString()}`;
                    document.querySelector('#totalPriceInput').value = calculatedPrice;
                } else {
                    totalPrice.textContent = '₦0';
                    document.querySelector('#totalPriceInput').value = 0;
                }

            }
        }

        document.querySelector("#checkIn").addEventListener("change", updateDetails);
        document.querySelector("#checkOut").addEventListener("change", updateDetails);
        document.querySelector("#roomType").addEventListener("change", updateDetails);
    </script>

@endsection
