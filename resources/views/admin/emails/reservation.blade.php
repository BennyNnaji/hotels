<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Reservation Notification - Orient Hotel</title>
    <style>
        /* Include the compiled Tailwind CSS here or use a CDN */
        @import url('https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css');
    </style>
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="max-w-xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden my-10">
        <div class="bg-gray-800 px-6 py-4">
            <h1 class="text-2xl font-semibold text-white">New Reservation Alert</h1>
            <p class="text-gray-400">A new reservation has been made at Orient Hotel</p>
        </div>
        
        <div class="px-6 py-6">
            <p class="text-lg text-gray-700 mb-4">Hello, Admin,</p>
            
            <p class="text-gray-700 mb-4">
                A new reservation has been confirmed. Please review the details below to ensure everything is prepared for the guest's arrival.
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
                    <td class="font-semibold text-gray-800 py-2">Number of Guests:</td>
                    <td class="text-gray-700">{{ $guests }}</td>
                </tr>
            </table>
            
            <p class="text-gray-700 mb-4">
                Please prepare the necessary arrangements for the guest's arrival. If there are any specific notes or requests, you will find them in the reservation management system.
            </p>

            <p class="text-gray-700">
                Best regards, <br>
                <span class="font-semibold">Orient Hotel Reservation System</span>
            </p>
        </div>

        <div class="bg-gray-100 text-center py-4">
            <p class="text-gray-500 text-sm">Orient Hotel | 123 Paradise Street, Hotel City, Country</p>
            <p class="text-gray-500 text-sm">Phone: +123-456-7890 | Email: <a href="mailto:hotel@easyworldtechs.com" class="text-teal-600 hover:underline">hotel@easyworldtechs.com</a></p>
        </div>
    </div>
</body>
</html>
