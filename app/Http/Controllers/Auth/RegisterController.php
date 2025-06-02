<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Intake;
use App\Models\User;
use App\Models\Dog;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisterController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    /**

     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
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


        $dogId = $request->dog_id;

        if (!$dogId) {

                $dog = \App\Models\Dog::create([
                    'naam' => $validated['name'],
                    'email' => $validated['email'],
                    'phone' => $validated['phone'],
                    'naam_hond' => $validated['naam_hond'],
                    'geboortedatum' => $validated['geboortedatum_hond'],
                    'ras' => $validated['ras'],
                    'geslacht' => $validated['geslacht'],
                    'foto' => 'images/honden/'.$imageName,

                ]);
            }


        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        event(new Registered($user));



        Auth::login($user);

        return redirect(route('welcome'));
    }

}
