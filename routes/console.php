<?php

use Carbon\Carbon;
use App\Models\Contact;
use App\Models\Setting;
use App\Models\Reservation;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


Artisan::command('reservations:timeout', function () {
    // Get all reservations that are not paid and have timed out
    $reservations = Reservation::where('payment', false)
        ->where('status', 'active')  // Assuming 'active' means not timed out yet
        ->where('created_at', '<', Carbon::now()->subHours(2))  // 2 hours old
        ->get();

    foreach ($reservations as $reservation) {
        // Update reservation status to "Timed Out"
        $reservation->status = 'timed out';
        $reservation->save();

        // Send email notification to the guest
        $settings = Setting::first();  // Get settings for the email template
        $contact = Contact::first();  // Get contact details

        // Prepare data for email
        $data = [
            'fullName' => $reservation->fullName,
            'checkIn' => $reservation->checkIn,
            'checkOut' => $reservation->checkOut,
            'roomType' => $reservation->roomType,
            'ref' => $reservation->ref,
            'price' => $reservation->price,
            'payment' => $reservation->payment,
            'guests' => $reservation->guests,
        ];

        // Send confirmation email to the guest
        Mail::send('emails.timeout_notification', array_merge($data, compact('settings', 'contact')), function ($message) use ($reservation, $settings, $contact) {
            $message->from($contact->email, $settings->name);
            $message->to($reservation->email, $reservation->fullName);
            $message->subject('Reservation Timed Out - ' . $settings->name);
        });

        // Optional: Log or print something for debugging
        $this->info("Timed out reservation email sent to: " . $reservation->guest_email);
    }
})->describe('Mark reservations as Timed Out after 2 hours if payment is not made and send email');
Artisan::command('schedule:run', function () {
    Artisan::call('reservations:timeout');
})->everyMinute();
