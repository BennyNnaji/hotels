<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Confirmation - Orient Hotel</title>
    <style>
        /* Include the compiled Tailwind CSS here or use a CDN */
        @import url('https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css');
    </style>
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="max-w-xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden my-10">
        <div class="bg-green-800 px-6 py-4">
            <h1 class="text-2xl font-semibold text-green-200">Reservation Confirmation</h1>
            <p class="text-green-200">Thank you for choosing Orient Hotel!</p>
        </div>
        
        <div class="px-6 py-6">
            <p class="text-lg text-gray-700 mb-4">Dear {{ $fullName }},</p>
            
            <p class="text-gray-700 mb-4">
                We are thrilled to confirm your reservation at <span class="font-semibold">Orient Hotel</span>. Here are the details of your stay:
            </p>
            
            <table class="w-full mb-6">
                <tr>
                    <td class="font-semibold text-gray-800 py-2">Check-in:</td>
                    <td class="text-gray-700">{{ \Carbon\Carbon::parse($checkIn)->format('F j, Y') }}</td>
                </tr>
                <tr>
                    <td class="font-semibold text-gray-800 py-2">Check-out:</td>
                    <td class="text-gray-700">{{ \Carbon\Carbon::parse($checkOut)->format('F j, Y') }}</td>
                </tr>
                <tr>
                    <td class="font-semibold text-gray-800 py-2">Room Type:</td>
                    <td class="text-gray-700">{{ $roomType }}</td>
                </tr>
                <tr>
                    <td class="font-semibold text-gray-800 py-2">Number of Guests:</td>
                    <td class="text-gray-700">{{ $guests }}</td>
                </tr>
            </table>
            
            <p class="text-gray-700 mb-4">
                We look forward to welcoming you to Orient Hotel. Should you have any special requests or need assistance, feel free to reach out to us at <a href="mailto:hotel@easyworldtechs.com" class="text-teal-600 hover:underline">hotel@easyworldtechs.com</a> or call us at +123-456-7890.
            </p>

            <p class="text-gray-700">
                Warm regards, <br>
                <span class="font-semibold">The Orient Hotel Team</span>
            </p>
        </div>

        <div class="bg-gray-100 text-center py-4">
            <p class="text-gray-500 text-sm">Orient Hotel | 123 Paradise Street, Hotel City, Country</p>
            <p class="text-gray-500 text-sm">Phone: +123-456-7890 | Email: <a href="mailto:hotel@easyworldtechs.com" class="text-teal-600 hover:underline">hotel@easyworldtechs.com</a></p>
            <p class="text-gray-400 text-xs mt-2">You are receiving this email because you made a reservation at Orient Hotel.</p>
        </div>
    </div>
</body>
</html>
