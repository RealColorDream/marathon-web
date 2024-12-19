@extends("templates.app")

@push('css profile')
    @vite(["resources/css/profil.css", "resources/css/app.css", "resources/js/app.js"])
@endpush
<title>Profil de {{ $user->name ?? "inconnu" }}</title>

@section("content")

    <section class="profile">
        <img src="{{ Vite::asset('resources/images/van.svg') }}" alt="van" class="van">
        <div class="app-profile">
            <!-- Messages de succès ou d'erreur -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Section utilisateur -->
            <h2 class="user-likes-title">Voyages likés : </h2>
            <div class="user-profile">
                <div class="user-details">
                    <h1>{{ $user->name }}</h1>
                    <p class="mail">{{ $user->email }}</p>
                </div>

                <!-- Section Avatar avec upload -->
                <div class="user-avatar-section">
                    <img
                        src="{{ $user->avatar ? asset('storage/' . $user->avatar) : Vite::asset('resources/images/default-avatar.png') }}"
                        alt="Avatar de {{ $user->name }}"
                        class="user-avatar">

                    <!-- Formulaire pour uploader l'avatar -->
                    <form action="{{ route('profile.update-avatar') }}" method="POST" enctype="multipart/form-data" class="avatar-form">
                        @csrf
                        @method('PUT')

                        <label for="avatar">Changer votre avatar :</label>
                        <input type="file" id="avatar" name="avatar" class="uk-input @error('avatar') uk-form-danger @enderror" accept="image/*">

                        @error('avatar')
                        <span class="uk-text-danger">{{ $message }}</span>
                        @enderror

                        <button type="submit" class="uk-button uk-button-primary">Mettre à jour</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Section Voyages likés -->
        <div class="voyage-likes">
            @if($user->likes->isEmpty())
                <p>Vous n'avez liké aucun voyage.</p>
            @else
                <div class="voyage-likes">
                    @foreach($user->likes as $voyage)
                        <div class="voyage-box">
                            <!-- Titre du voyage -->
                            <h3 class="voyage-title">{{ $voyage->titre }}</h3>

                            <!-- Image du voyage -->
                            <img src="{{ $voyage->visuel }}" alt="Visuel de {{ $voyage->titre }}">
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
