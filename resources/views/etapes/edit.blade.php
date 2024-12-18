@extends('templates.app')

@section('title', 'Edit Etape')

@section('content')
    <div class="uk-container uk-margin-large-top">
        <h1 class="uk-heading-line"><span>Etapes</span></h1>

        <div class="uk-grid-small uk-child-width-1-2@s uk-child-width-1-3@m" uk-grid>
            <div>
                <div class="uk-card uk-card-default uk-card-hover uk-card-body">
                    <form action="{{ route('etape.update', $etape->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="uk-margin">
                            <label for="titre" class="uk-form-label">Titre</label>
                            <input id="titre" name="titre" type="text" class="uk-input" value="{{ $etape->titre }}"
                                   required>
                        </div>
                        <div class="uk-margin">
                            <label for="resume" class="uk-form-label">Résumé</label>
                            <textarea id="resume" name="resume" class="uk-textarea" rows="5"
                                      required>{{ $etape->resume }}</textarea>
                        </div>
                        <div class="uk-margin">
                            <button type="submit" class="uk-button uk-button-primary">Mettre à jour</button>
                        </div>
                    </form>
                </div>
            </div>
@endsection
