@extends("templates.app")

@section("head")
    <!-- j'insère ce qu'il y a dans la section initial (c'est pas obligatoire) -->
    <!-- j'ajoute d'autres styles/js... -->
    @parent
    <title>Voyages par continent</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Redacted+Script:wght@400">
    @vite(['resources/css/profil.css', 'resources/js/app.js', 'resources/css/continent.css'])
@endsection

@section("content")
    <div class="container">
        <h1>Voyages par continent</h1>

        <!-- Dropdown pour choisir le continent -->
        <div class="dropdown">
            <form method="GET" action="{{ route('voyages.continent') }}">
                <label for="continent">Choisissez un continent :</label>
                <select name="c" id="continent" onchange="this.form.submit()">
                    <option value="">-- Tous les continents --</option>
                    @foreach($continents as $item)
                        <option value="{{ $item }}" {{ $continent === $item ? 'selected' : '' }}>
                            {{ $item }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>

        <!-- Liste des voyages -->
        @if($voyages->isEmpty())
            <p>Aucun voyage trouvé pour ce continent.</p>
        @else
            @foreach($voyages as $voyage)
                <div class="voyage-card">
                    <img src="{{ $voyage->visuel }}" alt="Image de {{ $voyage->titre }}">
                    <div class="voyage-details">
                        <h3>{{ $voyage->titre }}</h3>
                        <p>{{ $voyage->resume }}</p>
                        <small>Continent : {{ $voyage->continent }}</small>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
