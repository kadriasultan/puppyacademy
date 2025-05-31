<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Bevestiging Intakewandeling</title>
</head>
<body>
<h2>Bedankt voor je inschrijving, {{ $data['naam'] }}!</h2>

<p>Hierbij bevestigen wij jouw aanvraag voor een intakewandeling.</p>

<h3>Gegevens eigenaar:</h3>
<ul>
    <li><strong>Naam:</strong> {{ $data['naam'] }}</li>
    <li><strong>E-mailadres:</strong> {{ $data['email'] }}</li>
    <li><strong>Telefoon:</strong> {{ $data['telefoon'] }}</li>
</ul>

<h3>Gegevens hond:</h3>
<ul>
    <li><strong>Naam:</strong> {{ $data['naam_hond'] }}</li>
    <li><strong>Geboortedatum:</strong> {{ $data['geboortedatum_hond'] }}</li>
    <li><strong>Ras:</strong> {{ $data['ras'] }}</li>
    <li><strong>Geslacht:</strong> {{ $data['geslacht'] }}</li>
</ul>

<p>De intakewandeling kost €10 en duurt ongeveer 30 minuten.</p>

<p>Plan nu je wandeling in via onze agenda: <a href="https://example.com/agenda">Klik hier om te plannen</a></p>

<p>Met vriendelijke groet,<br>
    Puppy Power Academy</p>
</body>
</html>
