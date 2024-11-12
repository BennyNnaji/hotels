<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    public function edit()
    {
        // Retrieve the about or create a new instance if not existing
        $about = About::firstOrCreate();
        $setting = Setting::first();
        $title = 'About Us';

        return view('admin.about', compact('about', 'title', 'setting'));
    }


    public function update(Request $request)
    {
        $about = About::first();
        $data = $request->validate([
            'about_us' => 'required|string',
            'about_us_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'mission' => 'nullable|string',
            'vision' => 'nullable|string',
            'amenities' => 'nullable|array',
            'amenities.*.icon' => 'required|string',
            'amenities.*.title' => 'required|string',
            'amenities.*.description' => 'nullable|string',
            'team' => 'nullable|array',
            'team.*.name' => 'required|string',
            'team.*.role' => 'required|string',
            'team.*.description' => 'nullable|string',
            'team.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif'
        ]);

        // Handling About Us Image
        if ($request->hasFile('about_us_image')) {
            if ($about->about_us_image) {
                Storage::disk('public')->delete($about->about_us_image);
            }
            $data['about_us_image'] = $request->file('about_us_image')->store('front', 'public');
        }

        // Handling Team Images
        if (isset($data['team'])) {
            foreach ($data['team'] as $index => $member) {
                if (isset($member['image']) && $member['image'] instanceof \Illuminate\Http\UploadedFile) {
                    // If an image is being uploaded, delete the existing one (if any)
                    if (isset($about->team[$index]['image'])) {
                        Storage::disk('public')->delete($about->team[$index]['image']);
                    }
                    // Store the new image
                    $data['team'][$index]['image'] = $member['image']->store('team', 'public');
                } elseif (isset($about->team[$index]['image'])) {
                    // If no new image is uploaded, keep the existing image
                    $data['team'][$index]['image'] = $about->team[$index]['image'];
                }
            }
        }


        // Updating about with New Data
        $about->update($data);

        return redirect()->route('admin.about.edit')->with('success', 'About Us section updated successfully.');
    }
}
