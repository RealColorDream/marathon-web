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
            <img alt="World map" src="{{ Vite::asset('resources/images/world-continents.png') }}" width="320" height="160" usemap="#world-continents">
            <map name="world-continents">
                <area alt="Amérique" title="Amérique" href="{{ route("voyages.continent") }}?c=Amérique" shape="poly" coords="48,89,67,69,77,49,140,0,68,0,6,10,4,31,16,69,48,88,61,74,119,99,95,160,66,159" data-continent="Amérique">
                <area alt="Europe" title="Europe" href="{{ route("voyages.continent") }}?c=Europe" shape="poly" coords="124,49,145,46,158,50,187,43,198,6,146,1,115,21" data-continent="Europe">
                <area alt="Afrique" title="Afrique" href="{{ route("voyages.continent") }}?c=Afrique" shape="poly" coords="121,53,140,47,169,51,186,77,196,80,188,137,156,136,138,97,118,86" data-continent="Afrique">
                <area alt="Asie" title="Asie" href="{{ route("voyages.continent") }}?c=Asie" shape="poly" coords="166,50,184,77,201,74,215,91,258,108,263,87,283,74,297,8,192,3,191,29,187,46,170,42" data-continent="Asie">
                <area alt="Océanie" title="Océanie" href="{{ route("voyages.continent") }}?c=Océanie" shape="poly" coords="257,107,263,85,314,89,316,137,294,151,249,132,248,114" data-continent="Océanie">
            </map>

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
