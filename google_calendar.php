<?php
require 'vendor/autoload.php';

// Zet hier het juiste pad naar jouw JSON bestand
putenv('GOOGLE_APPLICATION_CREDENTIALS=C:/Users/kadri/Desktop/puppyacademy-master/puppypower-461419-service-account.json');

$client = new Google_Client();
$client->useApplicationDefaultCredentials();
$client->addScope(Google_Service_Calendar::CALENDAR);

$service = new Google_Service_Calendar($client);

// Nu kun je bijvoorbeeld afspraken ophalen
$calendarId = 'puppypoweracademy2025@gmail.com';
$events = $service->events->listEvents($calendarId);

foreach ($events->getItems() as $event) {
    echo $event->getSummary() . "\n";
}
