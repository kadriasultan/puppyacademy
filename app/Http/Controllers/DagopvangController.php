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
            'email' => 'required|email|max:255',
            'phone' => 'required|regex:/^[0-9+\s\-()]{7,15}$/',
            'naam_hond' => 'required|string|max:255',
            'geboortedatum_hond' => 'required|date',
            'ras' => 'required|string|max:255',
            'geslacht' => 'required|in:Reu,Teef',
            'foto_hond' => 'required|image|max:2048',
        ]);


        if ($request->hasFile('foto_hond')) {
            $image = $request->file('foto_hond');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/honden');
            $image->move($destinationPath, $imageName);
        } else {
            $imageName = null;
        }


        $intake = Intake::create([
            'user_id' => auth()->id(),
            'naam' => $validated['naam'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'naam_hond' => $validated['naam_hond'],
            'geboortedatum' => $validated['geboortedatum_hond'],
            'ras' => $validated['ras'],
            'geslacht' => $validated['geslacht'],
            'foto' => 'images/honden/'.$imageName,
        ]);
        $user = Auth::user();
        $dogId = $request->dog_id;

        if (!$dogId) {
            if ($user) {
               $dog = $user->dogs()->create([
                    'naam' => $validated['naam'],
                    'email' => $validated['email'],
                    'phone' => $validated['phone'],
                    'naam_hond' => $validated['naam_hond'],
                    'geboortedatum' => $validated['geboortedatum_hond'],
                    'ras' => $validated['ras'],
                    'geslacht' => $validated['geslacht'],
                    'foto' => 'images/honden/'.$imageName,
                ]);
            } else {

                $dog = \App\Models\Dog::create([
                    'naam' => $validated['naam'],
                    'email' => $validated['email'],
                    'phone' => $validated['phone'],
                    'naam_hond' => $validated['naam_hond'],
                    'geboortedatum' => $validated['geboortedatum_hond'],
                    'ras' => $validated['ras'],
                    'geslacht' => $validated['geslacht'],
                    'foto' => 'images/honden/'.$imageName,

                ]);
            }

            $dogId = $dog->id;
        }

        // Mail data voorbereiden
        $inschrijving = [
            'naam' => $validated['naam'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'naam_hond' => $validated['naam_hond'],
            'geboortedatum' => $validated['geboortedatum_hond'],
            'ras' => $validated['ras'],
            'geslacht' => $validated['geslacht'],
            'foto' => 'images/honden/'.$imageName,
        ];

        Mail::to($validated['email'])->send(new DagopvangInschrijving($inschrijving, Auth::user()));
        Mail::to('mgm@dr.com')->send(new DagopvangInschrijving($inschrijving, Auth::user()));

        return redirect()->route('dagopvang.payment', ['intake_id' => $intake->id]);
 }
    public function intakepayment(Request $request)
    {
        return view('dagopvang.payment');
    }

    public function processintakepayment(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|string|in:bank,ideal,tikki',
        ]);

        $paymentMethod = $request->input('payment_method');

        if ($paymentMethod === 'ideal') {
            // Redirect direct (of maak dezelfde flow als bank)
            return redirect('https://www.ing.nl/payreq/m/?trxid=7cMPUFyxozWfzrR9IePxCbq4XKPUun6x');
        }
        if ($paymentMethod === 'bank') {
            // Deze case wordt door JS afgehandeld, dus kan leeg blijven of redirect terug
            return redirect()->route('dagopvang.bedankt')->with('success', 'Betaling gelukt! Dank je wel.');
        }
        if ($paymentMethod === 'tikki') {
            return redirect('https://www.tikkie.me/');
        }

        // Voor andere betaalmethodes
        $betalingGeslaagd = true; // Logica hier

        if ($betalingGeslaagd) {
            return redirect()->route('dagopvang.bedankt')->with('success', 'Betaling gelukt! Dank je wel.');
        } else {
            return redirect()->back()->withErrors('Betaling is mislukt, probeer het opnieuw.');
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

