<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Puppy Academy')</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

</head>
<body>
<div class="container">
    @yield('content')
</div>
</body>
</html>
