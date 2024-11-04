@extends('layout/content')
@section('content')
    <!-- Page Header -->
    <header class="bg-gray-800 py-6">
        <div class="container mx-auto text-center">
            <h1 class="text-3xl font-bold text-white">Explore Our Rooms</h1>
            <p class="text-gray-400 mt-2">Comfortable, stylish, and perfectly designed for your needs.</p>
        </div>
    </header>

    <!-- Room Cards Section -->
    <section class="py-10">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                <!-- Room Card 1 with Manual Slider -->
                @foreach ($rooms as $room)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <div x-data="{ activeSlide: 1 }" class="relative">
                            <!-- Image Slides -->
                            <template x-for="slide in 3" :key="slide">
                                <img x-show="activeSlide === slide" :src="`{{ Storage::url('front/room-1') }}-${slide}.jpg`"
                                    alt="Standard Room Slide"
                                    class="w-full h-56 object-cover transition-opacity duration-300">
                            </template>

                            <!-- Navigation Buttons -->
                            <div class="absolute inset-0 flex justify-between items-center px-4">
                                <button @click="activeSlide = activeSlide > 1 ? activeSlide - 1 : 3"
                                    class="bg-gray-900 text-white p-2 rounded-full bg-opacity-50 hover:bg-opacity-75">
                                    &#10094;
                                </button>
                                <button @click="activeSlide = activeSlide < 3 ? activeSlide + 1 : 1"
                                    class="bg-gray-900 text-white p-2 rounded-full bg-opacity-50 hover:bg-opacity-75">
                                    &#10095;
                                </button>
                            </div>
                        </div>
                        <div class="p-6">
                            <h2 class="text-2xl font-semibold text-gray-800">{{ $room->title }}</h2>
                            <p class="text-gray-500 mt-2">{{ $room->description }}</p>
                            <ul class="text-gray-600 text-sm mt-4 space-y-1">
                                <li>🛏️ Queen-size bed</li>
                                <li>🚿 Private bathroom</li>
                                <li>📶 Free Wi-Fi</li>
                            </ul>
                            <div class="mt-4">
                                <span class="text-xl font-bold text-gray-800">₦{{ $room->price }}</span>
                                <span class="text-gray-500">/ night</span>
                            </div>
                            <a href="/book/standard-room"
                                class="block mt-6 bg-primary text-center text-white font-semibold py-2 rounded-lg hover:bg-accent transition">
                                Book Now
                            </a>
                        </div>
                    </div>
                @endforeach

                <!-- Room Card 2 with Manual Slider -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div x-data="{ activeSlide: 1 }" class="relative">
                        <template x-for="slide in 3" :key="slide">
                            <img x-show="activeSlide === slide" :src="`{{ Storage::url('front/room-2') }}-${slide}.jpg`"
                                 alt="Deluxe Room Slide" class="w-full h-56 object-cover transition-opacity duration-300">
                        </template>
                        <div class="absolute inset-0 flex justify-between items-center px-4">
                            <button @click="activeSlide = activeSlide > 1 ? activeSlide - 1 : 3"
                                    class="bg-gray-900 text-white p-2 rounded-full bg-opacity-50 hover:bg-opacity-75">
                                &#10094;
                            </button>
                            <button @click="activeSlide = activeSlide < 3 ? activeSlide + 1 : 1"
                                    class="bg-gray-900 text-white p-2 rounded-full bg-opacity-50 hover:bg-opacity-75">
                                &#10095;
                            </button>
                        </div>
                    </div>
                    <div class="p-6">
                        <h2 class="text-2xl font-semibold text-gray-800">Deluxe Room</h2>
                        <p class="text-gray-500 mt-2">Spacious and elegantly designed for a luxurious experience.</p>
                        <ul class="text-gray-600 text-sm mt-4 space-y-1">
                            <li>🛏️ King-size bed</li>
                            <li>🚿 Private bathroom with tub</li>
                            <li>📺 LED TV with cable</li>
                        </ul>
                        <div class="mt-4">
                            <span class="text-xl font-bold text-gray-800">₦150,000</span>
                            <span class="text-gray-500">/ night</span>
                        </div>
                        <a href="/book/deluxe-room"
                            class="block mt-6 bg-primary text-center text-white font-semibold py-2 rounded-lg hover:bg-accent transition">
                            Book Now
                        </a>
                    </div>
                </div>

                <!-- Room Card 3 with Manual Slider -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div x-data="{ activeSlide: 1 }" class="relative">
                        <template x-for="slide in 3" :key="slide">
                            <img x-show="activeSlide === slide" :src="`{{ Storage::url('front/room-3') }}-${slide}.jpg`"
                                 alt="Suite Room Slide" class="w-full h-56 object-cover transition-opacity duration-300">
                        </template>
                        <div class="absolute inset-0 flex justify-between items-center px-4">
                            <button @click="activeSlide = activeSlide > 1 ? activeSlide - 1 : 3"
                                    class="bg-gray-900 text-white p-2 rounded-full bg-opacity-50 hover:bg-opacity-75">
                                &#10094;
                            </button>
                            <button @click="activeSlide = activeSlide < 3 ? activeSlide + 1 : 1"
                                    class="bg-gray-900 text-white p-2 rounded-full bg-opacity-50 hover:bg-opacity-75">
                                &#10095;
                            </button>
                        </div>
                    </div>
                    <div class="p-6">
                        <h2 class="text-2xl font-semibold text-gray-800">Suite</h2>
                        <p class="text-gray-500 mt-2">An expansive suite with luxurious amenities and stunning views.</p>
                        <ul class="text-gray-600 text-sm mt-4 space-y-1">
                            <li>🛏️ King-size bed</li>
                            <li>🍽️ Lounge area with dining</li>
                            <li>🌆 City view balcony</li>
                        </ul>
                        <div class="mt-4">
                            <span class="text-xl font-bold text-gray-800">₦250,000</span>
                            <span class="text-gray-500">/ night</span>
                        </div>
                        <a href="/book/suite"
                            class="block mt-6 bg-primary text-center text-white font-semibold py-2 rounded-lg hover:bg-accent transition">
                            Book Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
