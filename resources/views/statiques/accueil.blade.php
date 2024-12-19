@extends('templates.app')

@push('css')
    @vite('resources/css/accueil.css')
@endpush


@section('title', 'Accueil')
<div class="scrolling-bg"></div>

@section('content')
    <div class="uk-container uk-margin-large-top truc">
        <div class="search-box">
            <form method="GET" action="{{ route('voyages.index') }}">
                <div class="search-container">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="search-input"
                        placeholder="Votre prochaine destination ?"
                    >
                    <button type="submit" class="search-button">
                        <i class='bx bx-search'></i>
                    </button>
                </div>
            </form>
        </div>

        <div class="search-container-space"></div>
    </div>

@endsection

<div class="road">
    <!--{{$i = 1}}-->
    @foreach($voyages as $voyage)
        <div class="accueil-voyage-card-container card-number-{{$i++}}">
            <a href="{{ route('voyages.show', $voyage->id) }}">
            <div class="accueil-voyage-card">
                <h3>{{$voyage->titre}}</h3>
                <img src="{{ $voyage->visuel }}" alt="{{ $voyage->titre }}">

                <div class="accueil-voyage-card-like">
                    @if(Auth::check())
                        <button class="like-button {{ $voyage->isLikedBy(Auth::user()) ? 'liked' : '' }}"
                                data-voyage-id="{{ $voyage->id }}">
                            @if($voyage->isLikedBy(Auth::user()))
                                <img src="{{ Vite::asset('resources/images/Heart plein.svg') }}" alt="Liked">
                                <span class="like-count">{{ $voyage->likes->count() }}</span>
                            @else
                                <img src="{{ Vite::asset('resources/images/Heart.svg') }}" alt="Not Liked">
                                <span class="like-count">{{ $voyage->likes->count() }}</span>
                            @endif
                        </button>
                    @else
                        {{-- Afficher un message ou désactiver le bouton si l'utilisateur n'est pas connecté --}}
                        <button class="like-button" disabled>
                            <img src="{{ Vite::asset('resources/images/Heart.svg') }}" alt="Not Liked">
                        </button>
                        <span class="like-count">{{ $voyage->likes->count() }}</span>
                    @endif
                </div>

            </div>
        </a>
        </div>
    @endforeach
</div>
