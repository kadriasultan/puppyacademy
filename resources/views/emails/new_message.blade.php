<!DOCTYPE html>
<html>
<head>
    <title>Nieuw Bericht</title>
</head>
<body>
<h1>Nieuw bericht ontvangen via het contactformulier van {{ $messageData->name }}</h1>

<p><strong>Naam:</strong> {{ $messageData->name }}</p>
<p><strong>Email:</strong> {{ $messageData->email }}</p>
<p><strong>Bericht:</strong></p>
<p>{{ $messageData->message }}</p>
</body>
</html>
