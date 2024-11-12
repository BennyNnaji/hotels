<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function edit()
    {
        $setting = Setting::first();
        $title = "General Settings";
        return view('admin.settings', compact('setting', 'title'));
    }

    /**
     * Update the specified settings.
     */
    public function update(Request $request)
    {
        // Validate the input data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'hero_header' => 'required |string|max:255',
            'hero_subheader' => 'required |string|max:5000',
            'button1_text' => 'required |string|max:50',
            'button1_link' => 'required |max:255',
            'button2_text' => 'required |string|max:50',
            'button2_link' => 'required |max:255',
            'logo' => 'nullable |image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon' => 'nullable |image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'hero_background' => 'nullable |image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);

        // Retrieve the first settings record or create one if it doesn't exist
        $settings = Setting::firstOrCreate([]);

        // Handle image uploads
        if ($request->hasFile('logo')) {
            // Delete the old logo if it exists
            if ($settings->logo) {
                Storage::disk('public')->delete($settings->logo);
            }
            $settings->logo = $request->file('logo')->store('front', 'public');
        }

        if ($request->hasFile('favicon')) {
            if ($settings->favicon) {
                Storage::disk('public')->delete($settings->favicon);
            }
            $settings->favicon = $request->file('favicon')->store('front', 'public');
        }

        if ($request->hasFile('hero_background')) {
            if ($settings->hero_background) {
                Storage::disk('public')->delete($settings->hero_background);
            }
            $settings->hero_background = $request->file('hero_background')->store('front', 'public');
        }

        // Assign other validated fields
        $settings->name = $validated['name'];
        $settings->hero_header = $validated['hero_header'];
        $settings->hero_subheader = $validated['hero_subheader'];
        $settings->button1_text = $validated['button1_text'];
        $settings->button1_link = $validated['button1_link'];
        $settings->button2_text = $validated['button2_text'];
        $settings->button2_link = $validated['button2_link'];
        $settings->highlights = $validated['highlights'] ?? []; // Save highlights as JSON

        // Save the settings
        $settings->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
    public function updateHighlights(Request $request)
    {
        $validated = $request->validate([
            'highlights' => 'nullable|array',
            'highlights.*.title' => 'required|string|max:255',
            'highlights.*.description' => 'nullable|string|max:500',
        ]);
        // Retrieve the first settings record or create one if it doesn't exist
        $settings = Setting::firstOrCreate([]);

        $settings->highlights = $validated['highlights'] ?? []; // Save highlights as JSON

        // Save the settings
        $settings->save();
        return redirect()->back()->with('success', 'Highlight updated successfully.');

    }
}
