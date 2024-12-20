@extends('layout/content')
@section('content')
    <section class=" container mx-auto flex items-center justify-center mt-6">
        <div class=" border-2 rounded border-primary flex flex-col items-center justify-center px-6 py-8 w-3/6">
            <h2 class="text-3xl font-bold text-secondary">Thank you for your reservation</h2> <br>

            <p>Reservation Reference: <span class=" text-red-500 font-semibold">{{ $reservation->ref }}</span></p>
            <p class="mb-2">Amount to Pay: <span
                    class=" text-green-500 font-semibold">₦{{ number_format($reservation->price, 2) }}</span></p>
            <p class="text-lg text-primary text-center">Your reservation has been successfully made. Please note that the
                reservation will time out in 2 hours. You will receive a confirmation email shortly.</p>
            <div class="mt-6 flex space-x-2">
                <a href="{{ route('front') }}" class="py-2 px-4 text-white bg-primary hover:bg-accent">Back to
                    Home</a>
                <button id="paystackButton"
                    class="py-2 px-4 text-primary hover:text-white border-primary border-2 hover:bg-accent">Pay
                    Now</button>
            </div>
        </div>

        <script src="https://js.paystack.co/v1/inline.js"></script>
    <script>
        document.getElementById('paystackButton').onclick = function() {
            var handler = PaystackPop.setup({
                key: '{{ env('PAYSTACK_PUBLIC_KEY') }}',
                email: '{{ $data['email'] }}',
                amount: {{ $data['amount'] }},
                currency: 'NGN',
                ref: '{{ $data['reference'] }}',
                callback: function(response) {
                    // Redirect to callback route with reference as query parameter
                    window.location.href = "{{ route('reservation.callback') }}?reference=" + response.reference;
                },
                onClose: function() {
                    alert('Payment window closed.');
                }
            });
            handler.openIframe();
        };
    </script>
        

    </section>
@endsection
