@extends('layout/content')
@section('content')
    <section class=" container mx-auto">
        <div class="bg-gray-100 flex flex-col items-center justify-center min-h-screen">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class=" text-red-300">{{ $error }}</div>
                @endforeach
            @endif
            <form class="bg-white elevation-5 rounded-lg px-8 pt-6 pb-8 my-4 w-full max-w-lg" method="POST"
                action="{{ route('reservation') }}">
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
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="">Select...</option>
                            <option value="single" {{ old('roomType') == 'single' ? 'selected' : '' }}>Single</option>
                            <option value="double" {{ old('roomType') == 'double' ? 'selected' : '' }}>Double</option>
                            <option value="suite" {{ old('roomType') == 'suite' ? 'selected' : '' }}>Suite</option>
                        </select>
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
                            <label for="terms" class="ml-2 text-gray-700">I agree to the <a href="#"
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
    </script>
@endsection
