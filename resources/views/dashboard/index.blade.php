@extends("templates.app")

@section("head")
    <!-- j'insère ce qu'il y a dans la section initial (c'est pas obligatoire) -->
    <!-- j'ajoute d'autres styles/js... -->
    @parent
    <title>Profil de {{ $user->name ?? "inconnu" }}</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Redacted+Script:wght@400">
    @vite(['resources/css/profil.css', 'resources/js/app.js'])
@endsection

@section("content")
    <div class="app-profile">
        <div class="user-profile">
            <img src="{{ $user->avatar }}" alt="Avatar de {{ $user->name }}" class="user-avatar">
            <div class="user-details">
                <h1>{{ $user->name }}</h1>
                <p>{{ $user->email }}</p>
            </div>
        </div>

        <p>Text supplémentaire à ajouter plus tard..</p>

        <p>Voyages likés : </p>
    </div>
@endsection
