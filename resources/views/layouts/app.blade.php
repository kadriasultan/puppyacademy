<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Puppy Academy')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>
@include('partials.header')

<div >
    @yield('content')
</div>
@include('partials.footer')
@stack('scripts')
</body>
</html>
