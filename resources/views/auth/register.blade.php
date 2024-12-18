@extends("templates.app")
@push('css auth')
    @vite(["resources/css/auth.css", "resources/css/app.css", "resources/js/app.js"])
@endpush
@section('content')
    <section class="register">
        <h1>S'enregistrer</h1>
        <div class="login-form">
            <div>
                <box-icon name='user'></box-icon>
                <p class="connection-title">Créer mon compte</p>
            </div>
            <hr/>
            <form action="{{route("register")}}" method="post">
                @csrf
                <div class="fields">
                    <label for="name">Nom d'utilisateur</label>
                    <input type="text" name="name" required placeholder="Name"/>
                </div>
                <div class="fields">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" required placeholder="Email"/>
                </div>
                <div class="fields">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" required placeholder="password"/>
                </div>
                <div class="fields">
                    <label for="password_confirmation">Vérification mot de passe</label>
                    <input type="password" name="password_confirmation" required placeholder="password"/>
                </div>
                <input type="submit" value="Valider" class="submitBtn"/>
                <div class="alrdLog">
                    <span>Déjà un compte ?</span>
                    <a href="{{route("login")}}">Connectez vous</a>
                </div>
            </form>
        </div>
@endsection
