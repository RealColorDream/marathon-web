<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? "Page en cours" }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- UIKit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/css/uikit.min.css"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Vite Resources -->
    @section("head")
        @vite(["resources/css/normalize.css", "resources/css/app.css", "resources/js/app.js"])
    @show
    @stack('css auth')
</head>
<body>

<x-navbar/>


<main>
    @yield("content")
</main>

<footer>
    <p>IUT de Lens</p>
</footer>
@stack('css voyage')
</body>
</html>
