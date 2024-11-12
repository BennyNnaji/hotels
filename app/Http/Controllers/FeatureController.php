<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeatureController extends Controller
{
    // Display a listing of the features.
    public function index()
    {
        $features = Feature::all();
        $setting = Setting::first();
        $title = "Features";
        return view('admin.features.index', compact('features', 'title', 'setting'));
    }

    // Show the form for creating a new feature.
    public function create()
    {
        $setting = Setting::first();
        $title = "Add New Feature";
        return view('admin.features.create', compact('title', 'setting'));
    }

    // Store a newly created feature in storage.
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Feature::create($data);

        return redirect()->route('admin.features.index')->with('success', 'Feature added successfully.');
    }

    // Display the specified feature.
    public function show(Feature $feature)
    {
        $setting = Setting::first();
        $title = "Feature Details ";
        return view('admin.features.show', compact('feature', 'title', 'setting'));
    }

    // Show the form for editing the specified feature.
    public function edit(Feature $feature)
    {
        $setting = Setting::first();
        $title = "Edit Feature";
        return view('admin.features.edit', compact('feature', 'title', 'setting'));
    }

    // Update the specified feature in storage.
    public function update(Request $request, Feature $feature)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $feature->update($data);

        return redirect()->route('admin.features.index')->with('success', 'Feature updated successfully.');
    }

    // Remove the specified feature from storage.
    public function destroy(Feature $feature)
    {
        $feature->delete();
        return redirect()->route('admin.features.index')->with('success', 'Feature deleted successfully.');
    }
}
