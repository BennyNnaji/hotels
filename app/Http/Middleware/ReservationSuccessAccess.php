<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class ReservationSuccessAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the session has a reservation_id
        if (!Session::has('reservation_id')) {
            return redirect()->route('guest', ['page' => 'reservation'])->with('error', 'Unauthorized access...');
        }

        // Get the reservation_id from the session
        $sessionReservationId = Session::get('reservation_id');

        // Get the reservation ID from the route parameters
        $routeReservationId = $request->route('id');

        // Allow access to the success route without checking reservation_id
        if ($request->routeIs('reservation.success') && Session::has('reservation_id')) {
            return $next($request);
        }
        // // Check if the session reservation ID matches the route reservation ID
        // if ($sessionReservationId != $routeReservationId) {
        //     return redirect()->route('guest', ['page' => 'reservation'])->with('error', 'Unauthorized access.');
        // }

        // If they match, proceed with the request
        return $next($request);
    }
}
