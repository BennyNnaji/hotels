<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Room;
use App\Models\Event;
use App\Models\Front;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Home";
        return view('index', compact('title'));
    }
    public function page(String $page)
    {
        $pageArray = ['index', 'book', 'about', 'rooms', 'reservation', 'blog', 'contact', 'events', 'reservation-successful'];
        if (!in_array($page, $pageArray)) {
            abort(404);
        } elseif ($page === 'index') {
            $title = "Home";
            return view('index', compact('title'));
        } elseif ($page === 'about') {
            $title = "About Us";
            return view('about', compact('title'));
        } elseif ($page === 'reservation') {
            $title = "Reservation";
            return view('reservation', compact('title'));
        } elseif ($page === 'contact') {
            $title = "Contact Us";
            return view('contact', compact('title'));
        } elseif ($page === 'blog') {
            $title = "Blog";
            $blogs = Blog::latest()->paginate(9);
            return view('blog', compact('title', 'blogs'));
        } elseif ($page === 'events') {
            $title = "Events";
            // Get upcoming events
            $events = Event::orderBy('date', 'asc')
                ->where('date', '>=', now())
                ->paginate(9);

            // Get past events
            $pastEvents = Event::orderBy('date', 'asc')
                ->where('date', '<', now())
                // ->get();
                ->paginate(3);


            return view('events', compact('title', 'events', 'pastEvents'));
        } elseif ($page === 'rooms') {
            $title = "Rooms";
            $rooms = Room::all();
            return view('rooms', compact('title', 'rooms'));
        }
    }
    public function eventDetails($id)
    {
        $event = Event::find($id);
        $title = $event->title;
        return view('event-details', compact('title', 'event'));
    }
    public function blogDetails($id)
    {
        $blog = Blog::find($id);
        $title = $blog->title;
        return view('blog-details', compact('title', 'blog'));
    }
}
