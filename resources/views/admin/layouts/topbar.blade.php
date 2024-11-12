<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }} | {{ env('APP_NAME') }}</title>
    <link rel="shortcut icon" href="{{ $setting->favicon }}" type="image/x-icon">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">

    <!-- DataTables Responsive CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">



</head>

<body>
    <!-- admin/layouts/topbar.blade.php -->
    <nav class="z-30 bg-gray-800 p-4 flex justify-between items-center fixed top-0 w-full">
        <!-- Logo -->
        <div class=" flex justify-between space-x-3 items-center">
            <a href="{{ route('admin.dashboard') }}"><img src="{{ Storage::url($setting->logo) }}" alt="Logo"
                    class="w-3/6"></a>
            <button class="text-gray-600 text-2xl btn md:hidden">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <!-- Search Bar -->
        <div class="relative hidden md:block">
            <input type="text" placeholder="Search..."
                class="bg-gray-700 text-white rounded-full px-4 py-2 placeholder-gray-400 focus:outline-none" />
            <i class="fas fa-magnifying-glass absolute top-2 right-4 h-5 w-5 text-gray-400"></i>
        </div>

        <!-- User Profile and Notifications -->
        <div class="flex items-center space-x-4">
            <!-- Notifications -->
            <button class="relative">
                <i class="fas fa-bell h-6 w-6 text-white"></i>
                <span class="absolute top-0 right-0 h-2 w-2 bg-red-500 rounded-full ring-2 ring-gray-800"></span>
            </button>

            <!-- User Dropdown -->
            <div class="relative">
                <button class="text-white flex items-center space-x-2 focus:outline-none" onclick="toggleDropdown()">
                    <span>{{ Auth::user()->name }}</span>
                    <img src="{{ Storage::url('admin/admin.jpg') }}" alt="User Avatar"
                        class="h-8 w-8 rounded-full object-cover" />
                </button>
                <!-- Dropdown -->
                <div id="dropdown"
                    class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg overflow-hidden z-10 hidden">
                    <a href="{{ route('admin.profile.edit') }}"
                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>
                    <a href="" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Settings</a>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left block px-4 py-2 text-gray-700 hover:bg-gray-100">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <script>
        function toggleDropdown() {
            document.getElementById("dropdown").classList.toggle("hidden");
        }
        window.Laravel = {
            successMessage: "{{ session('success') }}",
            errorMessage: "{{ session('error') }}",
            infoMessage: "{{ session('info') }}",
            warningMessage: "{{ session('warning') }}"
        };
    </script>
