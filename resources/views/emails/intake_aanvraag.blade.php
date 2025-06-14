<!DOCTYPE html>
<html>
<head>
    <title>Nieuwe Intake Wandeling Aanvraag</title>
</head>
<body>
<h2>Nieuwe Intake Wandeling Aanvraag</h2>

<h3>Eigenaar Gegevens</h3>
<p><strong>Naam:</strong> {{ $data['naam'] }}</p>
<p><strong>Email:</strong> {{ $data['email'] }}</p>
<p><strong>Telefoon:</strong> {{ $data['telefoon'] }}</p>

<h3>Hond Gegevens</h3>
<p><strong>Naam hond:</strong> {{ $data['naam_hond'] }}</p>
<p><strong>Geboortedatum:</strong> {{ $data['geboortedatum_hond'] }}</p>
<p><strong>Ras:</strong> {{ $data['ras'] }}</p>
<p><strong>Geslacht:</strong> {{ $data['geslacht'] }}</p>

@if(isset($data['foto_path']))
    <p>De foto van de hond is bijgevoegd aan deze email.</p>
@endif
</body>
</html>
