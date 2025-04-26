<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:2000',
        ]);

        // Here you would typically:
        // 1. Save to database
        // 2. Send email notification
        // 3. Maybe send a confirmation email to the user

        // For now, we'll just return a success message
        return back()->with('success', 'Bedankt voor uw bericht! We nemen zo snel mogelijk contact met u op.');
    }
}
