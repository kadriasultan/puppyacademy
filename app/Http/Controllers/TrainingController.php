<?php

namespace App\Http\Controllers;

use App\Mail\NewMessageNotification;
use App\Mail\TrainingRegistered;
use App\Mail\TrainingRegisteredAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TrainingController extends Controller
{
    public function register(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'training' => 'required|string|in:puppytraining,vuurwerkangst,gedragstraining',
        ]);

        // Logic to register the user for the chosen training (save in database, etc.)
        // You can create a Training model and store the data if needed.

        // Send a confirmation email to the user
        Mail::to($validated['email'])->send(new TrainingRegistered($validated));
        Mail::to('mgm@dr.com')->send(new TrainingRegisteredAdmin($validated));


        return redirect()->back()->with('status', 'Inschrijving succesvol! Check je inbox voor bevestiging.');
    }

    public function index()
    {
        return view('training');
    }

}
