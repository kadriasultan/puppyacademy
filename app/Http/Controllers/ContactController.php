<?php
namespace App\Http\Controllers;

use App\Models\Message;
use App\Mail\NewMessageNotification;
use App\Mail\ConfirmationEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

        // 1. Opslaan van het bericht in de database
        $message = Message::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'message' => $validated['message'],
        ]);

        // 2. E-mail sturen naar de eigenaar
        Mail::to('mgm@dr.com')->send(new NewMessageNotification($message));

        // 3. Bevestiging sturen naar de gebruiker
        Mail::to($validated['email'])->send(new ConfirmationEmail($message));


        // 4. Redirect naar de vorige pagina met succes bericht
        return back()->with('success', 'Bedankt voor uw bericht! We nemen zo snel mogelijk contact met u op.');
    }
}
