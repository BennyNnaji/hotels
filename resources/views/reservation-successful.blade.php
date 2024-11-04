@extends('layout/content')
@section('content')
    <section class=" container mx-auto flex items-center justify-center mt-6">
        <div class=" border-2 rounded border-primary flex flex-col items-center justify-center px-6 py-8 w-3/6">
            <h2 class="text-3xl font-bold text-secondary">Thank you for your reservation</h2> <br>
            {{ $reservationId }}
            <p class="text-lg text-primary text-center">Your reservation has been successfully made. We'll get back to you shortly.</p>
            <div class="mt-6 flex space-x-2">
                <a href="{{ route('front') }}" class="py-2 px-4 text-white bg-primary hover:bg-accent">Back to Home</a>
                <a href="{{ route('front') }}" class="py-2 px-4 text-primary hover:text-white border-primary border-2 hover:bg-accent">Pay Now</a>
            </div>

        </div>
    </section>
@endsection
