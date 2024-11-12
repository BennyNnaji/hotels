<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $title = "All Events"; // Dynamic title for index page
        $events = Event::paginate(9); // Fetch all events
        $setting = Setting::first();
        return view('admin.events.index', compact('events', 'title', 'setting'));
    }

    public function create()
    {
        $title = "Create Event"; // Dynamic title for create page
        $setting = Setting::first();
        return view('admin.events.create', compact('title', 'setting')); // Show the create event form
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'ticket' => 'required|numeric|min:0',
        ]);

        // Handle the picture upload
        $picturePath = null;
        if ($request->hasFile('picture')) {
            $picturePath = $request->file('picture')->store('events', 'public');
        }

        // Create a new event with validated data
        Event::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'date' => $validatedData['date'],
            'location' => $validatedData['location'],
            'picture' => $picturePath,
            'ticket' => $validatedData['ticket'],
        ]);

        return redirect()->route('admin.events.index')->with('success', 'Event created successfully.');
    }

    public function show(Event $event)
    {
        $title = "Event Details - " . $event->title; // Dynamic title for show page
        $setting = Setting::first();
        return view('admin.events.show', compact('event', 'title', 'setting')); // Show the event details
    }

    public function edit(Event $event)
    {
        $title = "Edit Event - " . $event->title; // Dynamic title for edit page
        $setting = Setting::first();
        return view('admin.events.edit', compact('event', 'title', 'setting')); // Show the edit form for the event
    }

    public function update(Request $request, Event $event)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'ticket' => 'required|numeric|min:0',
        ]);

        // Handle the picture upload
        $picturePath = $event->picture; // Keep existing picture if not updated
        if ($request->hasFile('picture')) {
            // Delete the old picture if it exists
            if ($event->picture) {
                Storage::disk('public')->delete($event->picture);
            }
            // Store the new picture
            $picturePath = $request->file('picture')->store('events', 'public');
        }

        // Update the event with validated data
        $event->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'date' => $validatedData['date'],
            'location' => $validatedData['location'],
            'picture' => $picturePath,
            'ticket' => $validatedData['ticket'],
        ]);

        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {


        // Delete the event picture if it exists
        if ($event->picture) {
            Storage::disk('public')->delete($event->picture);
        }

        // Delete the event
        $event->delete();

        return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully.');
    }
}
