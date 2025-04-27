<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Nieuwe registratie voor training</title>
</head>
<body>
<h1>Nieuwe training registratie</h1>
<p>Er is een nieuwe inschrijving voor de training: <h3>{{ ucfirst($training) }}.</h3></p>
<p>Details van de deelnemer:</p>
<ul>
    <li>Naam: {{ $name }}</li>
    <li>Email: {{ $email }}</li>
</ul>


<h3>Met vriendelijke groet,</h3>
<h3>Puppy Power Academy</h3>
</body>
</html>
