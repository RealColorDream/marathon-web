@extends('templates.app')

@section('title', 'Accueil')

@section('content')
    <div class="uk-container uk-margin-large-top">
        <h1 class="uk-heading-line"><span>Etapes</span></h1>

        <div class="uk-grid-small uk-child-width-1-2@s uk-child-width-1-3@m" uk-grid>
            <div>
                <div class="uk-card uk-card-default uk-card-hover uk-card-body">
                    <img src="{{ Storage::url($etape->image) }}" alt="Image de l'étape" class="uk-width-1-1 uk-margin-small-bottom">
                    @foreach ($medias as $media)
                        <img src="{{ $media->url }}" alt="{{ $etape->titre }}"
                             class="uk-width-1-1 uk-margin-small-bottom">
                    @endforeach
                    <h3 class="uk-card-title">{{ $etape->titre }}</h3>
                    <p>{{ $etape->description }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
