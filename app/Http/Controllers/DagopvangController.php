<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Dog;
use App\Models\user;
use App\Models\Dagopvang;
use App\Mail\DagopvangInschrijving;
use Illuminate\Support\Facades\Mail;
use App\Models\Intake;



class DagopvangController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $dogs = $user ? $user->dogs : collect();
        return view('dagopvang', compact('user', 'dogs'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'naam' => 'required|string|max:255',
            'adres' => 'required|string|max:255',
            'woonplaats' => 'required|string|max:255',
            'soort_hond' => 'required|string|max:255',
            'naam_hond' => 'required|string|max:255',
            'roepnaam' => 'required|string|max:255',
            'telefoon' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'voorkeursdatum' => 'required|date',
            'age' => 'required|integer|min:0',
        ]);

        $user = Auth::user();
        $dogId = $request->dog_id;

        // Hond aanmaken indien nodig
        if ($user && !$dogId) {
            $dog = $user->dogs()->create([
                'name' => $request->naam_hond,
                'nickname' => $request->roepnaam,
                'breed' => $request->soort_hond,
                'age' => $request->age,
            ]);
            $dogId = $dog->id;
        }

        // Intake opslaan
        $intake = Intake::create([
            'user_id' => auth()->id(),
            'naam' => $request->input('naam'),
            'naam_hond' => $request->input('naam_hond'),
            // Voeg hier alle andere intakevelden toe
        ]);

        // Dagopvang opslaan
        Dagopvang::create([
            'user_id' => $user?->id,
            'dog_id' => $dogId,
            'naam' => $request->naam,
            'adres' => $request->adres,
            'woonplaats' => $request->woonplaats,
            'soort_hond' => $request->soort_hond,
            'naam_hond' => $request->naam_hond,
            'roepnaam' => $request->roepnaam,
            'telefoon' => $request->telefoon,
            'email' => $request->email,
            'voorkeursdatum' => $request->voorkeursdatum,
        ]);

        // Email versturen
        $inschrijving = $request->only([
            'naam', 'adres', 'woonplaats', 'soort_hond',
            'naam_hond', 'roepnaam', 'telefoon', 'email', 'age', 'voorkeursdatum'
        ]);

        Mail::to($request->email)->send(new DagopvangInschrijving($inschrijving, $user));
        Mail::to('mgm@dr.com')->send(new DagopvangInschrijving($inschrijving, $user));

        // ✅ Pas hierna redirect toe
        return redirect()->route('payment', ['intake_id' => $intake->id])
            ->with('success', 'Je hebt je hond succesvol ingeschreven voor de dagopvang!');
    }
    public function build()
    {
        return $this->subject('Nieuwe Intake Aanmelding')
            ->view('emails.intake_bevesteging'); // jouw aangepaste template
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

