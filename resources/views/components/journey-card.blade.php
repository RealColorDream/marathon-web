<div class="uk-card uk-card-default uk-card-body uk-margin-small">
    <h3 class="uk-card-title">{{ $item->titre }}</h3>
    <p>{{ $item->description }}</p>

    @if(isset($item->visuel))
        <img src="{{ $item->visuel }}" alt="{{ $item->titre }}" class="uk-width-1-1">
    @endif

    @if(isset($likes))
        <p><strong>Nombre de likes :</strong> {{ $likes }}</p>
    @endif

    @if(isset($item->resume))
        <p><strong>Résumé :</strong> {{ $item->resume }}</p>
    @endif
</div>
