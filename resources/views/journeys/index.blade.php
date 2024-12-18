@extends('templates.app')

@section('title', 'Accueil')

@section('content')
    <div class="uk-container uk-margin-large-top">
        <h1 class="uk-heading-line"><span>Nos Voyages</span></h1>

        @if(Auth::check())
            <a href="{{ route('voyages.create') }}" class="uk-button uk-button-primary uk-margin-bottom">Créer un voyage</a>
        @endif

        <div class="uk-grid-small uk-child-width-1-2@s uk-child-width-1-3@m" uk-grid>
            @foreach($voyages as $voyage)
                <div>
                    <div class="uk-card uk-card-default uk-card-hover uk-card-body">
                        <img src="{{ $voyage->visuel }}" alt="{{ $voyage->titre }}" class="uk-width-1-1 uk-margin-small-bottom">
                        <h3 class="uk-card-title">{{ $voyage->titre }}</h3>
                        <p>{{ $voyage->resume }}</p>
                        <p><strong>Continent : </strong>{{ $voyage->continent }}</p>
                        <a href="{{ route('voyages.show', $voyage->id) }}" class="uk-button uk-button-primary">Voir le voyage</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
