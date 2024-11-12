<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Reservation Notification - Orient Hotel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Include the compiled Tailwind CSS here or use a CDN */
        @import url('https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css');
    </style>
</head>

<body class="bg-gray-100 font-sans antialiased">
    <div class="max-w-xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden my-10">
        <div class="bg-gray-800 px-6 py-4">
            <img src="{{ route('front') . Storage::url($settings->logo) }}" alt="Logo" class="w-2/6">
            <h1 class="text-2xl font-semibold text-white">New Reservation Alert</h1>
            <p class="text-gray-400">A new reservation has been made at {{ $settings->name }}</p>
        </div>

        <div class="px-6 py-6">
            <p class="text-lg text-gray-700 mb-4">Hello, Admin,</p>

            <p class="text-gray-700 mb-4">
                A new reservation has been confirmed. Please review the details below to ensure everything is prepared
                for the guest's arrival.
            </p>

            <table class="w-full mb-6">
                <tr>
                    <td class="font-semibold text-gray-800 py-2">Guest Name:</td>
                    <td class="text-gray-700">{{ $fullName }}</td>
                </tr>
                <tr>
                    <td class="font-semibold text-gray-800 py-2">Phone Number :</td>
                    <td class="text-gray-700">{{ $phone }}</td>
                </tr>
                <tr>
                    <td class="font-semibold text-gray-800 py-2">Email :</td>
                    <td class="text-gray-700">{{ $email }}</td>
                </tr>
                <tr>
                    <td class="font-semibold text-gray-800 py-2">Check-in Date:</td>
                    <td class="text-gray-700">{{ \Carbon\Carbon::parse($checkIn)->format('l, F j, Y') }}</td>
                </tr>
                <tr>
                    <td class="font-semibold text-gray-800 py-2">Check-out Date:</td>
                    <td class="text-gray-700">{{ \Carbon\Carbon::parse($checkOut)->format('l, F j, Y') }}</td>
                </tr>
                <tr>
                    <td class="font-semibold text-gray-800 py-2">Room Type:</td>
                    <td class="text-gray-700">{{ $roomType }}</td>
                </tr>
                <tr>
                    <td class="font-semibold text-gray-800 py-2">Reservation Ref:</td>
                    <td class="text-gray-700">{{ $ref }}</td>
                </tr>
                <tr>
                    <td class="font-semibold text-gray-800 py-2">Price:</td>
                    <td class="text-gray-700">₦{{ number_format($price, 2) }}</td>
                </tr>
                <tr>
                    <td class="font-semibold text-gray-800 py-2">Payment Status:</td>
                    <td class="text-gray-700">
                        @if ($payment == 1)
                            <span class=" text-green-500">Paid</span>
                        @else
                            <span class=" text-red-500">No Paid</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="font-semibold text-gray-800 py-2">Number of Guests:</td>
                    <td class="text-gray-700">{{ $guests }}</td>
                </tr>
            </table>

            <p class="text-gray-700 mb-4">
                Please prepare the necessary arrangements for the guest's arrival. If there are any specific notes or
                requests, you will find them in the reservation management system.
            </p>

            <p class="text-gray-700">
                Best regards, <br>
                <span class="font-semibold">{{ $settings->name }} Reservation System</span>
            </p>
        </div>

        <div class="bg-gray-100 text-center py-4">
            <p class="text-gray-500 text-sm">{{ $settings->name }} | {{ $contact->address }}</p>
            <p class="text-gray-500 text-sm">Phone: {{ $contact->phone }} | Email: <a
                    href="mailto:h{{ $contact->email }}"
                    class="text-teal-600 hover:underline">{{ $contact->email }}</a></p>
            <div>
                <a href="{{ $contact->facebook }}"><i class="fab fa-facebook "></i></a>
                <a href="{{ $contact->twitter }}"><i class="fab fa-twitter"></i></a>
                <a href="{{ $contact->instagram }}"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
</body>

</html>
