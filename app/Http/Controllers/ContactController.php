<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Setting;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function edit()
    {
        $contact = Contact::first();
        $title = 'Contact Details';
        $setting = Setting::first();
        return view('admin.contact-index', compact('title', 'contact', 'contact', 'setting'));
    }

    public function update(Request $request, Contact $contact)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'map' => 'required',
            'facebook' => 'required',
            'instagram' => 'required',
            'twitter' => 'required',
            'whatsapp' => 'required',
        ]);
        $contact = Contact::first();
        $contact->update($validatedData);
        return redirect()->back()->with('success', 'Contact updated successfully');
    }
}
