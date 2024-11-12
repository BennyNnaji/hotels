@extends('admin.layouts.content')

@section('content')
    <div class="container mx-auto py-8">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-semibold text-gray-700 mb-6">Events</h1>
            <a href="{{ route('admin.events.create') }}"
                class=" text-gray-800 px-4 py-2 hover:bg-gray-800 hover:text-white border-2 border-gray-800 rounded ">
                Add New Event
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($events as $event)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <img src="{{ Storage::url($event->picture) }}" alt="{{ $event->title }}" class="w-full h-48 object-cover">

                    <div class="p-6">
                        <h2 class="text-2xl font-bold text-gray-800">{{ $event->title }}</h2>

                        <p class="text-gray-500 mt-2">
                            
                            📍{{ $event->location }}
                        </p>
                        <p class="text-gray-500 mt-2">
                            🎫 ₦{{ number_format($event->ticket, 2) }}
                        </p>
                        <p class="text-sm text-gray-500 mt-2">
                            📅 {{ \Carbon\Carbon::parse($event->date)->format('F j, Y \a\t g:i A') }}
                        </p>

                        <p class="text-gray-600 mt-4">{{ Str::limit(strip_tags($event->description), 200, '...') }}</p>

                        <div class="mt-4">
                            <a href="{{ route('admin.events.show', $event->id) }}"
                                class="text-primary font-semibold hover:underline">Read More</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination Links -->
        <div class="mt-8">
            {{ $events->links() }}
        </div>
    </div>
@endsection
