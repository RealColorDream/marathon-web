@extends('templates.app')

@section('title', 'Créer un voyage')

@section('content')
    <div class="uk-container uk-margin-large-top">
        <h1 class="uk-heading-line"><span>Créer un nouveau voyage</span></h1>

        <form action="{{ route('voyages.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="uk-margin">
                <label for="titre">Titre :</label>
                <input class="uk-input" type="text" id="titre" name="titre" required>
            </div>

            <div class="uk-margin">
                <label for="description">Description :</label>
                <textarea class="uk-textarea" id="description" name="description" required></textarea>
            </div>

            <div class="uk-margin">
                <label for="resume">Résumé :</label>
                <input class="uk-input" type="text" id="resume" name="resume" required>
            </div>

            <div class="uk-margin">
                <label for="continent">Continent :</label>
                <select class="uk-select" id="continent" name="continent" required>
                    <option value="Europe">Europe</option>
                    <option value="Asie">Asie</option>
                    <option value="Afrique">Afrique</option>
                    <option value="Amérique">Amérique</option>
                    <option value="Océanie">Océanie</option>
                </select>
            </div>

            <div class="uk-margin">
                <label for="visuel">Visuel :</label>
                <input class="uk-input" type="file" id="visuel" name="visuel">
            </div>

            <button class="uk-button uk-button-primary" type="submit">Créer</button>
        </form>
    </div>
@endsection
