@extends('templates.app')

@section('title', 'Accueil')

@section('content')
    <div class="uk-container uk-margin-large-top">
        <h1 class="uk-heading-line"><span>Etapes</span></h1>

        <div class="uk-grid-small uk-child-width-1-2@s uk-child-width-1-3@m" uk-grid>
            @foreach($etapes as $etape)
                <div>
                    <div class="uk-card uk-card-default uk-card-hover uk-card-body">
                        @foreach ($etape->medias as $media)
                        <img src="{{ $media->url }}" alt="{{ $etape->titre }}" class="uk-width-1-1 uk-margin-small-bottom">
                        @endforeach
                        <h3 class="uk-card-title">{{ $etape->titre }}</h3>
                        <a href="{{ route('etape.show', $etape->id) }}" class="uk-button uk-button-primary">Voir le etape</a>
                        <p>{{$etape->resume}}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
