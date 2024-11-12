    <!-- Blog Posts Section -->
    <section class="py-10 container mx-auto px-4">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl font-bold ">Latest News and Offers</h1>
            <p class="text-gray-600 my-2">Don't miss out on our exciting offers!</p>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Blog Card 1 -->
                @foreach ($blogs as $blog)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden" data-aos="fade-up">
                        <img src="{{ Storage::url($blog->image) }}" alt="{{ $blog->title }}"
                            class="w-full h-56 object-cover">
                        <div class="p-6">
                            <h2 class="text-2xl font-semibold text-gray-800">{{ $blog->title }}</h2>
                            <p class="text-gray-500 mt-2">
                                {{ \Illuminate\Support\Str::limit(strip_tags($blog->content), 200, '...') }}</p>
                            <div class="mt-4 text-gray-400 text-sm"> 📅 Posted on
                                {{ \Carbon\Carbon::parse($blog->created_at)->format('F j, Y') }}
                            </div>
                            <a href="{{ route('blogDetails', $blog->id) }}"
                                class="block mt-6 text-primary font-semibold hover:underline">
                                Read More &rarr;
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
