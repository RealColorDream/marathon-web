@extends("templates.app")

@section('content')
    <h2 class="connection-title">Mon compte</h2>
    <div class="login-form">
        <img src="" alt="Image utilisateur"/>
        <h3>Je me connecte</h3>
        <hr/>
        <form action="{{route("login")}}" method="post">
            @csrf
            <label for="email">E-mail</label>
            <input type="email" name="email" required placeholder="Email"/><br/>
            <label for="password">Mot de passe</label>
            <input type="password" name="password" required placeholder="password"/><br/>
            Remember me<input type="checkbox" name="remember"/><br/>
            <input type="submit" value="Valider"/><br/>
        </form>
        Pas de compte ? <a href="{{route("register")}}">Créer un nouveau compte</a>
    </div>
@endsection
