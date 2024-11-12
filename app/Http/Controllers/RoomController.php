<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    public function index()
    {
        $title = 'Rooms';
        $rooms = Room::all();
        $setting = Setting::first();
        return view('admin.rooms.index', compact('title', 'rooms', 'setting'));
    }
    public function create()
    {
        $title = 'Add Room';
        $setting = Setting::first();
        return view('admin.rooms.create', compact('title', 'setting'));
    }

    // Store a newly created room in storage
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'refId' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'photos' => 'required|array',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'amenities' => 'nullable|array'
        ]);

        // Handle photo upload
        $photoPaths = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('rooms', 'public');
                $photoPaths[] = $path;
            }
        }

        // Create room
        Room::create([
            'title' => $request->input('title'),
            'refId' => $request->input('refId'),
            'quantity' => $request->input('quantity'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'photos' => $photoPaths, // Assuming $photoPaths is an array
            'amenities' => $request->input('amenities', []), // This will automatically be cast to JSON
        ]);


        return redirect()->route('admin.rooms.index')->with('success', 'Room added successfully.');
    }
    // Display the specified room
    public function show($id)
    {
        $room = Room::findOrFail($id);
        $title = "Room Details";
        $setting = Setting::first();
        return view('admin.rooms.show', compact('room', 'title', 'setting'));
    }
    // Show the form for editing the specified room
    public function edit($id)
    {
        $title = 'Edit Room';
        $room = Room::findOrFail($id);
        $setting = Setting::first();
        return view('admin.rooms.edit', compact('room', 'title', 'setting'));
    }

    // Update the specified room in storage
    public function update(Request $request, Room $room)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'refId' => 'required|string|max:255',
            'quantity' => 'required|numeric',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'photos' => 'nullable|array',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'amenities' => 'nullable|array'
        ]);

        // Update photo if new ones are uploaded
        if ($request->hasFile('photos')) {
            // Delete old photos
            foreach (($room->photos) as $oldPhoto) {
                Storage::disk('public')->delete($oldPhoto);
            }

            // Store new photos
            $photoPaths = [];
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('rooms', 'public');
                $photoPaths[] = $path;
            }
            $room->photos = ($photoPaths);
        }

        // Update other details
        $room->update([
            'title' => $request->input('title'),
            'refId' => $request->input('refId'),
            'quantity' => $request->input('quantity'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'amenities' => ($request->input('amenities', []))
        ]);

        return redirect()->route('admin.rooms.index')->with('success', 'Room updated successfully.');
    }

    // Remove the specified room from storage
    public function destroy(Room $room)
    {
        foreach ($room->photos as $photo) {
            Storage::disk('public')->delete($photo);
        }

        $room->delete();
        return redirect()->route('admin.rooms.index')->with('success', 'Room deleted successfully.');
    }
}
