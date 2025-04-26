<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DagopvangController extends Controller
{
    public function store(Request $request)
    {
        // Valideer en sla de aanmelding op
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'dog' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'notes' => 'nullable|string',
        ]);

        // Hier zou je normaal de data opslaan in de database
        // Bijvoorbeeld:
        // Dagopvang::create($validated);

        return back()->with('success', 'Aanmelding ontvangen!');
    }
    public function index()
    {
        return view('dagopvang');
    }

}

