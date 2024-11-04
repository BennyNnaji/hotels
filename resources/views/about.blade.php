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
                <img src="{{ Storage::url('front/about.jpg') }}" alt="Our Story" class="w-full md:w-1/2 rounded-lg shadow-md">
                <div class="mt-8 md:mt-0">
                    <h2 class="text-3xl font-semibold text-gray-800">Our Story</h2>
                    <p class="text-gray-600 mt-4">Founded in 1998, our hotel has been a cornerstone of elegance and comfort. Over the years, we have grown, yet our commitment to providing personalized hospitality and unforgettable experiences remains unchanged.</p>
                    <p class="text-gray-600 mt-4">Whether you're here for a weekend getaway or a business trip, we strive to make every moment count, surrounding you with luxury, warmth, and unmatched service.</p>
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
                    <p class="text-gray-600 mt-4">To create memorable, luxurious experiences that leave guests feeling refreshed and valued. We aim to offer a stay that seamlessly blends comfort, style, and personalized service.</p>
                </div>
                <div>
                    <h2 class="text-3xl font-semibold text-gray-800">Our Vision</h2>
                    <p class="text-gray-600 mt-4">To be recognized as a world-class hotel that fosters a unique blend of local charm and global standards. We envision becoming a go-to destination for discerning travelers who appreciate quality and authenticity.</p>
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
                <div class="p-6 bg-gray-50 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold text-primary">🌐 Free High-Speed Wi-Fi</h3>
                    <p class="text-gray-600 mt-2">Stay connected with high-speed internet access throughout the property.</p>
                </div>
                <div class="p-6 bg-gray-50 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold text-primary">🍽️ In-house Restaurant</h3>
                    <p class="text-gray-600 mt-2">Savor gourmet dishes prepared by our renowned chefs, inspired by local and global flavors.</p>
                </div>
                <div class="p-6 bg-gray-50 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold text-primary">🏊 Pool & Spa</h3>
                    <p class="text-gray-600 mt-2">Relax and rejuvenate at our tranquil pool and spa facilities, designed for ultimate relaxation.</p>
                </div>
                <div class="p-6 bg-gray-50 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold text-primary">💪 Fitness Center</h3>
                    <p class="text-gray-600 mt-2">Maintain your workout routine in our fully equipped fitness center, open 24/7.</p>
                </div>
                <div class="p-6 bg-gray-50 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold text-primary">🚗 Complimentary Parking</h3>
                    <p class="text-gray-600 mt-2">Enjoy free, secure parking on our premises for added convenience.</p>
                </div>
                <div class="p-6 bg-gray-50 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold text-primary">🛎️ 24/7 Concierge Service</h3>
                    <p class="text-gray-600 mt-2">Our dedicated concierge team is always on hand to assist with any needs you may have.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Meet Our Team Section -->
    <section class="bg-gray-100 py-16">
        <div class="container mx-auto px-4 md:px-8">
            <h2 class="text-3xl font-semibold text-center text-gray-800">Meet Our Team</h2>
            <p class="text-gray-600 text-center mt-4">Our friendly and professional team is here to make your stay exceptional.</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mt-10">
                <div class="text-center">
                    <img src="{{ Storage::url('front/team-1.jpg') }}" alt="Team Member 1" class="w-32 h-32 mx-auto rounded-full object-cover shadow-md">
                    <h3 class="text-xl font-semibold text-gray-800 mt-4">John Doe</h3>
                    <p class="text-primary text-sm">General Manager</p>
                    <p class="text-gray-600 mt-2">With 20 years of experience, John leads our team to ensure every guest has a memorable experience.</p>
                </div>
                <div class="text-center">
                    <img src="{{ Storage::url('front/team-2.jpg') }}" alt="Team Member 2" class="w-32 h-32 mx-auto rounded-full object-cover shadow-md">
                    <h3 class="text-xl font-semibold text-gray-800 mt-4">Jane Smith</h3>
                    <p class="text-primary text-sm">Head Chef</p>
                    <p class="text-gray-600 mt-2">Jane crafts delicious meals that highlight the best of local and international cuisine.</p>
                </div>
                <div class="text-center">
                    <img src="{{ Storage::url('front/team-3.jpg') }}" alt="Team Member 3" class="w-32 h-32 mx-auto rounded-full object-cover shadow-md">
                    <h3 class="text-xl font-semibold text-gray-800 mt-4">Michael Lee</h3>
                    <p class="text-primary text-sm">Head of Housekeeping</p>
                    <p class="text-gray-600 mt-2">Michael ensures that each room is spotless and guests feel at home in their space.</p>
                </div>
                <div class="text-center">
                    <img src="{{ Storage::url('front/team-4.jpg') }}" alt="Team Member 4" class="w-32 h-32 mx-auto rounded-full object-cover shadow-md">
                    <h3 class="text-xl font-semibold text-gray-800 mt-4">Emily Davis</h3>
                    <p class="text-primary text-sm">Concierge</p>
                    <p class="text-gray-600 mt-2">Emily is always ready to help guests make the most of their stay with local insights and services.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
