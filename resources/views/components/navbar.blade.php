<nav {{ $attributes }}>
    <ul>
        <li><a href="{{ route('accueil') }}"><img id="logo" src="{{ Vite::asset('resources/images/logo.svg') }}" alt="logo"></a></li>
        <li><a href="{{ route('a-propos') }}">À propos</a></li>
        <li><a href="{{ route('voyages.index') }}">Voyages</a></li>
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
