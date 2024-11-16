<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Event;
use App\Models\Setting;
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
        if ($bookedRooms > 0 && $totalRooms > 0) {
            $occupancyPercent = ($bookedRooms / $totalRooms) * 100;
        }

        $events = Event::all();
        $setting = Setting::first();
        return view('admin.dashboard', compact('title', 'newGuestsThisMonth', 'occupancyPercent', 'bookedRooms', 'totalCheckIns', 'totalBooksThisMonth', 'reservations', 'events', 'totalRooms', 'totalReservations', 'totalReservationsThisMonth', 'setting'));
    }
}
