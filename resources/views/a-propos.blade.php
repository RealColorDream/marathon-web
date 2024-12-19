@extends('templates.app')

@push('css about')
    @vite(["resources/css/about.css", "resources/css/app.css", "resources/js/app.js"])
@endpush
@section('content')
    <section id="about" class="uk-container uk-margin-large-top uk-margin-large-bottom">
        <h1 class="uk-heading-line uk-text-center">À propos</h1>
        <div class="uk-grid uk-grid-match uk-child-width-1-2@m uk-flex-middle" uk-grid>
            <!-- Texte -->
            <div>
                <p>
                    Bienvenue sur notre plateforme de voyages ! Nous vous proposons une sélection des meilleurs itinéraires,
                    des destinations incroyables et des aventures inoubliables. Explorez, découvrez et partagez des expériences uniques.
                </p>
                <p>
                    Que vous soyez un voyageur expérimenté ou débutant, nous avons ce qu'il vous faut. Parcourez nos voyages et trouvez l'inspiration pour vos prochaines aventures.
                </p>
            </div>

            <!-- Vidéo -->
            <div>
                <iframe src="https://youtu.be/eW1f9H1HAFA" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen class="uk-width-1-1" style="height: 300px;">
                </iframe>
            </div>
        </div>
    </section>
@endsection
