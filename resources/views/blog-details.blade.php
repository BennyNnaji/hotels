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
                </div>
            </div>


        </div>
    </section>
@endsection
