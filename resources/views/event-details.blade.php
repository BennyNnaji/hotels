@extends('layout.content')

@section('content')
    <!-- Event Details Header -->
    <header class="bg-gray-800 py-6">
        <div class="container mx-auto text-center">
            <h1 class="text-3xl font-bold text-white">{{ $event->title }}</h1>
            <p class="text-gray-400 mt-2">Discover the details of our event.</p>
        </div>
    </header>

    <!-- Event Details Section -->
    <section class="py-10">
        <div class="container mx-auto px-4">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <img src="{{ Storage::url($event->picture) }}" alt="{{ $event->title }}" class="w-full h-75 object-cover">

                <div class="p-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-gray-600 mt-2"> 📅 Date:
                                {{ \Carbon\Carbon::parse($event->date)->format('l, F j, Y') }}</p>
                            <p class="text-gray-600"> 🕒 Time: {{ \Carbon\Carbon::parse($event->date)->format('g:i A') }}
                            </p>
                            <p class="text-gray-600"> 📍 Location: {{ $event->location }}</p>
                            <p class="text-gray-600"> 🎟️ Tickets: 
                                @if ($event->ticket <= 0)
                                    <span class="bg-red-600  font-semibold px-3 py-1 rounded text-red-100 my-1">Free!</span>
                                @else
                                    ₦{{ number_format($event->ticket, 2) }}
                                @endif
                            </p>
                        </div>


                    </div>


                    <p class="text-gray-700 mt-2">{!! $event->description !!}</p>
                </div>
            </div>


        </div>
    </section>
@endsection
