@extends('layout/content')
@section('content')

    <!-- Page Header -->
    <header class="bg-gray-800 py-10">
        <div class="container mx-auto text-center">
            <h1 class="text-4xl font-bold text-white">About Us</h1>
            <p class="text-gray-400 mt-2 text-lg">Discover our story, our values, and what makes us unique.</p>
        </div>
    </header>

    <!-- Our Story Section -->
    <section class="bg-white py-16">
        <div class="container mx-auto px-4 md:px-8">
            <div class="md:flex md:items-center md:space-x-12">
                <img src="{{ Storage::url($about->about_us_image) }}" alt="Our Story" class="w-full md:w-1/2 rounded-lg shadow-md">
                <div class="mt-8 md:mt-0">
                    <h2 class="text-3xl font-semibold text-gray-800">Our Story</h2>
                    <p class="text-gray-600 mt-4">{!! $about->about_us !!}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission and Vision Section -->
    <section class="bg-gray-100 py-16">
        <div class="container mx-auto px-4 md:px-8 text-center">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div>
                    <h2 class="text-3xl font-semibold text-gray-800">Our Mission</h2>
                    <p class="text-gray-600 mt-4">{{ $about->mission }}</p>
                </div>
                <div>
                    <h2 class="text-3xl font-semibold text-gray-800">Our Vision</h2>
                    <p class="text-gray-600 mt-4">{{ $about->vision }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Amenities Section -->
    <section class="bg-white py-16">
        <div class="container mx-auto px-4 md:px-8 text-center">
            <h2 class="text-3xl font-semibold text-gray-800">Our Amenities</h2>
            <p class="text-gray-600 mt-4">We offer a range of services to ensure you enjoy a luxurious, worry-free stay.</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mt-10">
                @foreach ($about->amenities as $amenity) <!-- Loop through the amenities -->
                    <div class="p-6 bg-gray-50 rounded-lg shadow-md">
                        <h3 class="text-xl font-bold text-primary">{{ $amenity['icon'] }} {{ $amenity['title'] }}</h3>
                        <p class="text-gray-600 mt-2">{{ $amenity['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Meet Our Team Section -->
    <section class="bg-gray-100 py-16">
        <div class="container mx-auto px-4 md:px-8">
            <h2 class="text-3xl font-semibold text-center text-gray-800">Meet Our Team</h2>
            <p class="text-gray-600 text-center mt-4">Our friendly and professional team is here to make your stay exceptional.</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mt-10">
                @foreach ($about->team as $member) <!-- Loop through the team members -->
                    <div class="text-center">
                        <img src="{{ Storage::url($member['image']) }}" alt="{{ $member['name'] }}" class="w-32 h-32 mx-auto rounded-full object-cover shadow-md">
                        <h3 class="text-xl font-semibold text-gray-800 mt-4">{{ $member['name'] }}</h3>
                        <p class="text-primary text-sm">{{ $member['role'] }}</p>
                        <p class="text-gray-600 mt-2">{{ $member['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
