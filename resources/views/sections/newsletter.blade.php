<!-- Newsletter Signup Section -->
<section class="bg-gray-100 py-6">
    <div class="container mx-auto">
        <div class=" text-center py-2">
            <h2 class="text-lg font-bold text-gray-800">Subscribe to Our Newsletter</h2>
            <p class="text-lg text-gray-600 mt-2">Stay updated with the latest news, offers, and exclusive deals from
                {{ $setting->name }}!</p>
        </div>

        <form action="{{ route('newsletter') }}" method="POST"
            class="w-full bg-white shadow-lg rounded p-8 flex justify-between space-x-5 items-center">
            @csrf
            <div class="mb-4 w-4/6 p-3">
                <input type="email" name="email" id="email"
                    class="block w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                    placeholder="Enter your email" required>
            </div>

            <button type="submit"
                class="w-2/6 p-3 bg-primary text-white rounded-lg hover:bg-primaryDark transition duration-200">
                Subscribe Now
            </button>
        </form>
    </div>
</section>
