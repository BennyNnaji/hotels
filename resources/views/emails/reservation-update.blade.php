<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Update - Orient Hotel</title>
    <style>
        /* Include the compiled Tailwind CSS here or use a CDN */
        @import url('https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css');
    </style>
</head>

<body class="bg-gray-100 font-sans antialiased">
    <div class="max-w-lg mx-auto  bg-white shadow-md rounded-lg my-8">
        <div class="bg-green-800 px-6 py-4">
            <h2 class="text-2xl font-semibold text-green-200">Reservation Update</h2>
            <p class="text-green-200">Thank you for choosing Orient Hotel!</p>
        </div>

        <p class="px-6 mt-4 text-gray-600">Dear {{ $fullName }},</p>
        <p class="px-6 mt-2 text-gray-600">We wanted to inform you that your reservation at <span
                class="font-semibold">Orient
                Hotel</span> has been updated successfully. Below are the updated details of your reservation:</p>

        <div class="px-6 mt-6 border-t border-gray-200 pt-4">
            <h3 class="text-lg font-medium text-primary">Reservation Details</h3>
            <ul class="mt-3 text-gray-600 space-y-2">
                <li><span class="font-semibold">Check-In Date: </span>
                    {{ \Carbon\Carbon::parse($checkIn)->format('l, F j, Y') }}</li>
                <li><span class="font-semibold">Check-Out Date: </span>
                    {{ \Carbon\Carbon::parse($checkOut)->format('l, F j, Y') }}</li>
                <li><span class="font-semibold">Room Type: </span> {{ $roomType }}</li>
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
            <a href="mailto:hotel@easyworldtechs.com" class="text-primary font-semibold">Contact Us</a> |
            <a href="tel:+1234567890" class="text-primary font-semibold">+1 234 567 890</a>
        </div>

        <p class="px-6 my-8 text-sm text-gray-500">Thank you for choosing Orient Hotel. We are dedicated to making your
            stay
            a memorable one.</p>
        <p class="px-6 text-gray-700">
            Warm regards, <br>
            <span class="font-semibold">The Orient Hotel Team</span>
        </p>
        <div class="bg-gray-100 text-center py-4">
            <p class="text-gray-500 text-sm">Orient Hotel | 123 Paradise Street, Hotel City, Country</p>
            <p class="text-gray-500 text-sm">Phone: +123-456-7890 | Email: <a href="mailto:hotel@easyworldtechs.com"
                    class="text-teal-600 hover:underline">hotel@easyworldtechs.com</a></p>
            <p class="text-gray-400 text-xs mt-2">You are receiving this email because you made a reservation at Orient
                Hotel.</p>
        </div>
    </div>


</body>

</html>
