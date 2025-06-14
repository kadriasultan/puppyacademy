<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Intake;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;

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
        if ($request->hasFile('foto_hond')) {
            $validated['foto_hond'] = $request->file('foto_hond')->store('hondenfotos', 'public');
        }

        // Koppel intake aan de ingelogde gebruiker
        $validated['user_id'] = auth()->id();

        // Intake opslaan
        $intake = Intake::create($validated);

        // Google Calendar afspraak toevoegen
        $client = new Google_Client();
        $client->setAuthConfig(storage_path('app/google-calendar/credentials.json'));
        $client->addScope(Google_Service_Calendar::CALENDAR);
        $client->setAccessType('offline');


        $accessToken = json_decode(file_get_contents(storage_path('app/google-calendar/token.json')), true);
        $client->setAccessToken($accessToken);

        if ($client->isAccessTokenExpired()) {
            // Token vernieuwen indien nodig
            if ($client->getRefreshToken()) {
                $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
                file_put_contents(storage_path('app/google-calendar/token.json'), json_encode($client->getAccessToken()));
            } else {
                return redirect()->route('dashboard')->with('error', 'Authenticatie met Google is verlopen. Neem contact op.');
            }
        }

        $calendar = new Google_Service_Calendar($client);

        // Voorbeeld: afspraak morgen om 10:00 voor 30 minuten
        $startDateTime = now()->addDay()->setTime(10, 0);
        $endDateTime = $startDateTime->copy()->addMinutes(30);

        $event = new Google_Service_Calendar_Event([
            'summary' => 'Intakewandeling voor ' . $validated['naam_hond'],
            'description' => 'Intake voor de opvang.',
            'start' => [
                'dateTime' => $startDateTime->toAtomString(),
                'timeZone' => 'Europe/Amsterdam',
            ],
            'end' => [
                'dateTime' => $endDateTime->toAtomString(),
                'timeZone' => 'Europe/Amsterdam',
            ],
        ]);

        $calendarId = 'primary';
        $calendar->events->insert($calendarId, $event);

        return redirect()->route('dashboard')->with('success', 'Intake en afspraak succesvol opgeslagen.');
    }
}
