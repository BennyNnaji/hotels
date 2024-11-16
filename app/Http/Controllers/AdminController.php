<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Event;
use App\Models\Setting;
use App\Models\Reservation;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard with various statistics and data.
     *
     * This function retrieves and calculates various metrics related to
     * room bookings, reservations, and guest information. It then passes
     * these data to the admin dashboard view.
     *
     * @return \Illuminate\View\View The rendered admin dashboard view
     */
    public function dashboard()
    {
        $title = 'Admin Dashboard';
        $events = Event::all();
        $setting = Setting::first();
        $reservations = Reservation::all();
        $totalRooms = Room::sum('quantity');
        $bookedRooms = Reservation::where('checkIn', '<=', now())
            ->where('checkOut', '>=', now())
            ->where('payment', 1)
            ->count();
        $totalCheckIns = Reservation::whereDay('checkIn', date('j'))
            ->where('payment', 1)
            ->count();
        $newGuestsThisMonth = Reservation::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->where('payment', 1)
            ->groupBy('email')
            ->count();
        $totalReservations = Reservation::where('status', 'active')->count();
        $totalReservationsThisMonth = Reservation::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->count();
        $totalBooksThisMonth = Reservation::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->where('payment', 1)
            ->count();
        $occupancyPercent = 0; // Default value
        if ($bookedRooms && $totalRooms) {
            $occupancyPercent = ($bookedRooms / $totalRooms) * 100;
        }
        return view('admin.dashboard', compact('title', 'newGuestsThisMonth', 'occupancyPercent', 'bookedRooms', 'totalCheckIns', 'totalBooksThisMonth', 'reservations', 'events', 'totalRooms', 'totalReservations', 'totalReservationsThisMonth', 'setting'));
    }
}
