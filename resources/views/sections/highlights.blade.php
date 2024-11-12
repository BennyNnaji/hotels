<section class="bg-gray-100 py-8">
    <div class="w-11/12 mx-auto text-center">
        <h2 class="text-3xl font-bold text-gray-800">Highlights of {{ $setting->name }}</h2>
        <p class="text-lg text-gray-600 mt-2">Experience the best during your stay with us.</p>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
            <!-- Highlights -->
            @foreach ($setting->highlights as $highlight)
                <div class="bg-white rounded-lg shadow-md p-6"  data-aos="fade-up">
                    <h3 class="text-xl font-semibold text-accent ">{{ $highlight['title'] }} </h3>
                    <p class="text-gray-700 mt-2">{{ $highlight['description'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
