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
        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        if ($request->has('dogs')) {
            $dogIds = [];

            foreach ($request->dogs as $dogData) {
                if (!empty($dogData['id'])) {
                    $dog = $user->dogs()->updateOrCreate(
                        ['id' => $dogData['id']],
                        [
                            'name' => $dogData['name'],
                            'nickname' => $dogData['nickname'],
                            'breed' => $dogData['breed'],
                            'age' => $dogData['age']
                        ]
                    );
                    $dogIds[] = $dog->id;
                }
            }

            $user->dogs()->whereNotIn('id', $dogIds)->delete();
        }

        return redirect()->route('profile')->with('success', 'Profiel bijgewerkt!');
    }

    public function destroyDog(Dog $dog)
    {
        if ($dog->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $dog->delete();

        return response()->json(['success' => true]);
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
