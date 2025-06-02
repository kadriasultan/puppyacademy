<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Dagopvang;

use App\Models\Intake; // Vergeet deze niet bovenaan als je hem nog niet hebt


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index()
    {
        $user = Auth::user();
        $inschrijvingen = Dagopvang::where('user_id', $user->id)->latest()->get();
        $intake = Intake::where('user_id', $user->id)->latest()->first();

        return view('profile', compact('user', 'inschrijvingen', 'intake'));
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
