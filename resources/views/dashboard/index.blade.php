@extends("templates.app")

@push('css profile')
    @vite(["resources/css/profil.css", "resources/css/app.css", "resources/js/app.js", "/ressources/images/van.svg"])
@endpush
<title>Profil de {{ $user->name ?? "inconnu" }}</title>

@section("content")

<section class="profile">
    <img src="{{Vite::asset('resources/images/van.svg')}}" alt="van" class="van">
    <div class="app-profile">
        <h2 class="user-likes-title">Voyages likés : </h2>
        <div class="user-profile">
            <div class="user-details">
                <h1>{{ $user->name }}</h1>
                <p>{{ $user->email }}</p>
            </div>
            <img src="{{ $user->avatar }}" alt="Avatar de {{ $user->name }}" class="user-avatar">
        </div>
    </div>
    <div class="voyage-likes">

        @if($user->likes->isEmpty())
            <p>Vous n'avez liké aucun voyage.</p>
        @else
            <div class="voyage-likes">
                @foreach($user->likes as $voyage)
                    <div class="voyage-box">
                        <!-- Image du voyage -->
                        <img src="{{ $voyage->visuel }}" alt="Visuel de {{ $voyage->titre }}">

                        <!-- Titre du voyage -->
                        <h3>{{ $voyage->titre }}</h3>

                        <!-- Résumé -->
                        <p>{{ $voyage->resume }}</p>

                        <!-- Auteur du voyage -->
                        <small>Édité par : {{ $voyage->editeur->name }}</small>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection
