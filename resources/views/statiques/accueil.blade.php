@extends('templates.app')

@push('css voyage')
    @vite('resources/css/voyage.css')
@endpush


@section('title', 'Accueil')

@section('content')
    <div class="uk-container uk-margin-large-top">
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

