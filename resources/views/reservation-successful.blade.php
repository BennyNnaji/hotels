@extends('layout/content')

@section('content')
    <section class="container mx-auto flex items-center justify-center min-h-screen">
        <div class="border-2 rounded border-primary flex flex-col items-center justify-center px-6 py-8 w-full max-w-md">
            <h2 class="text-3xl font-bold text-secondary mb-4">Payment Successful!</h2>
            <p class="text-lg text-primary text-center mb-4">Thank you for your payment. Your transaction has been completed
                successfully.</p>


            <p class="text-gray-600 text-center mb-4">You will receive a confirmation email shortly with the details of your
                reservation.</p>

            <a href="{{ route('front') }}"
                class="mt-4 bg-primary text-white py-2 px-4 rounded hover:bg-secondary transition duration-300">Return to
                Home</a>
        </div>
        <script>
            // Function to clear the session on page unload
            $(window).on('beforeunload', function() {
                // Send an AJAX request to clear the session
                $.ajax({
                    url: '{{ route('clear.session') }}', // Define a route to clear the session
                    type: 'POST',
                    async: false, // Make it synchronous to ensure it completes before the page unloads
                    data: {
                        _token: '{{ csrf_token() }}' // Include CSRF token for security
                    }
                });
            });
        </script>
    </section>
@endsection
