<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription Confirmation - Orient Hotel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Tailwind CSS from CDN */
        @import url('https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css');
    </style>
</head>

<body class="bg-gray-100 font-sans antialiased">
    <div class="max-w-lg mx-auto bg-white shadow-md rounded-lg my-8">
        <div class="bg-green-800 px-6 py-4">
            <img src="{{ route('front') . Storage::url($settings->logo) }}" alt="Logo" class="w-2/6">
            <h2 class="text-2xl font-semibold text-green-200">Welcome to {{ $settings->name }}’s Newsletter!</h2>
            <p class="text-green-200">Thank you for subscribing!</p>
        </div>

        <div class="px-6 mt-6 text-gray-600">
            <p>Dear Subscriber,</p>
            <p class="mt-4">
                Thank you for joining our newsletter at <span class="font-semibold">{{ $settings->name }}</span>! We’re excited to keep you updated on the latest news, offers, and special events at our hotel.
            </p>
            <p class="mt-4">
                Stay tuned for exclusive insights, travel tips, and more from the heart of <span class="font-semibold">{{ $settings->name }}</span>. We look forward to bringing a piece of our world closer to you.
            </p>
            <p class="mt-4">
                If you ever wish to unsubscribe, you can do so at any time by clicking the link at the bottom of our emails.
            </p>
        </div>

        <div class="px-6 mt-6">
            <a href="mailto:{{ $contact->email }}" class="text-primary font-semibold">Contact Us</a> |
            <a href="tel:{{ $contact->phone }}" class="text-primary font-semibold">{{ $contact->phone }}</a>
        </div>

        <p class="px-6 my-8 text-sm text-gray-500">Thank you for choosing {{ $settings->name }}.</p>
        <p class="px-6 text-gray-700">
            Warm regards, <br>
            <span class="font-semibold">The {{ $settings->name }} Team</span>
        </p>

        <div class="bg-gray-100 text-center py-4">
            <p class="text-gray-500 text-sm">{{ $settings->name }} | {{ $contact->address }}</p>
            <p class="text-gray-500 text-sm">Phone: {{ $contact->phone }} | Email: <a href="mailto:{{ $contact->email }}" class="text-teal-600 hover:underline">{{ $contact->email }}</a></p>
            <div class="text-gray-500 text-sm mt-2">
                <a href="{{ $contact->facebook }}"><i class="fab fa-facebook"></i></a>
                <a href="{{ $contact->twitter }}"><i class="fab fa-twitter"></i></a>
                <a href="{{ $contact->instagram }}"><i class="fab fa-instagram"></i></a>
            </div>
            <p class="text-gray-400 text-xs mt-2">You are receiving this email because you subscribed to our newsletter at {{ $settings->name }}.</p>
        </div>
    </div>
</body>

</html>
