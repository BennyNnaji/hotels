@extends('layout/content')

@section('content')
    @php
        $title = 'Page Not Found';
        $setting = App\Models\Setting::first();  // Correct way to fetch settings
        $contact = App\Models\Contact::first();  // Fetch the first contact record
    @endphp

    <section class="bg-gray-100 font-sans">
        <div class="flex items-center justify-center min-h-screen py-12 px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-6xl font-bold text-red-600">404</h1>
                <h2 class="mt-4 text-2xl font-semibold text-gray-800">Oops! Page Not Found</h2>
                <p class="mt-2 text-lg text-gray-600">The page you're looking for doesn't exist or has been moved.</p>
                <div class="mt-6">
                    <a href="/"
                        class="inline-block px-6 py-3 mt-4 text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Go Back to Homepage
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

