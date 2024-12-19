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
            console.log('DOM fully loaded and parsed');
            document.querySelectorAll('.like-button').forEach(button => {
                button.addEventListener('click', async (event) => {
                    const button = event.currentTarget;
                    const voyageId = button.getAttribute('data-voyage-id');
                    console.log('Button clicked for voyage ID:', voyageId);

                    try {
                        const response = await fetch(`/voyages/${voyageId}/like`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            },
                        });

                        console.log('Response status:', response.status);

                        if (response.ok) {
                            const contentType = response.headers.get('Content-Type');
                            if (contentType && contentType.includes('application/json')) {
                                const data = await response.json();
                                console.log('Response data:', data);

                                // Update the like count
                                const likeCountElement = button.nextElementSibling;
                                likeCountElement.textContent = data.likes_count;

                                // Update the button state (emoji and class)
                                button.textContent = data.is_liked ? '❤' : '🖤️';
                                button.classList.toggle('liked', data.is_liked);
                            } else {
                                console.error('Unexpected content type:', contentType);
                            }
                        } else {
                            console.error('Error processing the request', response);
                        }
                    } catch (error) {
                        console.error('Network or JavaScript error', error);
                    }
                });
            });
        });
    </script>
@endpush
