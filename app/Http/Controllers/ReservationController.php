<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Contact;
use App\Models\Setting;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
// use App\Models\Reservation;
use Illuminate\Support\Facades\Redirect;


class ReservationController extends Controller
{
    public function index()
    {
        $title = 'Reservations';
        $reservations = Reservation::latest()->get();
        $setting = Setting::first();
        return view('admin.reservations.index', compact('title', 'reservations', 'setting'));
    }

    public function create()
    {
        $title = 'Add Reservation';
        $rooms = Room::all();
        $setting = Setting::first();
        return view('admin.reservations.create', compact('title', 'rooms', 'setting'));
    }

    public function show($id)
    {
        $title = ' Reservation Details';
        $reservation = Reservation::find($id);
        $rooms = Room::all();
        $setting = Setting::first();
        return view('admin.reservations.show', compact('title', 'reservation', 'rooms', 'setting'));
    }
    public function edit($id)
    {
        $title = 'Edit Reservation';
        $reservation = Reservation::find($id);
        $rooms = Room::all();
        $setting = Setting::first();
        return view('admin.reservations.edit', compact('title', 'reservation', 'rooms', 'setting'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'price' => 'required|gt:0',
            'phone' => 'nullable|string|max:20',
            'checkIn' => 'required|date|after_or_equal:today',
            'checkOut' => 'required|date|after_or_equal:checkIn',
            'roomType' => 'required|exists:rooms,title',
            'guests' => 'required|integer|min:1',
            'terms' => 'accepted',
            'marketing' => 'nullable|boolean',
            'payment' => 'nullable|boolean',
        ]);

        // Retrieve the refId for the selected roomType
        $room = Room::where('title', $validatedData['roomType'])->first();
        $refId = $room ? $room->refId : null;

        // Generate a unique 4-digit random number
        $randomNumber = mt_rand(1000, 9999);

        // Concatenate the refId with the 4-digit random number to create the ref value
        $ref = $refId . $randomNumber;

        // Create a new reservation with validated data
        $reservation = Reservation::create([
            'fullName' => $validatedData['fullName'],
            'email' => $validatedData['email'],
            'price' => $validatedData['price'],
            'phone' => $validatedData['phone'] ?? null,
            'checkIn' => $validatedData['checkIn'],
            'checkOut' => $validatedData['checkOut'],
            'roomType' => $validatedData['roomType'],
            'guests' => $validatedData['guests'],
            'terms' => true,
            'marketing' => $validatedData['marketing'] ?? false,
            'payment' => $validatedData['payment'] ?? false,
            'ref' => $ref, // Store the concatenated refId and random number in ref
        ]);
        // Ensure the reservation is created and fields are populated correctly before sending the email
        if ($reservation) {

            // Query settings and contact data
            $settings = Setting::first();
            $contact = Contact::first();

            // Email data to be sent
            $data = [
                'fullName' => $reservation->fullName,
                'phone' => $reservation->phone,
                'price' => $reservation->price,
                'ref' => $reservation->ref,
                'email' => $reservation->email,
                'checkIn' => $reservation->checkIn,
                'checkOut' => $reservation->checkOut,
                'roomType' => ucfirst($reservation->roomType),
                'guests' => $reservation->guests,
                'payment' => $reservation->payment,
            ];

            // // Send confirmation email to the guest
            // Mail::send('emails.reservation', array_merge($data, compact('settings', 'contact')), function ($message) use ($reservation, $settings, $contact) {
            //     $message->from($contact->email, $settings->name);
            //     $message->to($reservation->email, $reservation->fullName);
            //     $message->subject('Reservation Confirmation - Orient Hotel');
            // });

            // // Send confirmation email to the admin
            // Mail::send('admin.emails.reservation', array_merge($data, compact('settings', 'contact')), function ($message) use ($settings, $contact) {
            //     $message->from($contact->email, $settings->name);
            //     $message->to($contact->email, $settings->name);
            //     $message->subject('Reservation Notification - Orient Hotel');
            // });
        }


        if (Auth::user()) {
            return redirect()->route('admin.reservations.index')->with('success', 'Your reservation has been successfully created.');
        }
        // Save reservation ID in session
        session(['reservation_id' => $reservation->id]);
        return redirect()->route('reservation.pay', $reservation->id)->with('success', 'Your reservation has been successfully created.');
    }
    public function update(Request $request, Reservation $reservation)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'fullName' => 'required|string|max:255',
            'price' => 'required',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'checkIn' => 'required|date|after_or_equal:today',
            'checkOut' => 'required|date|after_or_equal:checkIn',
            'roomType' => 'required|exists:rooms,title',
            'status' => 'required|in:active,canceled,timed out',
            'guests' => 'required|integer|min:1',
            'payment' => 'nullable|boolean',
        ]);

        // Check if roomType has changed
        if ($validatedData['roomType'] !== $reservation->roomType) {
            // Retrieve the new refId for the updated roomType
            $room = Room::where('title', $validatedData['roomType'])->first();
            $refId = $room ? $room->refId : null;

            // Generate a unique 4-digit random number
            $randomNumber = mt_rand(1000, 9999);

            // Concatenate the refId with the 4-digit random number to create the new ref value
            $validatedData['ref'] = $refId . $randomNumber;
        }

        // Update the reservation with validated data, including the new ref if roomType changed
        $reservation->update([
            'fullName' => $validatedData['fullName'],
            'email' => $validatedData['email'],
            'price' => $validatedData['price'],
            'phone' => $validatedData['phone'] ?? null,
            'checkIn' => $validatedData['checkIn'],
            'checkOut' => $validatedData['checkOut'],
            'roomType' => $validatedData['roomType'],
            'guests' => $validatedData['guests'],
            'status' => $validatedData['status'],
            'payment' => $validatedData['payment'] ?? false,
            'ref' => $validatedData['ref'] ?? $reservation->ref, // Keep the old ref if roomType didn't change
        ]);

        // Query settings and contact data
        $settings = Setting::first();
        $contact = Contact::first();

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

        // Send confirmation email to the guest
        Mail::send('emails.reservation-update', array_merge($data, compact('settings', 'contact')), function ($message) use ($reservation, $settings, $contact) {
            $message->from($contact->email, $settings->name);
            $message->to($reservation->email, $reservation->fullName);
            $message->subject('Reservation Update - ' . $settings->name);
        });

        // Send update notification email to the admin
        Mail::send('admin.emails.reservation', array_merge($data, compact('settings', 'contact')), function ($message) use ($settings, $contact) {
            $message->from($contact->email, $settings->name);
            $message->to($contact->email, $settings->name);
            $message->subject('Reservation Updated - ' . $settings->name);
        });

        // Redirect to reservations list with a success message
        return redirect()->route('admin.reservations.index')->with('success', 'Reservation updated successfully.');
    }


}
