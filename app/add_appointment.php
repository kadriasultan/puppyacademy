<?php

require __DIR__ . '/vendor/autoload.php';

// Zet het pad naar je JSON service account file
putenv('GOOGLE_APPLICATION_CREDENTIALS=' . __DIR__ . '/puppypower-461419-service-account.json');

// Google Client initialiseren
$client = new Google_Client();
$client->useApplicationDefaultCredentials();
$client->addScope(Google_Service_Calendar::CALENDAR);

// Google Calendar service
$service = new Google_Service_Calendar($client);

// Functie om afspraak toe te voegen
function addAppointmentToCalendar($service, $calendarId, $startDateTime, $endDateTime, $summary, $description = '') {
    $event = new Google_Service_Calendar_Event([
        'summary' => $summary,
        'description' => $description,
        'start' => [
            'dateTime' => $startDateTime,
            'timeZone' => 'Europe/Amsterdam',
        ],
        'end' => [
            'dateTime' => $endDateTime,
            'timeZone' => 'Europe/Amsterdam',
        ],
    ]);

    $event = $service->events->insert($calendarId, $event);
    return $event->getId();
}


$calendarId = 'puppypoweracademy2025@gmail.com';

// Voorbeeld data (pas aan naar dynamische waarden)
$startDateTime = '2025-06-10T14:00:00'; // YYYY-MM-DDTHH:MM:SS formaat
$endDateTime = '2025-06-10T15:00:00';
$summary = 'Intakewandeling Puppy - Klantnaam: Jan Jansen';
$description = 'Intakewandeling geboekt via website na betaling.';

// Afspraak toevoegen
try {
    $eventId = addAppointmentToCalendar($service, $calendarId, $startDateTime, $endDateTime, $summary, $description);
    echo "Afspraak succesvol toegevoegd! Event ID: " . $eventId . PHP_EOL;
} catch (Exception $e) {
    echo 'Fout bij toevoegen afspraak: ',  $e->getMessage(), PHP_EOL;
}
