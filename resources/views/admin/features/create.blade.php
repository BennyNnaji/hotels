@extends('admin.layouts.content')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-md shadow-md mt-10">
        <h2 class="text-2xl font-semibold text-gray-700 text-center">Add New Feature</h2>
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

        <form action="{{ route('admin.features.store') }}" method="POST" class="mt-6">
            @csrf

            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-medium">Feature Title</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent"
                    placeholder="Enter feature title" required>
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="description" class="block text-gray-700 font-medium">Feature Description</label>
                <textarea id="description" name="description" rows="4"
                    class="summernote w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent"
                    placeholder="Enter feature description" required>{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="px-6 py-2 text-white bg-gray-600 rounded-lg hover:bg-gray-700 focus:outline-none focus:bg-gray-700">
                    Save Feature
                </button>
            </div>
        </form>
    </div>
@endsection
