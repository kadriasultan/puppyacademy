<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Puppy Academy')</title>
    <link rel="icon" href="{{ asset('images/l.jpeg') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    <style>
        /* Loading spinner styles */
        .loading-spinner {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.7); /* Transparent background */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999; /* Ensure the spinner appears on top of other content */
            visibility: visible; /* Show by default */
        }

        /* Footprint container styles */
        .footprints-container {
            position: fixed;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
            display: flex;
            z-index: 9998; /* Below the loading spinner */
            width: 100%; /* Full width to allow footprints to span across the screen */
        }

        /* Footprint image */
        .footprint {
            width: 40px;
            height: 40px;
            background-image: url('{{ asset('images/dog-icon.png') }}');
            background-size: cover;
            position: absolute;
            align-content: first baseline;
            opacity: 0;
            animation: step 3s linear infinite; /* Increased duration to move across the screen */
        }

        /* Animation for the footprints */
        @keyframes step {
            0% {
                transform: translateX(0) scale(1);
                opacity: 0.1;
            }
            10% {
                transform: translateX(100px) scale(1.1);
                opacity: 0.2;
            }
            20% {
                transform: translateX(200px) scale(1.2);
                opacity: 0.3;
            }
            30% {
                transform: translateX(300px) scale(1.3);
                opacity: 0.5;
            }
            40% {
                transform: translateX(400px) scale(1.4);
                opacity: 0.6;
            }
            50% {
                transform: translateX(500px) scale(1.5);
                opacity: 0.7;
            }
            60% {
                transform: translateX(600px) scale(1.4);
                opacity: 0.8;
            }
            70% {
                transform: translateX(700px) scale(1.3);
                opacity: 0.8;
            }
            80% {
                transform: translateX(800px) scale(1.2);
                opacity: 0.2;
            }
            90% {
                transform: translateX(900px) scale(1.1);
                opacity: 0.9;
            }
            100% {
                transform: translateX(1240px) scale(1);
                opacity: 1;
            }
        }

        /* Additional footprint animation delay to simulate walking step by step */
        .footprint:nth-child(1) { animation-delay: 0s; }
        .footprint:nth-child(2) { animation-delay: 1s; }
        .footprint:nth-child(3) { animation-delay: 1.8s; }
        .footprint:nth-child(4) { animation-delay: 2.2s; }
        .footprint:nth-child(5) { animation-delay: 3s; }
        .footprint:nth-child(6) { animation-delay: 4s; }
    </style>
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
