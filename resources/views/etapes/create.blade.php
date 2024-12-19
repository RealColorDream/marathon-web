@extends('templates.app')

@section('title', 'Ajouter une étape')

@section('content')
    <div class="uk-container uk-margin-large-top">
        <h1 class="uk-heading-line"><span>Ajouter une étape</span></h1>
        <form action="{{ route('etapes.store', ['id' => $voyage->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="uk-margin">
                <label for="titre">Titre :</label>
                <input type="text" id="titre" name="titre" class="uk-input" required>
            </div>

            <div class="uk-margin">
                <label for="resume">Résumé :</label>
                <textarea id="resume" name="resume" class="uk-textarea" required></textarea>
            </div>

            <div class="uk-margin">
                <label for="description">Description :</label>
                <textarea id="description" name="description" class="uk-textarea"></textarea>
            </div>

            <div class="uk-margin">
                <label for="debut">Date de début :</label>
                <input type="date" id="debut" name="debut" class="uk-input" required>
            </div>

            <div class="uk-margin">
                <label for="fin">Date de fin :</label>
                <input type="date" id="fin" name="fin" class="uk-input" required>
            </div>

            <div class="uk-margin">
                <label for="image">Image :</label>
                <input type="file" id="image" name="image" class="uk-input" accept="image/*">
            </div>

            <button type="submit" class="uk-button uk-button-primary">Créer l'étape</button>
        </form>
    </div>
@endsection
