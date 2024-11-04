@extends('layout/content')
@section('content')
    <!-- Page Header -->
    <header class="bg-gray-800 py-10">
        <div class="container mx-auto text-center">
            <h1 class="text-4xl font-bold text-white">Contact Us</h1>
            <p class="text-gray-400 mt-2 text-lg">We'd love to hear from you. Reach out to us with any questions or feedback.
            </p>
        </div>
    </header>

    <!-- Contact Information and Form Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 md:px-8">
            <div class="">
                <!-- Contact Information -->
                <div class="md:flex md:space-y-0 space-y-8  w-11/12 mb-8 justify-between space-x-2">

                    <div
                        class="flex flex-col items-center text-gray-600 border-2 border-primary px-8 py-5 rounded  hover:bg-primary hover:text-white group">
                        <i class=" group-hover:text-white fas fa-envelope h-6 w-6 text-primary"></i>
                        <span>contact@hotel.com</span>
                    </div>
                    <div
                        class="flex flex-col items-center text-gray-600 border-2 border-primary px-8 py-5 rounded  hover:bg-primary hover:text-white group">
                        <i class=" group-hover:text-white fas fa-location-pin h-6 w-6 text-primary"></i>
                        <span>123 Luxury St., Cityname, Country</span>
                    </div>
                    <div
                        class="flex flex-col items-center text-gray-600 border-2 border-primary px-8 py-5 rounded  hover:bg-primary hover:text-white group">
                        <i class=" group-hover:text-white fas fa-phone h-6 w-6 text-primary"></i>
                        <span>+234 123 456 7890</span>
                    </div>
                </div>
                <hr>
                <!-- Contact Form and Map -->
                <div class="md:flex md:space-x-8 w-full mt-3">
                    <!-- Contact Form -->
                    <div class="md:w-1/2 mb-8">
                        <h2 class="text-3xl font-semibold text-gray-800">Send Us a Message</h2>
                        <form class="mt-8 space-y-6">
                            <div class="flex flex-col">
                                <label for="name" class="text-gray-600">Name</label>
                                <input type="text" id="name" name="name"
                                    class="mt-2 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary"
                                    required>
                            </div>
                            <div class="flex flex-col">
                                <label for="email" class="text-gray-600">Email</label>
                                <input type="email" id="email" name="email"
                                    class="mt-2 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary"
                                    required>
                            </div>
                            <div class="flex flex-col">
                                <label for="message" class="text-gray-600">Message</label>
                                <textarea id="message" name="message" rows="5"
                                    class="mt-2 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary" required></textarea>
                            </div>
                            <button type="submit"
                                class="w-full bg-primary text-white font-semibold py-3 rounded-lg hover:bg-accent transition">Send
                                Message</button>
                        </form>
                    </div>

                    <!-- Google Maps -->
                    <div class="md:w-1/2">
                        <h2 class="text-3xl font-semibold text-gray-800">Find Us Here</h2>
                        <p class="text-gray-600 mt-4">Visit us at our central location, easily accessible for all guests.
                        </p>
                        <div class="mt-8">
                            <iframe class="w-full h-96 rounded-lg shadow-md"
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.835434509998!2d144.9537363155046!3d-37.81720997975195!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad65d5eaf0f63b7%3A0x1f6b5c24e7d3a9d7!2sVictoria%20State%20Library%20Victoria%2C%20Melbourne!5e0!3m2!1sen!2sau!4v1615441121284!5m2!1sen!2sau"
                                allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
