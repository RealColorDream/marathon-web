<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? "Page en cours" }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- UIKit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/css/uikit.min.css" />

    <!-- Vite Resources -->
    @section("head")
        @vite(["resources/css/normalize.css", "resources/css/app.css", "resources/js/app.js"])
    @show
</head>
<body>
<header>
    <h1>Ma super application</h1>
</header>
<nav>
    <ul>
        <li><a href="{{ route('accueil') }}">Accueil</a></li>
        <li><a href="{{ route('test-vite') }}">Test Vite</a></li>
        <li><a href="{{ route('contact') }}">Contact</a></li>

        @auth
            <li>{{ Auth::user()->name }}</li>
            <li>
                <a href="{{ route('logout') }}" onclick="document.getElementById('logout').submit(); return false;">
                    Logout
                </a>
                <form id="logout" action="{{ route('logout') }}" method="post" style="display: none;">
                    @csrf
                </form>
            </li>
        @else
            <li><a href="{{ route('login') }}">Login</a></li>
            <li><a href="{{ route('register') }}">Register</a></li>
        @endauth
    </ul>
</nav>

<main>
    @yield("content")
</main>

<footer>
    <p>IUT de Lens</p>
</footer>

</body>
</html>
