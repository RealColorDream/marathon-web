@extends('templates.app')

@section('title', $voyage->titre)

@push('css voyage')
    @vite('resources/css/voyage.css')
@endpush

@section('content')
    <div class="uk-container uk-margin-large-top">
        <h1 class="uk-heading-line"><span>{{ $voyage->titre }}</span></h1>


        <p class="voyage-resume"><strong>Résumé :</strong> {{ $voyage->resume }}</p>
        <p class="voyage-description">{{ $voyage->description }}</p>

        @if(Auth::id() === $voyage->user_id && !$voyage->en_ligne)
            <form action="{{ route('voyages.activate', $voyage->id) }}" method="POST">
                @csrf
                <button type="submit" class="uk-button uk-button-primary">Activer ce voyage</button>
            </form>
        @endif

        @if($voyage->etapes->count())
                <div id="voyage-etapes-box">
                    <ul class="etapes-list">
                @foreach($voyage->etapes as $etape)
                    <li>
                        <strong><a href ="{{route("etapes.show", ['id' => $etape->id])}}">{{ $etape->titre }}</a></strong>
                    </li>
                @endforeach
                    </ul>
                </div>

            <!-- Bouton pour démarrer le voyage -->
        @endif

        @if(Auth::id() === $voyage->user_id)
            <a href="{{ route('etapes.create', $voyage->id) }}" class="uk-button uk-button-secondary uk-margin-top">
                Ajouter une étape
            </a>
        @endif

        @if($voyage->visuel)
            <br/>
            <img src="{{ $voyage->visuel }}" alt="{{ $voyage->titre }}" class="voyage-img uk-margin-bottom uk-margin-top">
        @endif

        <h2 class="uk-heading-line"><span>Avis et Likes</span></h2>
        <p><strong>Nombre de likes :</strong> {{ $voyage->likes->count() }}</p>

        @if($voyage->avis->count())
            <ul class="uk-list uk-list-divider">
                @foreach($voyage->avis as $avis)
                    <li>
                        <p><strong>{{ $avis->user->name }}</strong> : {{ $avis->commentaire }}</p>
                        <p><small>Posté le {{ $avis->created_at }}</small></p>
                    </li>
                @endforeach
            </ul>
        @else
            <p>Aucun avis pour ce voyage.</p>
        @endif
    </div>
@endsection
