@extends('templates.app')

@section('title', 'Créer un Voyage')

@section('content')
    <div class="uk-container uk-margin-large-top">
        {{-- Messages d'erreur --}}
        @if($errors->any())
            <div class="uk-alert-danger" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h1 class="uk-heading-line"><span>Créer un Voyage</span></h1>

        <form action="{{ route('voyages.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Titre --}}
            <div class="uk-margin">
                <label for="titre">Titre :</label>
                <input class="uk-input" type="text" id="titre" name="titre" value="{{ old('titre') }}" required>
            </div>

            {{-- Description --}}
            <div class="uk-margin">
                <label for="description">Description :</label>
                <textarea class="uk-textarea" id="description" name="description" required>{{ old('description') }}</textarea>
            </div>

            {{-- Résumé --}}
            <div class="uk-margin">
                <label for="resume">Résumé :</label>
                <input class="uk-input" type="text" id="resume" name="resume" value="{{ old('resume') }}" required>
            </div>

            {{-- Continent --}}
            <div class="uk-margin">
                <label for="continent">Continent :</label>
                <select class="uk-select" id="continent" name="continent" required>
                    <option value="Europe" {{ old('continent') == 'Europe' ? 'selected' : '' }}>Europe</option>
                    <option value="Asie" {{ old('continent') == 'Asie' ? 'selected' : '' }}>Asie</option>
                    <option value="Afrique" {{ old('continent') == 'Afrique' ? 'selected' : '' }}>Afrique</option>
                    <option value="Amérique" {{ old('continent') == 'Amérique' ? 'selected' : '' }}>Amérique</option>
                    <option value="Océanie" {{ old('continent') == 'Océanie' ? 'selected' : '' }}>Océanie</option>
                </select>
            </div>

            {{-- Visuel --}}
            <div class="uk-margin">
                <label for="visuel">Visuel :</label>
                <input class="uk-input" type="file" id="visuel" name="visuel">
            </div>

            {{-- Bouton de soumission --}}
            <button class="uk-button uk-button-primary" type="submit">Créer le voyage</button>
        </form>
    </div>
@endsection
