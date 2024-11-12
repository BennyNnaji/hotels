<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Timed Out</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-gray-100 font-sans antialiased">
    <div class="max-w-xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden my-10">
        <div class="bg-green-800 px-6 py-4">
            <img src="{{ route('front') . Storage::url($settings->logo) }}" alt="Logo" class="w-2/6">
            <h1 class="text-2xl font-semibold text-green-200">Reservation Timed Out</h1>
            <p class="text-green-200">We regret to inform you that your reservation has timed out.</p>
        </div>

        <div class="px-6 py-6">
            <p class="text-lg text-gray-700 mb-4">Dear {{ $fullName }},</p>

            <p class="text-gray-700 mb-4">
                We are sorry to inform you that your reservation at <span class="font-semibold">
                    {{ $settings->name }}</span> has timed out due to an unpaid status.
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
                    <td class="font-semibold text-gray-800 py-2">Reservation Reference Number:</td>
                    <td class="text-gray-700">{{ $ref }}</td>
                </tr>
                <tr>
                    <td class="font-semibold text-gray-800 py-2">Price:</td>
                    <td class="text-gray-700">₦{{ number_format($price, 2) }}</td>
                </tr>
                <tr>
                    <td class="font-semibold text-gray-800 py-2">Payment Status :</td>
                    <td class="text-gray-700">
                        @if ($payment == 1)
                            <span class="text-green-500">Paid</span>
                        @else
                            <span class="text-red-500">Pending</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="font-semibold text-gray-800 py-2">Number of Guests:</td>
                    <td class="text-gray-700">{{ $guests }}</td>
                </tr>
            </table>

            <p class="text-gray-700 mb-4">
                If you believe this was a mistake or have any questions, feel free to reach out to us at <a
                    href="mailto:{{ $contact->email }}" class="text-teal-600 hover:underline">{{ $contact->email }}</a>
                or call us at {{ $contact->phone }}.
            </p>

            <p class="text-gray-700">
                Best regards,<br>
                <span class="font-semibold">The {{ $settings->name }} Team</span>
            </p>
        </div>

        <div class="bg-gray-100 text-center py-4">
            <p class="text-gray-500 text-sm">{{ $settings->name }} | {{ $contact->address }}</p>
            <p class="text-gray-500 text-sm">Phone: {{ $contact->phone }} | Email: <a
                    href="mailto:{{ $contact->email }}"
                    class="text-teal-600 hover:underline">{{ $contact->email }}</a></p>
            <div>
                <a href="{{ $contact->facebook }}"><i class="fab fa-facebook"></i></a>
                <a href="{{ $contact->twitter }}"><i class="fab fa-twitter"></i></a>
                <a href="{{ $contact->instagram }}"><i class="fab fa-instagram"></i></a>
            </div>
            <p class="text-gray-400 text-xs mt-2">You are receiving this email because you made a reservation at
                {{ $settings->name }}.</p>
        </div>
    </div>
</body>

</html>