@extends("templates.app")

@section("head")
    @parent
    <title>Erreur 404</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Redacted+Script:wght@400">
    @vite(["resources/css/normalize.css", 'resources/css/app.css', 'resources/js/app.js'])
@endsection

@section("content")
<main>
    <div style="font-size: larger;">Error 404 - SVP, Stylisez moi !!</div>
</main>
@endsection
