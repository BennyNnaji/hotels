<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Room;
use App\Models\About;
use App\Models\Event;
use App\Models\Front;
use App\Models\Contact;
use App\Models\Feature;
use App\Models\Setting;
use App\Models\Marketing;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FrontController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Home";
        // Get upcoming events
        $events = Event::orderBy('date', 'asc')
            ->where('date', '>=', now())
            ->paginate(9);
        $setting = Setting::first();
        $about = About::first();
        $rooms = Room::all();
        $testimonials = Testimonial::all();
        $contact = Contact::first();
        $blogs = Blog::latest()->take(3)->get();
        return view('index', compact('title', 'events', 'blogs', 'setting', 'about', 'contact', 'rooms', 'testimonials'));
    }
    public function page(String $page)
    {
        $pageArray = ['features', 'about', 'rooms', 'reservation', 'blog', 'contact', 'events', 'reservation-successful'];
        if (!in_array($page, $pageArray)) {
            abort(404);
        } elseif ($page === 'about') {
            $title = "About Us";
            $about = About::first();
            $setting = Setting::first();
            $contact = Contact::first();
            return view('about', compact('title', 'about', 'contact', 'setting'));
        } elseif ($page === 'reservation') {
            $title = "Reservation";
            $contact = Contact::first();
            $rooms = Room::all();
            $setting = Setting::first();
            return view('reservation', compact('title', 'contact', 'rooms', 'setting'));
        } elseif ($page === 'contact') {
            $title = "Contact Us";
            $contact = Contact::first();
            $setting = Setting::first();
            return view('contact', compact('title', 'contact', 'setting'));
        } elseif ($page === 'blog') {
            $title = "Blog";
            $blogs = Blog::latest()->paginate(9);
            $contact = Contact::first();
            $setting = Setting::first();
            return view('blog', compact('title', 'blogs', 'contact', 'setting'));
        } elseif ($page === 'events') {
            $title = "Events";
            $contact = Contact::first();
            // Get upcoming events
            $events = Event::orderBy('date', 'asc')
                ->where('date', '>=', now())
                ->paginate(9);

            // Get past events
            $pastEvents = Event::orderBy('date', 'asc')
                ->where('date', '<', now())
                // ->get();
                ->paginate(3);

            $setting = Setting::first();
            return view('events', compact('title', 'events', 'pastEvents', 'contact', 'setting'));
        } elseif ($page === 'rooms') {
            $title = "Rooms";
            $rooms = Room::all();
            $contact = Contact::first();
            $setting = Setting::first();
            return view('rooms', compact('title', 'rooms', 'contact', 'setting'));
        } elseif ($page === 'features') {
            $features = Feature::paginate(12);
            $title = "Features";
            $contact = Contact::first();
            $setting = Setting::first();
            return view('features', compact('title', 'features', 'contact', 'setting'));
        }
    }
    public function eventDetails($id)
    {
        $event = Event::find($id);
        $title = $event->title;
        $contact = Contact::first();
        $setting = Setting::first();
        return view('event-details', compact('title', 'event', 'contact', 'setting'));
    }
    public function blogDetails($id)
    {
        $blog = Blog::find($id);
        $title = $blog->title;
        $contact = Contact::first();
        $setting = Setting::first();
        return view('blog-details', compact('title', 'blog', 'contact', 'setting'));
    }

    public function terms()
    {
        $page = Front::where('name', 'terms')->first();
        $title = "Terms & Conditions";
        $contact = Contact::first();
        $setting = Setting::first();
        return view('admin.terms', compact('title', 'page', 'contact', 'setting'));
    }
    public function termsUpdate(Request $request, Front $page)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $page->update($request->all());
        return redirect()->back()->with('status', 'Terms and Conditions updated successfully.');
    }

    public function privacy()
    {
        $page = Front::where('name', 'privacy')->first();
        $title = "Privacy Policy";
        $contact = Contact::first();
        $setting = Setting::first();
        return view('admin.privacy', compact('title', 'page', 'contact', 'setting'));
    }
    public function privacyUpdate(Request $request, Front $page)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $page->update($request->all());
        return redirect()->back()->with('status', 'Privacy Policy updated successfully.');
    }

    public function contact(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);
        $contact = Contact::first();
        $settings = Setting::first();
        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'message_body' => $request->message,
        ];
        Mail::send('admin.emails.contact-form', array_merge($data, compact('settings', 'contact')), function ($message) use ($settings, $contact) {
            $message->from($contact->email, $settings->name);
            $message->to($contact->email, $settings->name);
            $message->subject('New Message from your website.');
        });
        return redirect()->back()->with('success', 'Your message has been sent successfully.');
    }
    public function newsletter(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|unique:marketings',
        ]);
        Marketing::create($validatedData);
        $settings = Setting::first();
        $contact = Contact::first();
        $email = $request->email;

        // Send confirmation email to the guest
        Mail::send('emails.newsletter_subscription', array_merge(compact('settings', 'contact')), function ($message) use ($email, $settings, $contact) {
            $message->from($contact->email, $settings->name);
            $message->to($email, "Subscriber");
            $message->subject('Subscription Confirmation -' . $settings->name);
        });

        return redirect()->back()->with('success', 'Thank you for subscribing to our newsletter.');
    }
    public function featuresDetails($id)
    {
        $feature = Feature::find($id);
        $title = $feature->title;
        $contact = Contact::first();
        $setting = Setting::first();
        return view('feature-details', compact('title', 'feature', 'contact', 'setting'));
    }
}
