<form action="{{ route('voyages.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="titre">Titre :</label>
    <input type="text" name="titre" id="titre" required>

    <label for="description">Description :</label>
    <textarea name="description" id="description" required></textarea>

    <label for="resume">Résumé :</label>
    <textarea name="resume" id="resume" required></textarea>

    <label for="continent">Continent :</label>
    <select name="continent" id="continent">
        <option value="Europe">Europe</option>
        <option value="Asie">Asie</option>
        <option value="Afrique">Afrique</option>
        <option value="Amérique">Amérique</option>
        <option value="Océanie">Océanie</option>
    </select>

    <label for="visuel">Visuel :</label>
    <input type="file" name="visuel" id="visuel" accept="image/*">

    <h3>Étapes :</h3>
    <div id="steps-container">
        <div class="step">
            <label for="etape_titre_0">Titre :</label>
            <input type="text" name="etape_titre[]" required>

            <label for="etape_description_0">Description :</label>
            <textarea name="etape_description[]" required></textarea>

            <label for="etape_debut_0">Début :</label>
            <input type="date" name="etape_debut[]" required>

            <label for="etape_fin_0">Fin :</label>
            <input type="date" name="etape_fin[]" required>
        </div>
    </div>
    <button type="button" onclick="addStep()">Ajouter une étape</button>

    <button type="submit">Créer le voyage</button>
</form>

<script>
    function addStep() {
        const container = document.getElementById('steps-container');
        const step = container.querySelector('.step').cloneNode(true);
        container.appendChild(step);
    }
</script>
