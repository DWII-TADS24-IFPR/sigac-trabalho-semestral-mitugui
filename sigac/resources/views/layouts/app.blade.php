<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/js/app.js'])
    <title>@yield('title', 'Sigac')</title>
</head>
<body>
    @include('layouts.navbar')
    <div class="container">
        @yield('content')
    </div>
    <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>
</body>
</html>