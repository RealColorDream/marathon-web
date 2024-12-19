<nav {{ $attributes }}>
    <ul>

        <li><a href="{{ route('accueil') }}"><img id="logo" src="{{ Vite::asset('resources/images/logo.svg') }}" alt="logo"></a></li>
        <li><a href="{{ route('voyages.index') }}">Voyages</a></li>
        <!--<form action="{{ route('voyages.index') }}" method="GET" class="uk-search uk-search-default">
            <div class="uk-search-icon-flip" uk-search-icon>
                <input class="uk-search-input" type="search" name="search" placeholder="Search...">
                <button class="uk-search-icon-flip" type="submit" uk-search-icon>Recherche</button>
            </div>
        </form>-->
        @auth
            <li><a href="{{ route('dashboard') }}">{{ Auth::user()->name }}</a></li>
            <li>
                <a href="{{ route('logout') }}" onclick="document.getElementById('logout').submit(); return false;">
                    Logout
                </a>
                <form id="logout" action="{{ route('logout') }}" method="post" style="display: none;">
                    @csrf
                </form>
            </li>
        @else
            <li><a class="navbar-button" href="{{ route('login') }}"> <i class='bx bx-user'></i> Connexion</a></li>
        @endauth
    </ul>
</nav>
