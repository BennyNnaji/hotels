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
                    <div class="bg-white  rounded-lg shadow-md space-y-4" data-aos="zoom-in">

                        <!-- Room Images Slider -->
                        <div class="relative">
                            @if ($room->photos && count($room->photos) > 0)
                                <div class="relative overflow-hidden rounded-t-lg h-72 ">
                                    <div id="room-slider-{{ $room->id }}"
                                        class="flex transition-transform duration-300 ease-in-out">
                                        @foreach ($room->photos as $photo)
                                            <img src="{{ Storage::url($photo) }}" alt="{{ $room->title }}" class="w-full h-full object-cover">
                                        @endforeach
                                    </div>
                                    <!-- Slider Navigation -->
                                    <button
                                        class="absolute top-1/2 left-2 transform -translate-y-1/2 text-white bg-black/50 p-1 rounded-full shadow-lg"
                                        onclick="prevSlide({{ $room->id }})">
                                        &lt;
                                    </button>
                                    <button
                                        class="absolute top-1/2 right-2 transform -translate-y-1/2 text-white bg-black/50 p-1 rounded-full shadow-lg"
                                        onclick="nextSlide({{ $room->id }})">
                                        &gt;
                                    </button>
                                </div>
                            @else
                                <p class="text-gray-500">No images available</p>
                            @endif
                        </div>

                        <div class="p-6">
                            <!-- Room Details -->
                            <h2 class="text-2xl font-semibold text-gray-800">{{ $room->title }}</h2>

                            <p class="text-gray-600">Amenities: <span
                                    class="font-semibold">{{ implode(', ', $room->amenities ?? []) }}</span></p>
                                    <p class="text-gray-600">Max. Guests: {{ $room->maxGuest }} </p>
                            <p class="text-gray-600">{{ $room->description }}</p>
                            <div class="mt-4">
                                <span class="text-xl font-bold text-gray-800">₦{{ number_format($room->price, 2) }}</span>
                                <span class="text-gray-500">/ Night</span>
                            </div>
                            <a href="{{ route('guest', ['page' => 'reservation'])   }}"
                                class="block mt-6 bg-primary text-center w-3/5 text-white font-semibold py-2 rounded-lg hover:bg-accent transition">
                                Book Now
                            </a>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <script>
        function nextSlide(roomId) {
            const slider = document.getElementById(`room-slider-${roomId}`);
            const totalSlides = slider.children.length;
            const sliderWidth = slider.children[0].clientWidth;
            let currentOffset = parseInt(slider.style.transform.replace('translateX(', '').replace('px)', '')) || 0;

            if (Math.abs(currentOffset) < (totalSlides - 1) * sliderWidth) {
                slider.style.transform = `translateX(${currentOffset - sliderWidth}px)`;
            }
        }

        function prevSlide(roomId) {
            const slider = document.getElementById(`room-slider-${roomId}`);
            const sliderWidth = slider.children[0].clientWidth;
            let currentOffset = parseInt(slider.style.transform.replace('translateX(', '').replace('px)', '')) || 0;

            if (currentOffset < 0) {
                slider.style.transform = `translateX(${currentOffset + sliderWidth}px)`;
            }
        }
    </script>
@endsection
