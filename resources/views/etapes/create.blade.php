@extends('templates.app')

@push('css auth')
    @vite(["resources/css/auth.css", "resources/css/app.css", "resources/js/app.js"])
@endpush
@section('title', 'Ajouter une étape')

@section('content')
    <section class="register">
        <h1 class="uk-heading-line"><span>Ajouter une étape</span></h1>
        <div class="login-form">
            <form action="{{ route('etapes.store', ['id' => $voyage->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="uk-margin fields">
                    <label for="titre">Titre :</label>
                    <input type="text" id="titre" name="titre" class="uk-input" required>
                </div>

                <div class="uk-margin fields">
                    <label for="resume">Résumé :</label>
                    <textarea id="resume" name="resume" class="uk-textarea" required></textarea>
                </div>

                <div class="uk-margin fields">
                    <label for="description">Description :</label>
                    <textarea id="description" name="description" class="uk-textarea"></textarea>
                </div>

                <div class="uk-margin fields">
                    <label for="debut">Date de début :</label>
                    <input type="date" id="debut" name="debut" class="uk-input" required>
                </div>

                <div class="uk-margin fields">
                    <label for="fin">Date de fin :</label>
                    <input type="date" id="fin" name="fin" class="uk-input" required>
                </div>

                <div class="uk-margin fields">
                    <label for="image">Image :</label>
                    <input type="file" id="image" name="image" class="uk-input" accept="image/*">
                </div>

                <button type="submit" class="uk-button uk-button-primary submitBtn">Créer l'étape</button>
            </form>
        </div>
    </section>
@endsection
