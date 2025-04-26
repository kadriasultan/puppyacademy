<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Puppy Academy')</title>
    <link rel="icon" href="{{ asset('images/l.jpeg') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>

<!-- Loading Spinner -->
<div id="loading-spinner" class="loading-spinner">
    <div class="footprints-container">
        <div class="footprint"></div>
        <div class="footprint"></div>
        <div class="footprint"></div>
        <div class="footprint"></div>
        <div class="footprint"></div>
        <div class="footprint"></div>
    </div>
</div>

@include('partials.header')

<div>
    @yield('content')
</div>

@include('partials.footer')

@stack('scripts')

<script>
    // Hide the loading spinner after the page has fully loaded
    window.addEventListener('load', function () {
        document.getElementById('loading-spinner').style.visibility = 'hidden';
    });

    // Optional: Show the spinner if the page is taking too long to load
    window.addEventListener('beforeunload', function () {
        document.getElementById('loading-spinner').style.visibility = 'visible';
    });
</script>

</body>
</html>
