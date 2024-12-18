@extends('templates.app')

@section('title', $voyage->titre)

@section('content')
    <div class="uk-container uk-margin-large-top">
        <h1>{{ $voyage->titre }}</h1>
        <img src="{{ $voyage->visuel }}" alt="{{ $voyage->titre }}" class="uk-width-1-1 uk-margin-small-bottom">
        <p>{{ $voyage->description }}</p>
        <p><strong>Continent :</strong> {{ $voyage->continent }}</p>
        <p><strong>Nombre de likes :</strong> {{ $voyage->likes()->count() }}</p>

        <h2>Étapes du voyage</h2>
        <div class="uk-grid-match uk-grid-small" uk-grid>
            @foreach($voyage->etapes as $etape)
                @include('components.journey-card', ['item' => $etape])
            @endforeach
        </div>

        <h2>Avis des utilisateurs</h2>
        @foreach($voyage->avis as $avis)
            <p><strong>{{ $avis->user->name }}:</strong> {{ $avis->contenu }}</p>
        @endforeach
    </div>
@endsection
