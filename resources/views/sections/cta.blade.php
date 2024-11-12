<!-- Call to Action Section -->
<section class="bg-primary py-16">
    <div class="container mx-auto px-6 lg:px-16 text-center">
        <!-- CTA Heading -->
        <h2 class="text-4xl font-bold text-white">Your Perfect Stay Awaits</h2>
        <p class="text-lg text-gray-200 mt-4">Whether you’re here for relaxation or adventure, we’re ready to make your
            stay unforgettable.</p>

        <!-- CTA Buttons -->
        <div class="mt-8 flex flex-wrap justify-center gap-6">
            <!-- Book Now Button -->
            <a href="{{ route('reservation') }}"
                class="px-6 py-3 text-white bg-primary hover:bg-primaryDark rounded-md shadow-lg transition duration-200 ease-in-out">
                Book Now
            </a>

            <!-- Contact Us Button -->
            <a href="{{ route('guest', ['page' => 'contact']) }}"
                class="px-6 py-3 text-white bg-secondary hover:bg-secondaryDark rounded-md shadow-lg transition duration-200 ease-in-out">
                Contact Us
            </a>

            <!-- Explore Rooms Button -->
            <a href="{{ route('guest', ['page' => 'room']) }}"
                class="px-6 py-3 text-primary bg-accent hover:bg-accentDark rounded-md shadow-lg transition duration-200 ease-in-out">
                Explore Rooms
            </a>
        </div>
    </div>
</section>
