<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Nieuwe registratie voor training</title>
</head>
<body>
<h3>Nieuwe training registratie</h3>
<p>Er is een nieuwe inschrijving voor de training:</p>
<!-- Dynamische naam van de training, eerste letter wordt hoofdletter gemaakt -->
<h3>{{ ucfirst($training) }}. </h3>
<!-- Introductie van deelnemer gegevens -->
<p>Details van de deelnemer:</p>
<!-- Overzicht van belangrijke gegevens van de deelnemer -->
<ul>
    <li>Naam: {{ $name }}</li>
    <li>Email: {{ $email }}</li>
</ul>


<h3>Met vriendelijke groet,</h3>
<h3>Puppy Power Academy</h3>
</body>
</html>
