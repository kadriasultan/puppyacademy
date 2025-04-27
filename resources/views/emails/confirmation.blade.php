<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Bevestiging van je contact</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        h1 {
            color: #333;
        }
        p {
            font-size: 1rem;
        }
        blockquote {
            margin: 20px 0;
            padding-left: 20px;
            border-left: 3px solid #007bff;
            font-style: italic;
        }
    </style>
</head>
<body>
<h1>Bedankt voor je bericht!</h1>
<p>
    Beste {{ $name }},<br>
</p>
<p>We hebben je bericht ontvangen en zullen zo snel mogelijk contact met je opnemen. Hieronder kun je je bericht nogmaals bekijken:</p>

<blockquote>
    <p>{{ $messageContent}}</p>
</blockquote>

<p>Met vriendelijke groet,</p>
<h2>Puppy Power Academy</h2>
<p>Tel: 0000000000</p>
</body>
</html>
