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
    <img src="images/paw.png" alt="Loading..." class="spinner-image">
</div>


@include('partials.header')

<div>
    @yield('content')
</div>

@include('partials.footer')

@stack('scripts')
</body>
<script>
    window.addEventListener('load', function () {
        const spinner = document.getElementById('loading-spinner');
        spinner.style.transition = 'opacity 0.5s ease';
        spinner.style.opacity = '0'; // fade-out na laden
        setTimeout(() => {
            spinner.style.display = 'none'; // verbergen na fade-out
        }, 500); // tijd moet gelijk zijn aan transition (0.5s)
    });
</script>


</html>
