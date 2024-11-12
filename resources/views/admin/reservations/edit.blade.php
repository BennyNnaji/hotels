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
            <div>
                <label for="roomType" class="block text-gray-700 font-semibold">Room Type</label>
                <select id="roomType" name="roomType" onchange="updatePrice()"
                    class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-primary"
                    required>
                    <option value="">Select...</option>
                    @foreach ($rooms as $room)
                        <option value="{{ $room->title }}" data-price="{{ $room->price }}"
                            {{ old('roomType', $reservation->roomType) == $room->title ? 'selected' : '' }}>
                            {{ $room->title }}
                        </option>
                    @endforeach
                </select>

                <!-- Price Display -->
                <p>Price: <span id="priceDisplay"
                        class="text-green-400 font-semibold">₦{{ old('price', $reservation->price) }}</span></p>
                <input type="hidden" name="price" id="priceInput" value="{{ old('price', $reservation->price) }}">

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
    <script>
        // Store the original room type and price
        const originalRoomType = "{{ $reservation->roomType }}";
        const originalPrice = "{{ $reservation->price }}";
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

        

        // Function to dynamically update the price display based on room selection
        function updatePrice() {
            const roomSelect = document.getElementById("roomType");
            const priceInput = document.getElementById("priceInput");
            const selectedOption = roomSelect.options[roomSelect.selectedIndex];
            const selectedRoomType = selectedOption.value;
            const price = selectedOption.getAttribute("data-price") || 0;

            // Check if the selected room type matches the original room type
            if (selectedRoomType === originalRoomType) {
                document.getElementById("priceDisplay").textContent = `₦${originalPrice}`;
                priceInput.value = originalPrice;
            } else {
                // Update display with the new room's price
                document.getElementById("priceDisplay").textContent = `₦${price}`;
                priceInput.value = price;
            }
        }

        // Initialize price display if a room type is preselected
        document.addEventListener("DOMContentLoaded", updatePrice);
    </script>
@endsection
