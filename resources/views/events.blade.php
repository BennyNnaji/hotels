@extends('layout/content')
@section('content')
    <!-- Page Header -->
    <header class="bg-gray-800 py-10">
        <div class="container mx-auto text-center">
            <h1 class="text-4xl font-bold text-white"> Events</h1>
            <p class="text-gray-400 mt-2 text-lg">Join us for exclusive experiences and unforgettable moments.</p>
        </div>
    </header>

    <!-- Events Cards Section -->
    <section class="py-16 bg-gray-100">
        <div class="container mx-auto px-4 md:px-8">
            <h1 class="text-3xl font-bold ">Upcoming Events</h1>
            <p class="text-gray-600 my-2">Don't miss out on our exciting events!</p>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Event Card 1 -->
                @foreach ($events as $event)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <img src="{{ Storage::url($event->picture) }}" alt="Wine Tasting Event"
                            class="w-full h-56 object-cover">
                        <div class="p-6">
                            <h2 class="text-2xl font-semibold text-gray-800">{{ $event->title }}</h2>
                            <div class="mt-4 text-gray-600 text-sm">
                                <p>📅 {{ \Carbon\Carbon::parse($event->date)->format('l, F j, Y') }}</p>
                                <p>🕒 {{ \Carbon\Carbon::parse($event->date)->format('g:i A') }}</p>
                                <p>📍 {{ $event->location }}</p>
                                <p>🎫 @if ($event->ticket <= 0)
                                        <span
                                            class="bg-red-600  font-semibold px-3 py-1 rounded text-red-100 my-1">Free!</span>
                                    @else
                                        ₦{{ number_format($event->ticket, 2) }} 
                                    @endif
                                </p>
                            </div>
                            <p class="text-gray-500 mt-2">
                                {{ Str::limit(strip_tags($event->description), 100, '...') }}
                            </p>

                            <a href="{{ route('eventDetails', $event->id) }}"
                                class="block mt-6 text-primary font-semibold hover:underline">Learn
                                More →</a>
                        </div>
                    </div>
                @endforeach


            </div>
            <!-- Pagination -->
            <div class="my-2">{{ $events->links() }}</div>

            <div class="mt-10">
                <h2 class="text-2xl font-bold text-gray-800">Past Events</h2>
                <p class="text-gray-600 mt-2">Here are our past events.</p>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-4">
                    @foreach ($pastEvents as $event)
                        <div class="bg-white shadow-md rounded-lg overflow-hidden">
                            <img src="{{ Storage::url($event->picture) }}" alt="{{ $event->title }}"
                                class="w-full h-56 object-cover">
                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-gray-800">{{ $event->title }}</h3>
                                <p class="text-gray-500 mt-2"> 📅 Date:
                                    {{ \Carbon\Carbon::parse($event->date)->format('l, F j, Y') }}</p>
                                <p class="text-gray-500"> 🕒 Time:
                                    {{ \Carbon\Carbon::parse($event->date)->format('g:i A') }}
                                </p>
                                <p class="text-gray-500"> 📍 Location: {{ $event->location }}</p>
                                <p class="text-gray-500"> 🎟️ Tickets:
                                    @if ($event->ticket <= 0)
                                        <span
                                            class="bg-red-600  font-semibold px-3 py-1 rounded text-red-100 my-1">Free!</span>
                                    @else
                                        ₦{{ $event->ticket }}
                                    @endif
                                </p>
                                <a href="{{ route('eventDetails', $event->id) }}"
                                    class="block mt-6 text-primary font-semibold hover:underline">Learn
                                    More →</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="my-2">{{ $pastEvents->links() }}</div>
            </div>
        </div>

    </section>
@endsection
