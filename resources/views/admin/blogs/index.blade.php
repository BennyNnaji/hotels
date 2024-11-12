@extends('admin.layouts.content')

@section('content')
    <div class="container mx-auto py-8">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Blog Posts</h1>
            <a href="{{ route('admin.blogs.create') }}"
                class=" text-gray-800 px-4 py-2 hover:bg-gray-800 hover:text-white border-2 border-gray-800 rounded ">
                Add New Post
            </a>
        </div>
        @if (count($blogs) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                @foreach ($blogs as $blog)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <!-- Blog Image -->
                        @if ($blog->image)
                            <img src="{{ Storage::url($blog->image) }}" alt="{{ $blog->title }}"
                                class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">
                                No Image Available
                            </div>
                        @endif

                        <!-- Blog Content -->
                        <div class="p-6">
                            <div class=" flex items-center justify-between px-9">
                                👤 Admin</p>
                                📅 {{ \Carbon\Carbon::parse($blog->created_at)->format('F j, Y') }}

                            </div>
                            <h2 class="text-xl font-semibold text-gray-800">{{ $blog->title }}</h2>
                            <p class="text-gray-600 mt-2">
                                {{ \Illuminate\Support\Str::limit(strip_tags($blog->content), 200, '...') }}
                            </p>
                            <a href="{{ route('admin.blogs.show', $blog->id) }}"
                                class="text-blue-500 hover:underline mt-4 inline-block">
                                Read More
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>

            <!-- Pagination Links -->
            <div class="mt-8">
                {{ $blogs->links() }}
            </div>
        @else
            <p class=" text-gray-500 text-2xl text-center"> No Post Yet</p>
        @endif
    </div>
@endsection
