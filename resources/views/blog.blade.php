@extends('layout/content')

@section('content')
    <!-- Page Header -->
    <header class="bg-gray-800 py-6">
        <div class="container mx-auto text-center">
            <h1 class="text-3xl font-bold text-white">Our Blog</h1>
            <p class="text-gray-400 mt-2">Discover our latest news, tips, and insights.</p>
        </div>
    </header>

    <!-- Blog Posts Section -->
    <section class="py-10">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Blog Card 1 -->
                @foreach ($blogs as $blog)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <img src="{{ Storage::url($blog->image) }}" alt="{{ $blog->title }}"
                            class="w-full h-56 object-cover">
                        <div class="p-6">
                            <h2 class="text-2xl font-semibold text-gray-800">{{ $blog->title }}</h2>
                            <p class="text-gray-500 mt-2"> {{ \Illuminate\Support\Str::limit(strip_tags($blog->content), 200, '...') }}</p>
                            <div class="mt-4 text-gray-400 text-sm"> 📅 Posted on {{ \Carbon\Carbon::parse($blog->created_at)->format('F j, Y') }}
                            </div>
                            <a href="{{ route('blogDetails', $blog->id) }}"
                                class="block mt-6 text-primary font-semibold hover:underline">
                                Read More &rarr;
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Pagination -->
           
                {{ $blogs->links() }}
          
        
        </div>
    </section>
@endsection
