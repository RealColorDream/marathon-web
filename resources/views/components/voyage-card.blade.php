@props([
    /** @var \mixed */
    'voyage'
])

<div {{ $attributes->class(['uk-card uk-card-default uk-card-hover uk-card-body']) }}>
    <h2>{{ $voyage->titre }}</h2>
    <img src="{{ $voyage->visuel }}" alt="{{ $voyage->titre }}">
    {{--<p>{{ $voyage->resume }}</p> <!-- Résumé supprimé -->--}}
    <p><strong>Continent : </strong>{{ $voyage->continent }}</p>
    <a href="{{ route('voyages.show', $voyage->id) }}" class="uk-button uk-button-primary">Voir le voyage</a>

    {{-- Bouton de like --}}
    <div class="like-toggle">
        <button class="like-button {{ $voyage->isLikedBy(Auth::user()) ? 'liked' : '' }}"
                data-voyage-id="{{ $voyage->id }}">
            @if($voyage->isLikedBy(Auth::user()))
                <img src="{{ Vite::asset('resources/images/Heart plein.svg') }}" alt="Liked">
            @else
                <img src="{{ Vite::asset('resources/images/Heart.svg') }}" alt="Not Liked">
            @endif
        </button>
        <span class="like-count">{{ $voyage->likes->count() }}</span>
    </div>
</div>
