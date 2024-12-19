@extends('templates.app')

@section('title', $voyage->titre)

@push('css voyage')
    @vite('resources/css/voyage.css')
@endpush

@section('content')
    <div class="uk-container uk-margin-large-top">
        <h1 class="uk-heading-line"><span>{{ $voyage->titre }}</span></h1>

        @if($voyage->visuel)
            <img src="{{ asset('storage/' . $voyage->visuel) }}" alt="{{ $voyage->titre }}" class="uk-width-1-1 uk-margin-bottom voyage-img">
        @endif

        <p class="voyage-description">{{ $voyage->description }}</p>
        <p class="voyage-resume"><strong>Résumé :</strong> {{ $voyage->resume }}</p>
        <p><strong>Continent :</strong> {{ $voyage->continent }}</p>

        @if($voyage->etapes->count())
            <h2 class="uk-heading-line"><span>Étapes</span></h2>
            <ul class="uk-list uk-list-divider etapes-list">
                @foreach($voyage->etapes as $etape)
                    <li>
                        @include('components.step-card', ['etape' => $etape])
                    </li>
                @endforeach
            </ul>

            <!-- Bouton pour démarrer le voyage -->
            <a href="{{ route('etapes.show', $voyage->etapes->first()->id) }}" class="uk-button uk-button-primary uk-margin-top">
                Démarrer le voyage
            </a>
        @endif

        @if(Auth::id() === $voyage->user_id)
            <a href="{{ route('etapes.create', $voyage->id) }}" class="uk-button uk-button-secondary uk-margin-top">
                Ajouter une étape
            </a>
        @endif

        <h2 class="uk-heading-line"><span>Avis et Likes</span></h2>
        <p><strong>Nombre de likes :</strong> {{ $voyage->likes->count() }}</p>

        <ul id="comments-list" class="uk-list uk-list-divider">
            @if($voyage->avis->count())
                @foreach($voyage->avis as $avis)
                    <li id="avis-{{ $avis->id }}">
                        <p><strong>{{ $avis->user->name }}</strong> : {{ $avis->contenu }}</p>
                        <p><small>Posté le {{ $avis->created_at->format('d/m/Y à H:i') }}</small></p>
                    </li>
                @endforeach
            @else
                <li id="no-comments">Aucun avis pour ce voyage.</li>
            @endif
        </ul>

        <!-- Formulaire pour ajouter un commentaire -->
        @auth
            <h3 class="uk-heading-line"><span>Ajouter un avis</span></h3>
            <form id="comment-form" class="uk-form-stacked uk-margin-top">
                @csrf
                <div class="uk-margin">
                    <label class="uk-form-label" for="contenu">Votre commentaire :</label>
                    <div class="uk-form-controls">
                        <textarea class="uk-textarea" id="contenu" name="contenu" rows="5" placeholder="Écrivez votre avis ici..." required></textarea>
                    </div>
                </div>
                <button type="submit" class="uk-button uk-button-primary">Publier</button>
            </form>
        @else
            <p><a href="{{ route('login') }}" class="uk-link-text">Connectez-vous</a> pour laisser un commentaire.</p>
        @endauth
    </div>

    <script>
        document.getElementById('comment-form').addEventListener('submit', function(e) {
            e.preventDefault(); // Empêche le rechargement de la page

            const contenu = document.getElementById('contenu').value;
            const token = document.querySelector('input[name="_token"]').value;

            fetch("{{ route('avis.store', $voyage->id) }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                },
                body: JSON.stringify({ contenu: contenu }),
            })
                .then(response => {
                    if (response.ok) return response.json();
                    throw new Error('Erreur lors de la soumission du commentaire.');
                })
                .then(data => {
                    const commentList = document.getElementById('comments-list');
                    const noComments = document.getElementById('no-comments');

                    // Supprime le message "Aucun avis pour ce voyage" s'il est affiché
                    if (noComments) {
                        noComments.remove();
                    }

                    // Ajouter dynamiquement le commentaire au DOM
                    const newComment = `
                    <li id="avis-${data.id}">
                        <p><strong>${data.user_name}</strong> : ${data.contenu}</p>
                        <p><small>Posté le ${data.created_at}</small></p>
                    </li>
                `;
                    commentList.innerHTML += newComment;

                    // Réinitialiser le formulaire
                    document.getElementById('contenu').value = '';
                })
                .catch(error => console.error(error));
        });

        document.addEventListener('DOMContentLoaded', () => {
            const buttons = document.querySelectorAll('.toggle-description');
            buttons.forEach(button => {
                button.addEventListener('click', () => {
                    const targetId = button.getAttribute('data-target');
                    const description = document.getElementById(targetId);

                    if (description.classList.contains('uk-hidden')) {
                        description.classList.remove('uk-hidden');
                        button.textContent = 'Masquer la description';
                    } else {
                        description.classList.add('uk-hidden');
                        button.textContent = 'Afficher la description';
                    }
                });
            });
        });
    </script>
@endsection
