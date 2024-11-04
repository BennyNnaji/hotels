<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Update Notification - Orient Hotel</title>
    <style>
        /* Include the compiled Tailwind CSS here or use a CDN */
        @import url('https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css');
    </style>
</head>

<body class="bg-gray-100 font-sans antialiased">
    <div class="max-w-xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden my-10">
        <div class="bg-gray-800 px-6 py-4">
            <h1 class="text-2xl font-semibold text-white">Reservation Update Alert</h1>
            <p class="text-gray-400">An existing reservation has been updated at Orient Hotel</p>
        </div>

        <div class="px-6 py-6">
            <p class="text-lg text-gray-700 mb-4">Hello, Admin,</p>

            <p class="text-gray-700 mb-4">
                A reservation has recently been updated. Please review the updated details below.
            </p>

            <table class="w-full mb-6">
                <tr>
                    <td class="font-semibold text-gray-800 py-2">Guest Name:</td>
                    <td class="text-gray-700">{{ $fullName }}</td>
                </tr>
                <tr>
                    <td class="font-semibold text-gray-800 py-2">Phone Number:</td>
                    <td class="text-gray-700">{{ $phone }}</td>
                </tr>
                <tr>
                    <td class="font-semibold text-gray-800 py-2">Email:</td>
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
                    <td class="font-semibold text-gray-800 py-2">Number of Guests:</td>
                    <td class="text-gray-700">{{ $guests }}</td>
                </tr>
                <tr>
                    <td class="font-semibold text-gray-800 py-2">Status :</td>
                    <td class="text-gray-700">
                        <span
                            class="px-2 py-1 rounded-lg 
                            @if ($status == 'active') bg-green-100 text-green-800
                            @elseif($status == 'canceled') bg-red-100 text-red-800
                            @elseif($status == 'timed out') bg-yellow-100 text-yellow-800 @endif">
                            {{ ucfirst($status) }}
                        </span>
                    </td>
                </tr>
            </table>

            <p class="text-gray-700 mb-4">
                Please check the reservation management system for additional notes or changes regarding this
                reservation.
            </p>

            <p class="text-gray-700">
                Best regards, <br>
                <span class="font-semibold">Orient Hotel Reservation System</span>
            </p>
        </div>

        <div class="bg-gray-100 text-center py-4">
            <p class="text-gray-500 text-sm">Orient Hotel | 123 Paradise Street, Hotel City, Country</p>
            <p class="text-gray-500 text-sm">Phone: +123-456-7890 | Email: <a href="mailto:hotel@easyworldtechs.com"
                    class="text-teal-600 hover:underline">hotel@easyworldtechs.com</a></p>
        </div>
    </div>
</body>

</html>
