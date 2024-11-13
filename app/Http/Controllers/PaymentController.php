<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Contact;
use App\Models\Setting;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    // public function pay($id)
    // {
    //     $setting = Setting::first();
    //     $contact = Contact::first();
    //     $title = "Payment";
    //     $reservationId = session('reservation_id');
    //     $reservation = Reservation::where('id', $reservationId)->first();
    //     $paystackPublicKey = env('PAYSTACK_PUBLIC_KEY');

    //     return view('reservation-pay', compact('reservation', 'title', 'contact', 'setting', 'paystackPublicKey'));
    // }

    // public function callback(Request $request)
    // {
    //     $reference = $request->input('reference'); // Get reference from the request

    //     if (!$reference) {
    //         return redirect()->back()->with('error', 'Payment reference is missing!');
    //     }

    //     $paymentDetails = Http::withHeaders([
    //         'Authorization' => 'Bearer ' . env('PAYSTACK_SECRET_KEY')
    //     ])->get('https://api.paystack.co/transaction/verify/' . $reference)->json();

    //     if ($paymentDetails['data']['status'] === 'success') {
    //         $reservation = Reservation::where('ref', $reference)->firstOrFail();
    //         if ($reservation) {
    //             $reservation->update(['payment' => 1, 'status' => 'active']);
    //             session(['reservation' => $reservation]);
    //         } else {
    //             return redirect()->back()->with('error', 'Reservation not found!');
    //         }

    //         return redirect()->route('reservation.success')->with('success', 'Payment successful!');
    //     }

    //     return redirect()->back()->with('error', 'Payment failed!');
    // }
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

        // Verify payment status with Paystack API
        $paymentDetails = Http::withToken(env('PAYSTACK_SECRET_KEY'))
            ->get("https://api.paystack.co/transaction/verify/{$reference}")
            ->json();

        if ($paymentDetails['data']['status'] === 'success') {
            // Update reservation as paid
            $reservation = Reservation::where('ref', $reference)->first();
            $reservation->update(['payment' => true, 'status' => 'active']);

            // // Optional: Clear session reservation ID
            // Session::forget('reservation_id');

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
    // public function pay($id)
    // {
    //     $setting = Setting::first(); // Assuming you have settings with hotel details
    //     $contact = Contact::first();
    //     $title = "Payment";
    //     $reservationId = session('reservation_id');
    //     $reservation = Reservation::where('id', $reservationId)->first();
    //     $paystackPublicKey = env('PAYSTACK_PUBLIC_KEY');

    //     return view('reservation-pay', compact('reservation', 'title', 'contact', 'setting', 'paystackPublicKey'));
    // }

    // public function callback(Request $request)
    // {
    //     $paymentDetails = Http::withHeaders([
    //         'Authorization' => 'Bearer ' . env('PAYSTACK_SECRET_KEY')
    //     ])->get('https://api.paystack.co/transaction/verify/' . $request->reference)->json();

    //     if ($paymentDetails['data']['status'] === 'success') {
    //         // Update reservation status to paid
    //         $reservation = Reservation::where('ref', $request->reference)->firstOrFail();
    //         if ($reservation) {
    //             $reservation->update(['payment' => 1, 'status' => 'active']);
    //             session(['reservation' => $reservation]);
    //         } else {
    //             return redirect()->back()->with('error', 'Reservation not found!');
    //         }

    //         return redirect()->route('reservation.success')->with('success', 'Payment successful!');
    //     }

    //     return redirect()->back()->with('error', 'Payment failed!');
    // }





    // public function success()
    // {
    //     $title = "Payment Successfully";
    //     $contact = Contact::first();
    //     $setting = Setting::first();
    //     $reservation = session('reservation');
    //     return view('reservation-successful', compact('reservation', 'title', 'contact', 'setting'));
    // }

    public function clearSession(Request $request)
    {
        // Clear the session data
        $request->session()->forget('reservation_id');
        // Optionally, you can clear other session data if needed
        return response()->json(['success' => true]);
    }
}
