@extends("templates.app")
@push('css auth')
    @vite(["resources/css/auth.css", "resources/css/app.css", "resources/js/app.js"])
@endpush
@section('content')
<section class="register">
    <h1>Me connecter</h1>
    <div class="login-form">
        <div>
            <box-icon name='user'></box-icon>
            <p class="connection-title">Créer mon compte</p>
        </div>
        <hr/>
        <form action="{{route("login")}}" method="post">
            @csrf
            <div class="fields">
                <label for="email">E-mail</label>
                <input type="email" name="email" required placeholder="Email"/>
            </div>
            <div class="fields">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" required placeholder="password"/>
            </div>
            <div class="remember">
                <span>Remember me</span>
                <input type="checkbox" name="remember"/>
            </div>
            <input type="submit" value="Valider" class="submitBtn"/><br/>
        </form>
        <div class="alrdLog">
            <span>Pas de compte ?</span> 
            <a href="{{route("register")}}">Créer un nouveau compte</a>
        </div>
    </div>
    </section>
@endsection
