<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Dog;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'naam_hond' => 'string|max:255',
            'geboortedatum_hond' => 'date',
            'ras' => 'string|max:255',
            'geslacht' => 'in:Reu,Teef',
            'foto_hond' => 'image|max:2048',
        ]);

        // Upload de hondenfoto
        $imageName = null;
        if ($request->hasFile('foto_hond')) {
            $image = $request->file('foto_hond');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/honden'), $imageName);
        }

        // Maak de user aan
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        event(new Registered($user));
        Auth::login($user);

        // Maak de hond aan, gekoppeld aan de user
        $Dog = Dog::create([
            'user_id' => $user->id,
            'naam' => $validated['name'],
            'naam_hond' => $validated['naam_hond'],
            'geboortedatum' => $validated['geboortedatum_hond'],
            'ras' => $validated['ras'],
            'geslacht' => $validated['geslacht'],
            'foto' => $imageName ? 'images/honden/' . $imageName : null,
        ]);

        return redirect(route('welcome', absolute: false));
    }
}
