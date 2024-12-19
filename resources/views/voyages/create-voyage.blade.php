@extends('templates.app')
@push('css auth')
    @vite(["resources/css/auth.css", "resources/css/app.css", "resources/js/app.js"])
@endpush
@section('title', 'Créer un Voyage')

@section('content')
    <section class="register">
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

        <h1>Créer un voyage</h1>
        <div class="login-form">
            <form action="{{ route('voyages.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Titre --}}
                <div class="fields">
                    <label for="titre">Titre :</label>
                    <input class="uk-input" type="text" id="titre" name="titre" value="{{ old('titre') }}" required>
                </div>

                {{-- Description --}}
                <div class="fields">
                    <label for="description">Description :</label>
                    <textarea class="uk-textarea" id="description" name="description" required>{{ old('description') }}</textarea>
                </div>

                {{-- Résumé --}}
                <div class="fields">
                    <label for="resume">Résumé :</label>
                    <input class="uk-input" type="text" id="resume" name="resume" value="{{ old('resume') }}" required>
                </div>

                {{-- Continent --}}
                <div class="fields">
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
                <div class="fields">
                    <label for="visuel">Visuel :</label>
                    <input class="uk-input" type="file" id="visuel" name="visuel">
                </div>

                {{-- Bouton de soumission --}}
                <button class="uk-button uk-button-primary submitBtn" type="submit">Créer le voyage</button>
            </form>
        </div>
    </section>
@endsection
