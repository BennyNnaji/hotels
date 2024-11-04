<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Event;
use App\Models\Reservation;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $title = 'Admin Dashboard';
        $reservations = Reservation::all();
        $totalRooms = Room::sum('quantity');
        $bookedRooms = Reservation::where('checkIn', '<=', now())
            ->where('checkOut', '>=', now())
            ->where('payment', 1)
            ->count();
        $newGuestsThisMonth = Reservation::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            // ->where('payment', 1)
            ->groupBy('email')
            ->count();
        $totalReservations = Reservation::count();
        $totalReservationsThisMonth = Reservation::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->count();
        $totalBooksThisMonth = Reservation::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->where('payment', 1)
            ->count();
        $occupancyPercent = ($bookedRooms / $totalRooms) * 100;

        $events = Event::paginate(10);
        return view('admin.dashboard', compact('title', 'newGuestsThisMonth', 'occupancyPercent', 'bookedRooms', 'totalBooksThisMonth', 'reservations', 'events', 'totalRooms', 'totalReservations', 'totalReservationsThisMonth'));
    }
}
