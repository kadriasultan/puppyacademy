<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IntakeController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'naam' => 'required|string',
            'naam_hond' => 'required|string',
            'geboortedatum' => 'nullable|date',
            'ras' => 'nullable|string',
            'geslacht' => 'nullable|string',
            'foto_hond' => 'nullable|image|max:2048',
        ]);

        // Foto opslaan
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('hondenfotos', 'public');
        }


        $validated['user_id'] = auth()->id();

        \App\Models\Intake::create($validated);

        return redirect()->route('profile')->with('success', 'Intake succesvol opgeslagen.');
    }

}
