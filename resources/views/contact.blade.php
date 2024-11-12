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
    <section class="py-16 bg-white container mx-auto">
        <div class="container mx-auto px-4 md:px-8">
            <div class="">
                <!-- Contact Information -->
                <div class="md:flex md:space-y-0 space-y-8  container mx-auto mb-8 justify-between space-x-2">

                    <div
                        class="w-full md:w-2/6 flex flex-col items-center text-gray-600 border-2 border-primary px-8 py-5 rounded  hover:bg-primary hover:text-white group">
                        <i class=" group-hover:text-white fas fa-envelope h-6 w-6 text-primary"></i>
                        <span><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></span>
                    </div>
                    <div
                        class=" w-full md:w-2/6 flex flex-col items-center text-gray-600 border-2 border-primary px-8 py-5 rounded  hover:bg-primary hover:text-white group">
                        <i class=" group-hover:text-white fas fa-location-pin h-6 w-6 text-primary"></i>
                        <span>{{ $contact->address }}</span>
                    </div>
                    <div
                        class="w-full md:w-2/6 flex flex-col items-center text-gray-600 border-2 border-primary px-8 py-5 rounded  hover:bg-primary hover:text-white group">
                        <i class=" group-hover:text-white fas fa-phone h-6 w-6 text-primary"></i>
                        <span>{{ $contact->phone }}</span>
                    </div>
                </div>
                <hr>
                <!-- Contact Form and Map -->
                <div class="md:flex md:space-x-8 w-full mt-3">
                    <!-- Contact Form -->
                    <div class="md:w-1/2 mb-8">
                        <h2 class="text-3xl font-semibold text-gray-800">Send Us a Message</h2>
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
                        <form class="mt-8 space-y-6" action="{{ route('contact') }}" method="POST">
                            @csrf
                            <div class="flex flex-col">
                                <label for="name" class="text-gray-600">Name</label>
                                <input type="text" id="name" name="name"
                                    class="mt-2 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary @error('name')
                                        border-red-500
                                    @enderror"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <div class="text-red-500">{{ $message }}</i></div>
                                @enderror
                            </div>

                            <div class="flex flex-col">
                                <label for="tel" class="text-gray-600">Phone</label>
                                <input type="number" id="tel" name="phone"
                                    class="mt-2 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary  @error('phone')
                                        border-red-500
                                    @enderror"
                                    value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="text-red-500"> {{ $message }}</i>
                                    </div>
                                @enderror
                            </div>
                            <div class="flex flex-col">
                                <label for="email" class="text-gray-600">Email</label>
                                <input type="email" id="email" name="email"
                                    class="mt-2 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary  @error('email')
                                        border-red-500
                                    @enderror"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <div class="text-red-500"> {{ $message }}</i>
                                    </div>
                                @enderror
                            </div>

                            <div class="flex flex-col">
                                <label for="message" class="text-gray-600">Message</label>
                                <textarea id="message" name="message" rows="10"
                                    class="mt-2 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary  @error('message')
                                        border-red-500
                                    @enderror">{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="text-red-500"> {{ $message }}</i>
                                    </div>
                                @enderror
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
                        <div class="mt-8 ">


                            <iframe class="w-full h-96 md:h-[640px] rounded-lg shadow-md" src="{{ $contact->map }}"
                                style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
