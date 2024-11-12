<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }} | {{ env('APP_NAME') }}</title>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="shortcut icon" href="{{ Storage::url($setting->favicon) }}" type="image/x-icon">
</head>

<body>
    {{-- @include('user/layouts/preloader') --}}
    <section class=" bg-primary text-white top-0 w-full navbar z-50">
        <div class=" container mx-auto p-3 lg:p-6 flex items-center justify-between ">
            <div class="flex justify-between items-center space-x-3 lg:space-x-7">
                <div class="w-3/6 md:w-2/12">
                    <a href="{{ route('front') }}"> <img src="{{ Storage::url($setting->logo) }}" alt="Logo"
                            class="w-full"></a>
                </div>

                <nav class="hidden md:block">
                    <a href="{{ route('front') }}"
                        class="px-2 lg:px-4 py-2 rounded  border-white hover:border-2">Home</a>
                    <a href="{{ route('guest', ['page' => 'about']) }}"
                        class="px-2 lg:px-4 py-2 rounded  border-white hover:border-2">About</a>
                    <a href="{{ route('guest', ['page' => 'rooms']) }}"
                        class="px-2 lg:px-4 py-2 rounded  border-white hover:border-2">Rooms</a>
                    <a href="{{ route('guest', ['page' => 'events']) }}"
                        class="px-2 lg:px-4 py-2 rounded  border-white hover:border-2">Events</a>
                    <a href="{{ route('guest', ['page' => 'blog']) }}"
                        class="px-2 lg:px-4 py-2 rounded  border-white hover:border-2">Blog</a>
                    <a href="{{ route('guest', ['page' => 'features']) }}"
                        class="px-2 lg:px-4 py-2 rounded  border-white hover:border-2">Features</a>
                    <a href="{{ route('guest', ['page' => 'contact']) }}"
                        class="px-2 lg:px-4 py-2 rounded  border-white hover:border-2">Contact</a>
                </nav>
            </div>
            <div class=" flex justify-between items-center space-x-5">
                <button
                    class=" bg-accent rounded-full border-white border-2 text-primary px-6 py-3 hover:text-white transition-all delay-300 duration-500">
                    <a href="{{ route('guest', ['page' => 'reservation']) }}">Book&nbsp;Now</a>
                </button>
                <button class=" btn text-2xl md:hidden"> <i class="fas fa-bars"></i></button>
            </div>
        </div>
        {{-- Mobile Menu --}}
        <div class="hidden flex flex-col space-y-2 z-50 mobile md:hidden p-6">
            <a href="" class="px-4 py-2 rounded  border-white hover:border-2">Home</a>
            <a href="" class="px-4 py-2 rounded  border-white hover:border-2">About</a>
            <a href="" class="px-4 py-2 rounded  border-white hover:border-2">Rooms</a>
            <a href="" class="px-4 py-2 rounded  border-white hover:border-2">Events</a>
            <a href="" class="px-4 py-2 rounded  border-white hover:border-2">Blog</a>
            <a href="" class="px-4 py-2 rounded  border-white hover:border-2">Contact</a>
        </div>

        <script>
            window.Laravel = {
                successMessage: "{{ session('success') }}",
                errorMessage: "{{ session('error') }}",
                infoMessage: "{{ session('info') }}",
                warningMessage: "{{ session('warning') }}"
            };
        </script>

    </section>
