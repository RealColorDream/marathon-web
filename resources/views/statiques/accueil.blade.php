@extends('templates.app')

@push('css')
    @vite('resources/css/accueil.css')
@endpush


@section('title', 'Accueil')
<div class="scrolling-bg"><div class="scrolling-bg-image scrolling-bg-image1"></div><div class="scrolling-bg-image scrolling-bg-image2"></div></div>

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

