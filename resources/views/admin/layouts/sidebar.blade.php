{{-- <aside class="z-30 md:block fixed left-0 mobile bg-gray-800 w-52 h-screen p-4 flex flex-col mt-20 overflow-auto"> --}}
<aside class="z-30 md:block fixed left-0 mobile top-10 p-4 bg-gray-800 text-white w-52 min-h-screenc">
    <div class="mt-4 overflow-y-auto">
        <!-- Profile Section -->
        <div class="flex flex-col justify-center items-center p-4 border-b border-gray-700 mb-6">
            <img src="{{ Storage::url('admin/admin.jpg') }}" alt="Admin Avatar"
                class="h-12 w-12 rounded-full object-cover" />
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
                <!-- Testimonial -->
                <li>
                    <a href="{{ route('admin.testimonials.index') }}"
                        class="flex items-center p-3 text-white rounded-lg hover:bg-gray-700 transition">
                        <i class="fas fa-comment  mr-3"></i>
                        Testimnials
                    </a>
                </li>

                <!-- Events Management -->
                <li>
                    <a href="{{ route('admin.events.index') }}"
                        class="flex items-center p-3 text-white rounded-lg hover:bg-gray-700 transition">
                        <i class="fas fa-calendar-alt mr-3"></i>
                        Events
                    </a>
                </li>

                <!-- Blog Management -->
                <li>
                    <a href="{{ route('admin.blogs.index') }}"
                        class="flex items-center p-3 text-white rounded-lg hover:bg-gray-700 transition">
                        <i class="fas fa-pen mr-3"></i>
                        Blog
                    </a>
                </li>

                <!-- Settings Dropdown -->
                <li class="relative">
                    <button onclick="handleDropdownToggle(event, 'settingsDropdown')"
                        class="flex items-center w-full p-3 text-white rounded-lg hover:bg-gray-700 transition">
                        <i class="fas fa-dashboard mr-3"></i>
                        Settings
                        <i class="fas fa-chevron-down ml-auto"></i>
                    </button>

                    <!-- Dropdown Menu -->
                    <ul id="settingsDropdown"
                        class="hidden w-full mt-2 bg-gray-800 text-white rounded-lg shadow-lg my-2">
                        <li>
                            <a href="{{ route('admin.settings.edit') }}"
                                class="block px-4 py-2 hover:bg-gray-700 rounded-b-lg">General Settings</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.contact.edit') }}"
                                class="block px-4 py-2 hover:bg-gray-700 rounded-t-lg">Contact</a>
                        </li>
                        <li>
                            <a href="" class="block px-4 py-2 hover:bg-gray-700">Profile</a>
                        </li>
                    </ul>
                </li>

                <!-- Pages Dropdown -->
                <li class="relative">
                    <button onclick="handleDropdownToggle(event, 'pagesDropdown')"
                        class="flex items-center w-full p-3 text-white rounded-lg hover:bg-gray-700 transition">
                        <i class="fas fa-dashboard mr-3"></i>
                        Pages
                        <i class="fas fa-chevron-down ml-auto"></i>
                    </button>

                    <!-- Dropdown Menu -->
                    <ul id="pagesDropdown" class="hidden w-full mt-2 bg-gray-800 text-white rounded-lg shadow-lg my-2">
                        <li>
                            <a href="{{ route('admin.about.edit') }}"
                                class="block px-4 py-2 hover:bg-gray-700 rounded-b-lg">About</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.terms.edit') }}"
                                class="block px-4 py-2 hover:bg-gray-700 rounded-t-lg">Terms</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.privacy.edit') }}"
                                class="block px-4 py-2 hover:bg-gray-700">Privacy</a>
                        </li>
                        <li>
                            <a href="" class="block px-4 py-2 hover:bg-gray-700">Disclaimer</a>
                        </li>
                    </ul>
                </li>

                <script>
                    function handleDropdownToggle(event, dropdownId) {
                        // Prevent the event from bubbling up to the document
                        event.stopPropagation();

                        // Get the dropdown by its ID and toggle visibility
                        const dropdown = document.getElementById(dropdownId);
                        dropdown.classList.toggle('hidden');
                    }

                    // Close dropdowns when clicking outside
                    document.addEventListener('click', function(event) {
                        // Get all dropdown menus
                        const dropdowns = document.querySelectorAll('ul[id$="Dropdown"]');

                        // Loop through each dropdown to check if the click is outside
                        dropdowns.forEach(function(dropdown) {
                            const button = event.target.closest('button');
                            if (!button || !dropdown.contains(event.target)) {
                                dropdown.classList.add('hidden');
                            }
                        });
                    });
                </script>





            </ul>
        </nav>
    </div>
</aside>
