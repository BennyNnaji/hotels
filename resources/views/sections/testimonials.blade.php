<!-- Guest Reviews Section -->
<section class="bg-white py-16">
    <div class="container mx-auto px-6 lg:px-16 py-5" data-aos="fade-up">
        <!-- Section Header -->
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-800">Guest Reviews</h2>
            <p class="text-lg text-gray-600 mt-2">Hear from our satisfied guests who enjoyed their stay with us.</p>
        </div>

        <!-- Testimonials Slider -->
        <div class="tiny-slider space-x-8" id="guestReviewSlider">
            <!-- Testimonial -->
            @foreach ($testimonials as $testimonial)
                <div class="bg-gray-50 p-6 rounded-lg shadow-lg">
                    <p class="text-gray-700 leading-relaxed mb-4">"{{ $testimonial->testimonial }}"</p>
                    <div class="flex items-center mt-4">
                        <img src="{{ Storage::url($testimonial->image) }}" alt="{{ $testimonial->guest }}"
                            class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">{{ $testimonial->guest }}</h3>
                            <p class="text-sm text-gray-500">Stayed in {{ $testimonial->roomType }}</p>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>
