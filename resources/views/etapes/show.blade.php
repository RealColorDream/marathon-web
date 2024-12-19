@extends('templates.app')

@push('css show-etape')
    @vite('resources/css/show-etape.css')
@endpush

@section('title', $etape->titre)

@section('content')
    <div class="uk-container uk-margin-large-top">
        <h1 class="uk-heading-line"><span>{{ $etape->titre }}</span></h1>

        <div class="uk-grid-small uk-child-width-1-2@s uk-child-width-1-3@m start" uk-grid>
            <div>
                <div class="uk-card uk-card-default uk-card-hover uk-card-body">
                    @if($etape->image)
                        <img src="{{ Storage::url($etape->image) }}" alt="Image de l'étape"
                             class="uk-width-1-1 uk-margin-small-bottom">
                    @endif

                    @foreach ($medias as $media)
                        <img src="{{ $media->url }}" alt="Media de {{ $etape->titre }}"
                             class="uk-width-1-1 uk-margin-small-bottom">
                    @endforeach

                    <h3 class="uk-card-title">{{ $etape->titre }}</h3>
                    <p>{{ $etape->description }}</p>
                </div>
            </div>
        </div>

        <div class="uk-margin-top">
            <p><strong>Début :</strong> {{ $etape->debut }}</p>
            <p><strong>Fin :</strong> {{ $etape->fin }}</p>
        </div>

        @php
            // Recherche de l'étape suivante
            $nextEtape = $etape->voyage->etapes->where('id', '>', $etape->id)->first();
        @endphp

        @if($nextEtape)
            <a href="{{ route('etapes.show', $nextEtape->id) }}" class="uk-button uk-button-primary uk-margin-top">
                Étape suivante : {{ $nextEtape->titre }}
            </a>
        @else
            <p class="uk-text-meta uk-margin-top">Vous avez terminé toutes les étapes du voyage !</p>
        @endif
    </div>
@endsection
