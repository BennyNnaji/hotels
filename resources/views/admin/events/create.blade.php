@extends('admin.layouts.content')

@section('content')
    <div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Create New Event</h2>
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

        <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-semibold">Event Title</label>
                <div class="relative">
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required
                        class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:border-blue-500 focus:ring focus:ring-blue-200" />
                    @if ($errors->has('title'))
                        <span class="absolute inset-y-0 right-0 flex items-center pr-2 text-red-500">
                            <i class="fas fa-exclamation-circle"></i>
                        </span>
                    @endif
                </div>
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-semibold">Description</label>
                <div class="relative">
                    <textarea name="description" id="description" rows="4"
                        class="summernote mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:border-blue-500 focus:ring focus:ring-blue-200">{{ old('description') }}</textarea>
                    @if ($errors->has('description'))
                        <span class="absolute inset-y-0 right-0 flex items-center pr-2 text-red-500">
                            <i class="fas fa-exclamation-circle"></i>
                        </span>
                    @endif
                </div>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="date" class="block text-gray-700 font-semibold">Date and Time</label>
                <div class="relative">
                    <input type="datetime-local" name="date" id="date" value="{{ old('date') }}" required
                        class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:border-blue-500 focus:ring focus:ring-blue-200" />
                    @if ($errors->has('date'))
                        <span class="absolute inset-y-0 right-0 flex items-center pr-2 text-red-500">
                            <i class="fas fa-exclamation-circle"></i>
                        </span>
                    @endif
                </div>
                @error('date')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="location" class="block text-gray-700 font-semibold">Location</label>
                <div class="relative">
                    <input type="text" name="location" id="location" value="{{ old('location') }}"
                        class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:border-blue-500 focus:ring focus:ring-blue-200" />
                    @if ($errors->has('location'))
                        <span class="absolute inset-y-0 right-0 flex items-center pr-2 text-red-500">
                            <i class="fas fa-exclamation-circle"></i>
                        </span>
                    @endif
                </div>
                @error('location')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="picture" class="block text-gray-700 font-semibold">Event Picture</label>
                <input type="file" name="picture" id="picture" accept="image/*"
                    class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:border-blue-500 focus:ring focus:ring-blue-200" />
                @if ($errors->has('picture'))
                    <p class="text-red-500 text-sm mt-1">{{ $errors->first('picture') }}</p>
                @endif
            </div>

            <div class="mb-4">
                <label for="ticket" class="block text-gray-700 font-semibold">Ticket Price</label>
                <div class="relative">
                    <input type="number" name="ticket" id="ticket" value="{{ old('ticket') }}" min="0"
                        step="0.01" required
                        class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:border-blue-500 focus:ring focus:ring-blue-200" />
                    @if ($errors->has('ticket'))
                        <span class="absolute inset-y-0 right-0 flex items-center pr-2 text-red-500">
                            <i class="fas fa-exclamation-circle"></i>
                        </span>
                    @endif
                </div>
                @error('ticket')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <button type="submit"
                    class="w-full bg-blue-600 text-white font-semibold py-2 rounded-lg hover:bg-blue-700">Create
                    Event</button>
            </div>
        </form>
    </div>
@endsection
