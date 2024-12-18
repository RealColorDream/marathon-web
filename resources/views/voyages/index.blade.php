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
                    <x-voyage-card :voyage="$voyage"/>
                </div>
            @endforeach
        </div>
    </div>
@endsection
