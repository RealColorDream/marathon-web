@extends('templates.app')

@push('css voyage')
    @vite('resources/css/voyage.css')
@endpush


@section('title', 'Accueil')

@section('content')
    <div class="uk-container uk-margin-large-top">
        <div class="search-box">
            <div class="search-container">
                <input type="text" class="search-input" placeholder="Votre prochaine destination ?">
                <button class="search-button">
                    <i class='bx bx-search'></i>
                </button>
            </div>
            <div class="search-container-space"></div>
            </div>

        <div class="uk-grid-small uk-child-width-1-2@s uk-child-width-1-3@m" uk-grid>

        </div>
    </div>
@endsection

