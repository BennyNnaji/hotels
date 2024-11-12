@extends('layout.content')

@section('content')
    <!-- Blog Post Header -->
    <header class="bg-gray-800 py-6">
        <div class="container mx-auto text-center">
            <h1 class="text-3xl font-bold text-white">{{ $blog->title }}</h1>
            <p class="text-gray-400 mt-2"> 📅 Posted on {{ \Carbon\Carbon::parse($blog->created_at)->format('F j, Y') }}</p>
        </div>
    </header>

    <!-- Blog Post Section -->
    <section class="py-10">
        <div class="container mx-auto px-4">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <img src="{{ Storage::url($blog->image) }}" alt="{{ $blog->title }}" class="w-full h-75 object-cover">

                <div class="p-6">
                    <p class="text-gray-700 mt-4">{!! $blog->content !!}</p>

                    <!-- Share Buttons -->
                    <div class="mt-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-2">Share this post:</h2>
                        <div class="flex space-x-4">
                            <!-- Facebook Share Button -->
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blogDetails', $blog->id)) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                <i class="fab fa-facebook-square fa-2x"></i> 
                            </a>

                            <!-- Twitter Share Button -->
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('blogDetails', $blog->id)) }}&text={{ urlencode($blog->title) }}" target="_blank" class="text-blue-400 hover:text-blue-600">
                                <i class="fab fa-twitter-square fa-2x"></i> 
                            </a>

                            <!-- WhatsApp Share Button -->
                            <a href="https://api.whatsapp.com/send?text={{ urlencode($blog->title) }}%20{{ urlencode(route('blogDetails', $blog->id)) }}" target="_blank" class="text-green-500 hover:text-green-700">
                                <i class="fab fa-whatsapp-square fa-2x"></i> 
                            </a>

                            <!-- Email Share Button -->
                            <a href="mailto:?subject={{ urlencode($blog->title) }}&body={{ urlencode($blog->content) }}%0A{{ urlencode(route('blogDetails', $blog->id)) }}" class="text-gray-800 hover:text-gray-600">
                                <i class="fas fa-envelope fa-2x"></i> 
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection