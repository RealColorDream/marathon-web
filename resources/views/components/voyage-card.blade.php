@props([
    /** @var \mixed */
    'voyage'
])

<div {{ $attributes->class(['uk-card uk-card-default uk-card-hover uk-card-body']) }}>
    <img src="{{ $voyage->visuel }}" alt="{{ $voyage->titre }}">
    <h3 class="uk-card-title">{{ $voyage->titre }}</h3>
    <p>{{ $voyage->resume }}</p>
    <p><strong>Continent : </strong>{{ $voyage->continent }}</p>
    <a href="{{ route('voyages.show', $voyage->id) }}" class="uk-button uk-button-primary">Voir le voyage</a>
</div>
