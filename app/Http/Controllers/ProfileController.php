<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index(Request $request): View
    {
        return view('profile', [
            'user' => $request->user(),
        ]);
    }
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user()->load('dogs')
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Update gebruikersgegevens
        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        // Verwerk honden
        if ($request->has('dogs')) {
            $dogIds = [];

            foreach ($request->dogs as $dogData) {
                // Alleen verwerken als naam is ingevuld
                if (!empty($dogData['name'])) {
                    if (!empty($dogData['id'])) {
                        // Bestaande hond bijwerken
                        $dog = $user->dogs()->updateOrCreate(
                            ['id' => $dogData['id']],
                            [
                                'name' => $dogData['name'],
                                'nickname' => $dogData['nickname'] ?? null,
                                'breed' => $dogData['breed'] ?? null,
                                'age' => $dogData['age'] ?? null
                            ]
                        );
                        $dogIds[] = $dog->id;
                    } else {
                        // Nieuwe hond toevoegen
                        $dog = $user->dogs()->create([
                            'name' => $dogData['name'],
                            'nickname' => $dogData['nickname'] ?? null,
                            'breed' => $dogData['breed'] ?? null,
                            'age' => $dogData['age'] ?? null
                        ]);
                        $dogIds[] = $dog->id;
                    }
                }
            }

            // Verwijder honden die niet in het formulier zaten
            $user->dogs()->whereNotIn('id', $dogIds)->delete();
        }

        return redirect()->route('profile')->with('success', 'Profiel bijgewerkt!');
    }
    /**
     * Delete the user's account.
     */
    public function destroy(Request $request, $id): RedirectResponse
    {
        $user = \App\Models\User::findOrFail($id);

        // Alleen eigenaar of admin mag verwijderen
        if (Auth::id() !== $user->id && Auth::user()->role !== 'admin') {
            abort(403);
        }

        if (Auth::id() === $user->id) {
            $request->validateWithBag('userDeletion', [
                'password' => ['required', 'current_password'],
            ]);

            Auth::logout();

            $user->delete();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return Redirect::to('/');
        } else {
            $user->delete();
            return Redirect::route('dashboard')->with('status', 'user-deleted');
        }
    }

}
