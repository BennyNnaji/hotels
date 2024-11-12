@extends('admin.layouts.content')

@section('content')
<div class="container mx-auto py-8">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <img src="{{ Storage::url($event->picture) }}" alt="{{ $event->title }}" class="w-full h-75 object-cover">

        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-3xl font-bold text-gray-800">{{ $event->title }}</h1>
                <div class="flex space-x-4">
                    <a href="{{ route('admin.events.edit', $event->id) }}" class="bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg shadow hover:bg-blue-600 transition duration-200">
                        Edit
                    </a>
                    
                    <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this event?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white font-semibold py-2 px-4 rounded-lg shadow hover:bg-red-600 transition duration-200">
                            Delete
                        </button>
                    </form>
                </div>
            </div>

            <p class="text-gray-600"> 📅 {{ \Carbon\Carbon::parse($event->date)->format('l, F j, Y') }}</p>
            <p class="text-gray-600"> 🕒 {{ \Carbon\Carbon::parse($event->date)->format('g:i A') }}</p>
            <p class="text-gray-600"> 📍 {{ $event->location }}</p>
            <p class="text-gray-600"> 🎟️ ₦{{ number_format($event->ticket, 2)}}</p>

            <h2 class="mt-4 text-xl font-semibold text-gray-800">Description</h2>
            <p class="text-gray-700 mt-2">{!! $event->description !!}</p>
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('admin.events.index') }}" class="text-blue-500 hover:underline">Back to Events</a>
    </div>
</div>
@endsection
