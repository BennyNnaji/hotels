   <!-- Events Cards Section -->
    <section class="py-16 bg-gray-100">
        <div class="container mx-auto px-4 md:px-8">
            <h1 class="text-3xl font-bold ">Upcoming Events</h1>
            <p class="text-gray-600 my-2">Don't miss out on our exciting events!</p>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Event Card 1 -->
                @foreach ($events as $event)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden" data-aos="fade-up">
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
                                        ₦{{ $event->ticket }}
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
        </div>

    </section>