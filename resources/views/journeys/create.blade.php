@extends('templates.app')

@section('title', 'Créer un voyage')

@section('content')
    <div class="uk-container uk-margin-large-top">
        <h1>Créer un voyage</h1>
        <form action="{{ route('journeys.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Informations générales sur le voyage -->
            <div class="uk-margin">
                <label for="titre" class="uk-form-label">Titre</label>
                <input type="text" id="titre" name="titre" class="uk-input" required>
            </div>

            <div class="uk-margin">
                <label for="description" class="uk-form-label">Description</label>
                <textarea id="description" name="description" class="uk-textarea" required></textarea>
            </div>

            <div class="uk-margin">
                <label for="resume" class="uk-form-label">Résumé</label>
                <textarea id="resume" name="resume" class="uk-textarea" required></textarea>
            </div>

            <div class="uk-margin">
                <label for="continent" class="uk-form-label">Continent</label>
                <select id="continent" name="continent" class="uk-select">
                    <option value="Europe">Europe</option>
                    <option value="Asie">Asie</option>
                    <option value="Afrique">Afrique</option>
                    <option value="Amérique">Amérique</option>
                    <option value="Océanie">Océanie</option>
                </select>
            </div>

            <div class="uk-margin">
                <label for="visuel" class="uk-form-label">Visuel</label>
                <input type="file" id="visuel" name="visuel" class="uk-input">
            </div>

            <!-- Étapes -->
            <h2>Étapes du voyage</h2>
            <div id="etapes-container">
                <div class="etape uk-margin">
                    <h3>Étape 1</h3>
                    <label for="etape_titre[]" class="uk-form-label">Titre</label>
                    <input type="text" name="etape_titre[]" class="uk-input" required>

                    <label for="etape_description[]" class="uk-form-label">Description</label>
                    <textarea name="etape_description[]" class="uk-textarea" required></textarea>

                    <label for="etape_debut[]" class="uk-form-label">Date de début</label>
                    <input type="datetime-local" name="etape_debut[]" class="uk-input" required>

                    <label for="etape_fin[]" class="uk-form-label">Date de fin</label>
                    <input type="datetime-local" name="etape_fin[]" class="uk-input" required>
                </div>
            </div>
            <button type="button" id="add-etape" class="uk-button uk-button-secondary">Ajouter une étape</button>

            <div class="uk-margin">
                <button type="submit" class="uk-button uk-button-primary">Créer le voyage</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('add-etape').addEventListener('click', () => {
            const container = document.getElementById('etapes-container');
            const count = container.children.length + 1;
            const etape = document.createElement('div');
            etape.classList.add('etape', 'uk-margin');
            etape.innerHTML = `
            <h3>Étape ${count}</h3>
            <label for="etape_titre[]" class="uk-form-label">Titre</label>
            <input type="text" name="etape_titre[]" class="uk-input" required>

            <label for="etape_description[]" class="uk-form-label">Description</label>
            <textarea name="etape_description[]" class="uk-textarea" required></textarea>

            <label for="etape_debut[]" class="uk-form-label">Date de début</label>
            <input type="datetime-local" name="etape_debut[]" class="uk-input" required>

            <label for="etape_fin[]" class="uk-form-label">Date de fin</label>
            <input type="datetime-local" name="etape_fin[]" class="uk-input" required>
        `;
            container.appendChild(etape);
        });
    </script>
@endsection
