<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Contact;
use App\Models\Setting;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{

    public function initialize(Request $request)
    {
        $setting = Setting::first();
        $contact = Contact::first();
        $title = "Payment";

        // Retrieve reservation ID from session
        $reservationId = session('reservation_id');

        // If reservation ID is missing, redirect or throw an error
        if (!$reservationId) {
            return redirect()->route('home')->withErrors('Reservation not found in session.');
        }

        // Fetch reservation data
        $reservation = Reservation::findOrFail($reservationId);

        // Set up Paystack payment data
        $data = [
            'email' => $reservation->email,
            'amount' => $reservation->price * 100, // Convert to kobo (smallest currency unit)
            'reference' => $reservation->ref,
            'callback_url' => route('reservation.callback'), // Redirect to callback after payment
        ];

        // Pass reservation data to view
        return view('reservation-pay', compact('data', 'reservation', 'title', 'contact', 'setting',));
    }

    public function callback(Request $request)
    {
        $reference = $request->query('reference');

        // // Verify payment status with Paystack API
        // $paymentDetails = Http::withToken(env('PAYSTACK_SECRET_KEY'))
        //     ->get("https://api.paystack.co/transaction/verify/{$reference}")
        //     ->json();

        $paymentDetails = Http::withToken(env('PAYSTACK_SECRET_KEY'))
            ->withoutVerifying() // This disables SSL certificate verification
            ->get("https://api.paystack.co/transaction/verify/{$reference}")
            ->json();

        if ($paymentDetails['data']['status'] === 'success') {
            // Update reservation as paid
            $reservation = Reservation::where('ref', $reference)->first();
            $reservation->update(['payment' => true, 'status' => 'active']);

            // // Optional: Clear session reservation ID
            // Session::forget('reservation_id');
            // Email data to be sent
            $data = [
                    'fullName' => $reservation->fullName,
                    'phone' => $reservation->phone,
                    'email' => $reservation->email,
                    'price' => $reservation->price,
                    'ref' => $reservation->ref,
                    'checkIn' => $reservation->checkIn,
                    'checkOut' => $reservation->checkOut,
                    'roomType' => ucfirst($reservation->roomType),
                    'guests' => $reservation->guests,
                    'status' => $reservation->status,
                    'payment' => $reservation->payment,
                ];
            // Query settings and contact data
            $settings = Setting::first();
            $contact = Contact::first();

            // // Send confirmation email to the guest
            Mail::send('emails.reservation-paid', array_merge($data, compact('settings', 'contact')), function ($message) use ($reservation, $settings, $contact) {
                $message->from($contact->email, $settings->name);
                $message->to($reservation->email, $reservation->fullName);
                $message->subject('Reservation Payment Successful - ' . $settings->name);
            });

            return redirect()->route('reservation.success')->with('success', 'Payment successful!');
        }

        return redirect()->route('reservation.failure')->with('error', 'Payment failed. Please try again.');
    }



    public function success()
    {
        $title = "Payment Successfully";
        $contact = Contact::first();
        $setting = Setting::first();
        $reservation = session('reservation_id');
        return view('reservation-successful', compact('reservation', 'title', 'contact', 'setting'));
    }

    public function clearSession(Request $request)
    {
        // Clear the session data
        $request->session()->forget('reservation_id');
        // Optionally, you can clear other session data if needed
        return response()->json(['success' => true]);
    }
}
