<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Update - Orient Hotel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Include the compiled Tailwind CSS here or use a CDN */
        @import url('https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css');
    </style>
</head>

<body class="bg-gray-100 font-sans antialiased">
    <div class="max-w-lg mx-auto  bg-white shadow-md rounded-lg my-8">
        <div class="bg-green-800 px-6 py-4">
            <img src="{{ route('front') . Storage::url($settings->logo) }}" alt="Logo" class="w-2/6">
            <h2 class="text-2xl font-semibold text-green-200">Reservation Update</h2>
            <p class="text-green-200">Thank you for choosing {{ $settings->name }}!</p>
        </div>

        <p class="px-6 mt-4 text-gray-600">Dear {{ $fullName }},</p>
        <p class="px-6 mt-2 text-gray-600">We wanted to inform you that your reservation at <span
                class="font-semibold">{{ $settings->name }}</span> has been updated successfully. Below are the updated
            details of your reservation:</p>

        <div class="px-6 mt-6 border-t border-gray-200 pt-4">
            <h3 class="text-lg font-medium text-primary">Reservation Details</h3>
            <ul class="mt-3 text-gray-600 space-y-2">
                <li><span class="font-semibold">Check-In Date: </span>
                    {{ \Carbon\Carbon::parse($checkIn)->format('l, F j, Y') }}</li>
                <li><span class="font-semibold">Check-Out Date: </span>
                    {{ \Carbon\Carbon::parse($checkOut)->format('l, F j, Y') }}</li>
                <li><span class="font-semibold">Room Type: </span> {{ $roomType }}</li>
                <li><span class="font-semibold">Reservation Reference Number: </span> {{ $ref }}</li>
                <li><span class="font-semibold">Price: </span> ₦{{ number_format($price, 2) }}</li>
                <li><span class="font-semibold">Payment Status:
                        @if ($payment == 1)
                            <span class=" text-green-500">Paid</span>
                        @else
                            <span class=" text-red-500">Pending</span>
                        @endif
                    </span>
                <li><span class="font-semibold">Guests: </span> {{ $guests }}</li>
                <li><span class="font-semibold">Status: </span>
                    <span
                        class="px-2 py-1 rounded-lg 
                            @if ($status == 'active') bg-green-100 text-green-800
                            @elseif($status == 'canceled') bg-red-100 text-red-800
                            @elseif($status == 'timed out') bg-yellow-100 text-yellow-800 @endif">
                        {{ ucfirst($status) }}
                    </span>
                </li>
            </ul>
        </div>

        <div class="px-6 mt-6">
            <p class="text-gray-600">If you have any further questions or require assistance, please feel free to reach
                out to us. We look forward to welcoming you soon!</p>
        </div>

        <div class="px-6 mt-6">
            <a href="mailto:{{ $contact->email }}" class="text-primary font-semibold">Contact Us</a> |
            <a href="tel:{{ $contact->phone }}" class="text-primary font-semibold">{{ $contact->phone }}</a>
        </div>

        <p class="px-6 my-8 text-sm text-gray-500">Thank you for choosing {{ $settings->name }}. We are dedicated to
            making your
            stay
            a memorable one.</p>
        <p class="px-6 text-gray-700">
            Warm regards, <br>
            <span class="font-semibold">The {{ $settings->name }} Team</span>
        </p>
        <div class="bg-gray-100 text-center py-4">
            <p class="text-gray-500 text-sm">{{ $settings->name }} | {{ $contact->address }}</p>
            <p class="text-gray-500 text-sm">Phone: {{ $contact->phone }} | Email: <a
                    href="mailto:{{ $contact->email }}"
                    class="text-teal-600 hover:underline">{{ $contact->email }}</a></p>
            <div>
                <a href="{{ $contact->facebook }}"><i class="fab fa-facebook "></i></a>
                <a href="{{ $contact->twitter }}"><i class="fab fa-twitter"></i></a>
                <a href="{{ $contact->instagram }}"><i class="fab fa-instagram"></i></a>
            </div>
            <p class="text-gray-400 text-xs mt-2">You are receiving this email because you made a reservation at
                {{ $settings->name }}.</p>
        </div>
    </div>


</body>

</html>
