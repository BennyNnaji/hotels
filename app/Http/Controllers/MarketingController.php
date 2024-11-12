<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Setting;
use App\Models\Marketing;
use App\Models\Reservation;
use Illuminate\Http\Request;

class MarketingController extends Controller
{
    public function index()
    {
        $title = 'Newsletter';
        $contact = Contact::first();
        $setting = Setting::first();
        $newsletterSubscribers = Marketing::select('email')->get();

        // Get all newsletter subscribers' emails
        $newsletterSubscribers = Marketing::select('email')->pluck('email')->toArray();

        // Get all reservation emails where guests opted to subscribe
        $reservationSubscribers = Reservation::where('marketing', true)
            ->select('email')
            ->pluck('email')
            ->toArray();

        // Merge and get unique emails
        $allSubscribersEmails = array_unique(array_merge($newsletterSubscribers, $reservationSubscribers));

        // Pass to the view as a collection
        $subscribers = collect($allSubscribersEmails);
        return view('admin.newsletter', compact('title', 'contact', 'setting', 'subscribers'));
    }
}
