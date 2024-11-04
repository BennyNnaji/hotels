<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ReservationController extends Controller
{
    public function index()
    {
        $title = 'Reservations';
        $reservations = Reservation::all();
        return view('admin.reservations.index', compact('title', 'reservations'));
    }

    public function create()
    {
        $title = 'Add Reservation';
        return view('admin.reservations.create', compact('title'));
    }

    public function show($id)
    {
        $title = ' Reservation Details';
        $reservation = Reservation::find($id);
        return view('admin.reservations.show', compact('title', 'reservation'));
    }
    public function edit($id)
    {
        $title = 'Edit Reservation';
        $reservation = Reservation::find($id);
        return view('admin.reservations.edit', compact('title', 'reservation'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'checkIn' => 'required|date|after_or_equal:today',
            'checkOut' => 'required|date|after_or_equal:checkIn',
            'roomType' => 'required|in:single,double,suite',
            'guests' => 'required|integer|min:1',
            'terms' => 'accepted', // Terms must be accepted
            'marketing' => 'nullable|boolean',
            'payment' => 'nullable|boolean',
        ]);

        // Create a new reservation with validated data
        $reservation = Reservation::create([
            'fullName' => $validatedData['fullName'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'] ?? null,
            'checkIn' => $validatedData['checkIn'],
            'checkOut' => $validatedData['checkOut'],
            'roomType' => $validatedData['roomType'],
            'guests' => $validatedData['guests'],
            'terms' => true,
            'marketing' => $validatedData['marketing'] ?? false,
            'payment' => $validatedData['payment'] ?? false,

        ]);
        // Ensure the reservation is created and fields are populated correctly before sending the email
        if ($reservation) {

            // Email data to be sent
            $data = [
                'fullName' => $reservation->fullName,
                'phone' => $reservation->phone,
                'email' => $reservation->email,
                'checkIn' => $reservation->checkIn,
                'checkOut' => $reservation->checkOut,
                'roomType' => ucfirst($reservation->roomType),
                'guests' => $reservation->guests,
                'payment' => $reservation->payment,
            ];
            // Send confirmation email to the guest
            Mail::send('emails.reservation', $data, function ($message) use ($reservation) {
                $message->from('hotel@easyworldtechs.com', 'Orient Hotel');
                $message->to($reservation->email, $reservation->fullName);
                $message->subject('Reservation Confirmation - Orient Hotel');
            });

            // Send confirmation email to the admin
            Mail::send('admin.emails.reservation', $data, function ($message) {
                $message->from('hotel@easyworldtechs.com', 'Orient Hotel');
                $message->to('admin@easyworldtechs.com', 'Orient Hotel');
                $message->subject('Reservation Notification - Orient Hotel');
            });
        }

        // Save reservation ID in session and redirect to success page
        session(['reservation_id' => $reservation->id]);
        if (Auth::user()) {
            return redirect()->route('admin.reservations.index')->with('success', 'Your reservation has been successfully created.');
        }
        return redirect()->route('reservation.success')->with('success', 'Your reservation has been successfully created.');
    }
    public function update(Request $request, Reservation $reservation)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'checkIn' => 'required|date|after_or_equal:today',
            'checkOut' => 'required|date|after_or_equal:checkIn',
            'roomType' => 'required|in:single,double,suite',
            'status' => 'required|in:active,canceled,timed out',
            'guests' => 'required|integer|min:1',
            'payment' => 'nullable|boolean',
        ]);

        // Update the reservation with validated data
        $reservation->update([
            'fullName' => $validatedData['fullName'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'] ?? null,
            'checkIn' => $validatedData['checkIn'],
            'checkOut' => $validatedData['checkOut'],
            'roomType' => $validatedData['roomType'],
            'guests' => $validatedData['guests'],
            'status' => $validatedData['status'],
            'payment' => $validatedData['payment'] ?? false,

        ]);

        // Email data to be sent
        $data = [
            'fullName' => $reservation->fullName,
            'phone' => $reservation->phone,
            'email' => $reservation->email,
            'checkIn' => $reservation->checkIn,
            'checkOut' => $reservation->checkOut,
            'roomType' => ucfirst($reservation->roomType),
            'guests' => $reservation->guests,
            'status' => $reservation->status,
            'payment' => $reservation->payment,
        ];

        // Send confirmation email to the guest
        Mail::send('emails.reservation-update', $data, function ($message) use ($reservation) {
            $message->from('hotel@easyworldtechs.com', 'Orient Hotel');
            $message->to($reservation->email, $reservation->fullName);
            $message->subject('Reservation Update - Orient Hotel');
        });

        // Send update notification email to the admin
        Mail::send('admin.emails.reservation-update', $data, function ($message) {
            $message->from('hotel@easyworldtechs.com', 'Orient Hotel');
            $message->to('admin@easyworldtechs.com', 'Orient Hotel');
            $message->subject('Reservation Updated - Orient Hotel');
        });

        // Redirect to reservations list with a success message
        return redirect()->route('admin.reservations.index')->with('success', 'Reservation updated successfully.');
    }


    public function success()
    {
        // Retrieve reservation details if needed
        $reservationId = session('reservation_id');
        $title = "Reservation Successfully";

        // Clear reservation ID from session
        // session()->forget('reservation_id');

        return view('reservation-successful', compact('reservationId', 'title'));
    }
}
