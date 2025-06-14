<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Bevestiging Intakewandeling</title>
</head>
<body>
<h2>Bedankt voor je inschrijving, {{ $inschrijving['naam'] }}!</h2>

<p>Hierbij bevestigen wij jouw aanvraag voor een intakewandeling.</p>

<h3>Gegevens eigenaar:</h3>
<ul>
    <li><strong>Naam:</strong> {{ $inschrijving['naam'] }}</li>
    <li><strong>E-mailadres:</strong> {{ $inschrijving['email'] }}</li>
    <li><strong>Telefoon:</strong> {{ $inschrijving['phone'] }}</li>
</ul>

<h3>Gegevens hond:</h3>
<ul>
    <li><strong>Naam:</strong> {{ $inschrijving['naam_hond'] }}</li>
    <li><strong>Geboortedatum Hond:</strong> {{ \Carbon\Carbon::parse($inschrijving['geboortedatum'])->format('d/m/Y') }}</li>
    <!-- Foto van de hond weergegeven als base64 embedded image -->
    <li><strong>Ras:</strong> {{ $inschrijving['ras'] }}</li>
    <li><strong>Geslacht:</strong> {{ $inschrijving['geslacht'] }}</li>
    <li><strong>Foto van {{ $inschrijving['naam_hond'] }}:</strong><br>

        @php
            // Volledig pad naar de foto op de server
               $path = public_path($inschrijving['foto']);
                // Bestands extensie (bijv. jpg, png)
               $type = pathinfo($path, PATHINFO_EXTENSION);
               // Inhoud van het bestand ophalen
               $data = file_get_contents($path);
                // Data omzetten naar base64 voor inline afbeelding
               $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        @endphp
            <!-- Afbeelding met max breedte 200px en automatische hoogte -->
        <img src="{{ $base64 }}" alt="Foto van de hond" style="max-width:200px; height:auto;">
    </li>

</ul>

<p>De intakewandeling kost €10 en duurt ongeveer 30 minuten.</p>

<p>Plan nu je wandeling in via onze agenda: <a href="https://example.com/agenda">Klik hier om te plannen</a></p>

<p>Met vriendelijke groet,<br>
    Puppy Power Academy</p>
</body>
</html>
