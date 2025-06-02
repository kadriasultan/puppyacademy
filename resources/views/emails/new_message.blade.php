<!DOCTYPE html>
<html>
<head>
    <title>Nieuw Bericht</title>
</head>
<body>
<h2>Nieuw bericht ontvangen via het contactformulier van {{ $messageData->name }}</h2>

<p><strong>Naam:</strong> {{ $messageData->name }}</p>
<p><strong>Tel:</strong> {{ $messageData->phone }}</p>
<p><strong>Email:</strong> {{ $messageData->email }}</p>
<p><strong>Onderwerp:</strong>{{ $onderwerp}}</p>
<p><strong>Bericht:</strong></p>
<p>{{ $messageData->message }}</p>
</body>
</html>
