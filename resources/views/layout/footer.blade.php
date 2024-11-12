<div
    class=" p-6 h-10 w-10 rounded-full bg-green-600 flex items-center justify-center cursor-pointer fixed left-3 bottom-3 animate-pulse text-white">
    <a href="https://wa.me/2348103938317" target="_blank"><i class=" fab fa-whatsapp fa-2x"></i></a>
</div>
<div
    class="btt hidden p-6 h-10 w-10 rounded-full bg-secondary flex items-center justify-center cursor-pointer fixed right-3 bottom-3 border-primary border-4 animate-pulse text-white">
    <i class=" fas fa-arrow-up fa-2x"></i>
</div>

{{-- <!-- Footer --> --}}
<footer class="bg-gray-800 py-6">
    <div class="container mx-auto text-center text-gray-400">
        <!-- Social Media Icons -->
        <div class="flex justify-center space-x-6">
            <!-- Facebook Icon -->
            <a href="{{ $contact->facebook }}" target="_blank" rel="noopener noreferrer"
                class="text-blue-600 hover:text-blue-700 transition-colors duration-200">
                <i class="fab fa-facebook-f text-2xl"></i>
            </a>

            <!-- X (Twitter) Icon -->
            <a href="{{ $contact->twitter }}" target="_blank" rel="noopener noreferrer"
                class="text-blue-500 hover:text-blue-600 transition-colors duration-200">
                <i class="fab fa-twitter text-2xl"></i>
            </a>

            <!-- Instagram Icon -->
            <a href="{{ $contact->instagram }}" target="_blank" rel="noopener noreferrer"
                class="text-pink-500 hover:text-pink-600 transition-colors duration-200">
                <i class="fab fa-instagram text-2xl"></i>
            </a>

            <!-- WhatsApp Icon -->
            <a href="{{ $contact->whatsapp }}" target="_blank" rel="noopener noreferrer"
                class="text-green-500 hover:text-green-600 transition-colors duration-200">
                <i class="fab fa-whatsapp text-2xl"></i>
            </a>
        </div>


        <p>&copy; {{ date('Y') }} {{ env('APP_NAME') }}. All rights reserved.</p>
        <p class="mt-2">{{ $contact->address }} | Phone: {{ $contact->phone }} | Email:
            <a href="mailto:{{ $contact->email }}" class="text-teal-500 hover:underline">{{ $contact->email }}</a>
        </p>
    </div>
</footer>
</body>

</html>
