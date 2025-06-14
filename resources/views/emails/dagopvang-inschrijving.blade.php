<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Bevestiging Dagopvang Inschrijving</title>
</head>
<body>
<h1>Bevestiging Dagopvang Inschrijving</h1>
<!-- Aanspreking met de naam van de gebruiker -->
<p>Beste {{ $user->name }},</p>
<!-- Korte bevestigingstekst -->
<p>Je inschrijving voor de honden dagopvang is succesvol ontvangen!</p>
<!-- Overzicht van de ingevulde gegevens door de gebruiker -->
<h3>Inschrijvingsgegevens:</h3>
<ul>
    <li><strong>Naam van de hond:</strong> {{ $inschrijving['naam_hond'] }}</li>
    <li><strong>Soort hond:</strong> {{ $inschrijving['soort_hond'] }}</li>
    <li><strong>Roepnaam:</strong> {{ $inschrijving['roepnaam'] }}</li>
    <li><strong>Leeftijd:</strong> {{ $inschrijving['age'] }}</li>
    <li><strong>Adres en postcode:</strong> {{ $inschrijving['adres'] }}</li>
    <li><strong>Woonplaats:</strong> {{ $inschrijving['woonplaats'] }}</li>
    <li><strong>Telefoonnummer:</strong> {{ $inschrijving['telefoon'] }}</li>
    <li><strong>E-mailadres:</strong> {{ $inschrijving['email'] }}</li>
    <li><strong>Voorkeursdatum:</strong> {{ $inschrijving['voorkeursdatum'] }}</li>
</ul>

<p>Met vriendelijke groet,<br>Het Dagopvang Team</p>
</body>
</html>
