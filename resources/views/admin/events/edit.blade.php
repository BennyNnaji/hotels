@extends('admin.layouts.content')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6">Edit Event</h1>

    <div class="bg-white shadow-lg rounded-lg p-6">
        <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-semibold mb-2">Title</label>
                <input type="text" id="title" name="title" value="{{ old('title', $event->title) }}" class="border border-gray-300 rounded-lg w-full p-2 focus:outline-none focus:border-blue-500" required>
                @error('title')
                    <p class="text-red-500 text-xs mt-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-semibold mb-2">Description</label>
                <textarea id="description" name="description" class="summernote border border-gray-300 rounded-lg w-full p-2 focus:outline-none focus:border-blue-500" required>{{ old('description', $event->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="date" class="block text-gray-700 font-semibold mb-2">Date and Time</label>
                <input type="datetime-local" id="date" name="date" value="{{ old('date', \Carbon\Carbon::parse($event->date)->format('Y-m-d\TH:i')) }}" class="border border-gray-300 rounded-lg w-full p-2 focus:outline-none focus:border-blue-500" required>
                @error('date')
                    <p class="text-red-500 text-xs mt-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="location" class="block text-gray-700 font-semibold mb-2">Location</label>
                <input type="text" id="location" name="location" value="{{ old('location', $event->location) }}" class="border border-gray-300 rounded-lg w-full p-2 focus:outline-none focus:border-blue-500" required>
                @error('location')
                    <p class="text-red-500 text-xs mt-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="ticket" class="block text-gray-700 font-semibold mb-2">Tickets Price(₦)</label>
                <input type="number" id="ticket" name="ticket" value="{{ old('ticket', $event->ticket) }}" class="border border-gray-300 rounded-lg w-full p-2 focus:outline-none focus:border-blue-500" required>
                @error('ticket')
                    <p class="text-red-500 text-xs mt-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="picture" class="block text-gray-700 font-semibold mb-2">Event Picture</label>
                <input type="file" id="picture" name="picture" class="border border-gray-300 rounded-lg w-full p-2 focus:outline-none focus:border-blue-500">
                @error('picture')
                    <p class="text-red-500 text-xs mt-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                @enderror
            </div>
            <div>
                <img src="{{ Storage::url($event->picture) }}" alt="{{ $event->title }}" class="w-48 h-48 rounded-lg mb-4">
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg shadow hover:bg-blue-600 transition duration-200">
                    Update Event
                </button>
            </div>
        </form>
    </div>

    <div class="mt-6">
        <a href="{{ route('admin.events.index') }}" class="text-blue-500 hover:underline">Back to Events</a>
    </div>
</div>
@endsection
