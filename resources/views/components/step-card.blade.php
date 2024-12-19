<div class="step-card">
    <h4>{{ $etape->titre }}</h4>
    <p><strong>Résumé :</strong> {{ $etape->resume }}</p>
    @if(!empty($etape->description))
        <div class="description-container uk-hidden" id="description-{{ $etape->id }}">
            <p><strong>Description :</strong> {{ $etape->description }}</p>
        </div>
        <button class="uk-button uk-button-default toggle-description" data-target="description-{{ $etape->id }}">
            Afficher la description
        </button>
    @endif
    <p><strong>Début :</strong> {{ $etape->debut }}</p>
    <p><strong>Fin :</strong> {{ $etape->fin }}</p>
</div>
