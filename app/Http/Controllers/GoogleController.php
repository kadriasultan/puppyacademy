<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            return redirect('/login')->withErrors([
                'google' => 'Er bestaat nog geen account met dit Google-adres. Registreer eerst via het formulier.'
            ]);
        }

        Auth::login($user);

        return redirect('https://calendar.google.com/calendar/u/0/r');
    }

}
