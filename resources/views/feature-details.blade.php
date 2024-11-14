@extends('layout/content')

@section('content')
    <div class="container mx-auto py-8 px-5">
        <!-- Feature Details -->
        <div class="bg-white elevation-5 rounded-lg w-10/12 mx-auto px-6 py-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $feature->title }}</h1>
            <p class="text-gray-600 mb-4">{!! $feature->description !!}</p>

            <!-- Share Buttons -->
            <div class="mt-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-2">Share this feature:</h2>
                <div class="flex space-x-4">
                    <!-- Facebook Share Button -->
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('featuresDetails', $feature->id)) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                        <i class="fab fa-facebook-square"></i> 
                    </a>

                    <!-- Twitter Share Button -->
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('featuresDetails', $feature->id)) }}&text={{ urlencode($feature->title) }}" target="_blank" class="text-blue-400 hover:text-blue-600">
                        <i class="fab fa-twitter-square"></i> 
                    </a>

                    <!-- WhatsApp Share Button -->
                    <a href="https://api.whatsapp.com/send?text={{ urlencode($feature->title) }}%20{{ urlencode(route('featuresDetails', $feature->id)) }}" target="_blank" class="text-green-500 hover:text-green-700">
                        <i class="fab fa-whatsapp-square"></i> 
                    </a>

                    <!-- Email Share Button -->
                    <a href="mailto:?subject={{ urlencode($feature->title) }}&body={{ urlencode($feature->description) }}%0A{{ urlencode(route('featuresDetails', $feature->id)) }}" class="text-gray-800 hover:text-gray-600">
                        <i class="fas fa-envelope"></i> 
                    </a>
                </div>
            </div>

            <!-- Back Button -->
            <div class="mt-6">
                <a href="{{ route('guest', ['page' => 'features']) }}" class="text-blue-500 hover:underline">Back to Features</a>
            </div>
        </div>
    </div>
@endsection