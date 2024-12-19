@extends('templates.app')

@push('css voyage')
    @vite('resources/css/voyage.css')
@endpush

@section('title', 'Accueil')

@section('content')
    <div class="uk-container uk-margin-large-top">
        {{-- Message de succès/erreurs --}}
        @if(session('success'))
            <div class="uk-alert-success" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <p>{{ session('success') }}</p>
            </div>
        @endif
        @if(session('error'))
            <div class="uk-alert-danger" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <p>{{ session('error') }}</p>
            </div>
        @endif

        {{-- Section des voyages publics --}}
        <h1><span>Nos Voyages Publics</span></h1>
        <div>
            <div class="grid-voyage">
                @forelse($voyagesPublics as $voyage)
                    <div>
                        <x-voyage-card :voyage="$voyage"/>

                        {{-- Bouton de like --}}
                        <div class="like-toggle">
                            <button class="like-button {{ $voyage->likedByUser() ? 'liked' : '' }}"
                                    data-voyage-id="{{ $voyage->id }}">
                                ❤️
                            </button>
                            <span class="like-count">{{ $voyage->likes->count() }}</span>
                        </div>
                    </div>
                @empty
                    <p>Aucun voyage public disponible pour le moment.</p>
                @endforelse
            </div>

            {{-- Section des voyages non publiés (privés) --}}
            @if(Auth::check())
                <h2 class="uk-heading-line uk-margin-top"><span>Vos Voyages Non Publiés</span></h2>
                <a href="{{ route('voyages.create') }}" class="uk-button uk-button-primary uk-margin-bottom">
                    Créer un voyage
                </a>

                <div class="uk-grid-small uk-child-width-1-2@s uk-child-width-1-3@m" uk-grid>
                    @forelse($voyagesPrives as $voyage)
                        <div>
                            <x-voyage-card :voyage="$voyage"/>

                            {{-- Bouton de like --}}
                            <div class="like-toggle">
                                <button class="like-button {{ $voyage->likedByUser() ? 'liked' : '' }}"
                                        data-voyage-id="{{ $voyage->id }}">
                                    ❤️
                                </button>
                                <span class="like-count">{{ $voyage->likes->count() }}</span>
                            </div>

                            {{-- Formulaire d'activation --}}
                            <form action="{{ route('voyages.activate', $voyage->id) }}" method="POST"
                                  class="uk-margin-top">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="uk-button uk-button-secondary uk-width-1-1">
                                    Activer
                                </button>
                            </form>
                        </div>
                    @empty
                        <p>Vous n'avez pas de voyages non publiés pour le moment.</p>
                    @endforelse
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const likeButtons = document.querySelectorAll('.like-button');

            likeButtons.forEach(button => {
                button.addEventListener('click', async (e) => {
                    const voyageId = button.getAttribute('data-voyage-id');

                    try {
                        const response = await fetch(`/voyages/${voyageId}/like`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json',
                            },
                        });

                        if (response.ok) {
                            const data = await response.json();

                            // Mise à jour du bouton et du compteur
                            button.classList.toggle('liked', data.liked);
                            const likeCount = button.nextElementSibling;
                            likeCount.textContent = data.likes_count;
                        }
                    } catch (error) {
                        console.error('Erreur lors du traitement du like :', error);
                    }
                });
            });
        });
    </script>
@endpush
