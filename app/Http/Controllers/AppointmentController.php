<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Client;
use Google\Service\Calendar;
use Google\Service\Calendar\Event;
use Google\Service\Calendar\EventDateTime;
use DateTime;

class AppointmentController extends Controller
{
    protected $client;

    public function __construct()
    {
        $client = new Client();
        $client->setAuthConfig(storage_path('app/google/puppypower-461419-e0a4b10e1df3.json')); // pad naar je service account JSON
        $client->addScope(Calendar::CALENDAR);
        $client->setAccessType('offline');

        $this->client = $client;
    }

    public function maakAfspraak(Request $request)
    {
        $timezone = new \DateTimeZone('Europe/Amsterdam');
        $start = new \DateTime($request->start, $timezone);
        $end = clone $start;
        $end->modify('+30 minutes');

        $startDateTime = $start->format(\DateTime::RFC3339);
        $endDateTime = $end->format(\DateTime::RFC3339);

        $calendarService = new \Google_Service_Calendar($this->client);
        $calendarId = 'puppypoweracademy2025@gmail.com'; // gebruik dit overal

        // Controleer op dubbele afspraken in de juiste agenda
        $opties = [
            'timeMin' => $startDateTime,
            'timeMax' => $endDateTime,
            'singleEvents' => true,
            'orderBy' => 'startTime',
        ];

        $events = $calendarService->events->listEvents($calendarId, $opties);

        if (count($events->getItems()) > 0) {
            return redirect()->back()->with('error', 'Er is al een afspraak in dit tijdsblok.');
        }

        // Nieuwe afspraak maken
        $event = new \Google_Service_Calendar_Event([
            'summary' => 'Intakewandeling',
            'description' => $request->beschrijving,
            'start' => ['dateTime' => $startDateTime, 'timeZone' => 'Europe/Amsterdam'],
            'end' => ['dateTime' => $endDateTime, 'timeZone' => 'Europe/Amsterdam'],
        ]);

        $calendarService->events->insert($calendarId, $event);

        return redirect()->back()->with('success', 'Afspraak succesvol gemaakt!');
    }

}
