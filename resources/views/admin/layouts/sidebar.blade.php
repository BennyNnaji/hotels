<aside class="z-30 md:block fixed left-0 mobile bg-gray-800 w-52 min-h-screen p-4 flex flex-col mt-20">
    <!-- Profile Section -->
    <div class="flex flex-col justify-center items-center p-4 border-b border-gray-700 mb-6">
        <img src="{{ Storage::url('admin/admin.jpg') }}" alt="Admin Avatar" class="h-12 w-12 rounded-full object-cover" />
        <div class="text-center">
            <h3 class="text-white font-semibold">{{ Auth::user()->name }}</h3>
            <span class="text-gray-400 text-sm">Admin</span>
        </div>
    </div>

    <!-- Navigation Links -->
    <nav class="flex-1">
        <ul class="space-y-2">
            <!-- Dashboard -->
            <li>
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center p-3 text-white rounded-lg hover:bg-gray-700 transition">
                    <i class="fas fa-dashboard mr-3"></i>
                    Dashboard
                </a>
            </li>

            <!-- Rooms Management -->
            <li>
                <a href="{{ route('admin.rooms.index') }}"
                    class="flex items-center p-3 text-white rounded-lg hover:bg-gray-700 transition">
                    <i class="fas fa-bed mr-3"></i>
                    Rooms
                </a>
            </li>

            <!-- Reservations -->
            <li>
                <a href="{{ route('admin.reservations.index') }}"
                    class="flex items-center p-3 text-white rounded-lg hover:bg-gray-700 transition">
                    <i class="fas fa-calendar-check  mr-3"></i>
                    Reservations
                </a>
            </li>

            <!-- Events Management -->
            <li>
                <a href="{{ route('admin.events.index') }}" class="flex items-center p-3 text-white rounded-lg hover:bg-gray-700 transition">
                    <i class="fas fa-calendar-alt mr-3"></i>
                    Events
                </a>
            </li>

            <!-- Blog Management -->
            <li>
                <a href="{{ route('admin.blogs.index') }}" class="flex items-center p-3 text-white rounded-lg hover:bg-gray-700 transition">
                    <i class="fas fa-pen mr-3"></i>
                    Blog
                </a>
            </li>

            <!-- Settings -->
            <li>
                <a href="" class="flex items-center p-3 text-white rounded-lg hover:bg-gray-700 transition">
                    <i class="fas fa-dashboard mr-3"></i>
                    Settings
                </a>
            </li>
        </ul>
    </nav>
</aside>
