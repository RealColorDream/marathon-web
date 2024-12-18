@extends('templates.app')

@section('title', $voyage->titre)

@section('content')
    <div class="uk-container uk-margin-large-top">
        <h1 class="uk-heading-line"><span>{{ $voyage->titre }}</span></h1>

        @if($voyage->visuel)
            <img src="{{ $voyage->visuel }}" alt="{{ $voyage->titre }}" class="uk-width-1-1 uk-margin-bottom">
        @endif

        <p>{{ $voyage->description }}</p>
        <p><strong>Résumé :</strong> {{ $voyage->resume }}</p>
        <p><strong>Continent :</strong> {{ $voyage->continent }}</p>

        @if(Auth::id() === $voyage->user_id && !$voyage->en_ligne)
            <form action="{{ route('voyages.activate', $voyage->id) }}" method="POST">
                @csrf
                <button type="submit" class="uk-button uk-button-primary">Activer ce voyage</button>
            </form>
        @endif

        @if($voyage->etapes->count())
            <h2 class="uk-heading-line"><span>Étapes</span></h2>
            <ul class="uk-list uk-list-divider">
                @foreach($voyage->etapes as $etape)
                    <li>
                        <strong>{{ $etape->titre }}</strong> ({{ $etape->debut }} - {{ $etape->fin }})
                        <p>{{ $etape->description }}</p>
                    </li>
                @endforeach
            </ul>
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
