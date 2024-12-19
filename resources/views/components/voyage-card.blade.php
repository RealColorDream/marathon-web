@props([
    /** @var \mixed */
    'voyage'
])

<div {{ $attributes->class(['uk-card uk-card-default uk-card-hover uk-card-body']) }}>
    <h2>{{$voyage->titre}}</h2>
    <img src="{{ $voyage->visuel }}" alt="{{ $voyage->titre }}">
    {{--<p>{{ $voyage->resume }}</p> <!-- Résumé supprimé -->--}}
    <p><strong>Continent : </strong>{{ $voyage->continent }}</p>
    <a href="{{ route('voyages.show', $voyage->id) }}" class="uk-button uk-button-primary">Voir le voyage</a>
</div>
