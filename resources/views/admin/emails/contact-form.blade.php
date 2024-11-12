<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Form Submission</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Include the compiled Tailwind CSS here or use a CDN */
        @import url('https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css');
    </style>
</head>

<body class="bg-gray-100 font-sans leading-normal">
    <div class="max-w-xl mx-auto bg-white shadow-lg rounded-lg overflow-auto my-8 ">
        <div class=" bg-gray-200 p-6">
            <img src="{{ route('front') . Storage::url($settings->logo) }}" alt="Logo" class="w-2/6">
            <h2 class="text-2xl font-semibold text-gray-800">New Contact Form Submission</h2>
            <p class="text-gray-600 mt-1">You have received a new message from the contact form on your website.</p>
        </div>

        <div class="mt-6 px-6">
            <h3 class="text-lg font-medium text-gray-800">Sender Details</h3>
            <table class="w-full mt-4">
                <tr class="bg-gray-50 px-3">
                    <td class="py-2 font-semibold text-gray-600">Name:</td>
                    <td class="py-2 text-gray-700">{{ $name }}</td>
                </tr>
                <tr class="bg-gray-50 px-3">
                    <td class="py-2 font-semibold text-gray-600">Email:</td>
                    <td class="py-2 text-gray-700">{{ $email }}</td>
                </tr>

                <tr class="bg-gray-50 px-3">
                    <td class="py-2 font-semibold text-gray-600">Phone:</td>
                    <td class="py-2 text-gray-700">{{ $phone ?? 'Not provided' }}</td>
                </tr>
            </table>
        </div>

        <div class="mt-6 px-6">
            <h3 class="text-lg font-medium text-gray-800">Message</h3>
            <p class="mt-2 text-gray-700 whitespace-pre-line">{{ $message_body }}</p>
        </div>

        <div class="mt-8 px-6">
            <p class="text-sm text-gray-500">This message was sent from the contact form on your website.</p>
        </div>
        <p class="text-gray-700 px-6">
            Best regards, <br>
            <span class="font-semibold">{{ $settings->name }} Reservation System</span>
        </p>
        <div class="bg-gray-200 text-center py-4">
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
