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
        @if(Auth::check())
            <button class="like-button {{ $voyage->isLikedBy(Auth::user()) ? 'liked' : '' }}"
                    data-voyage-id="{{ $voyage->id }}">
                @if($voyage->isLikedBy(Auth::user()))
                    <img src="{{ Vite::asset('resources/images/Heart plein.svg') }}" alt="Liked">
                @else
                    <img src="{{ Vite::asset('resources/images/Heart.svg') }}" alt="Not Liked">
                @endif
            </button>
        @else
            {{-- Afficher un message ou désactiver le bouton si l'utilisateur n'est pas connecté --}}
            <button class="like-button" disabled>
                <img src="{{ Vite::asset('resources/images/Heart.svg') }}" alt="Not Liked">
            </button>
        @endif
        <span class="like-count">{{ $voyage->likes->count() }}</span>
        @if(!Auth::check())
            <span class="uk-text-muted">Connectez-vous pour aimer ce voyage.</span>
        @endif
    </div>
</div>
