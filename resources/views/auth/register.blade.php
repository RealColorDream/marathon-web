@extends("templates.app")

@section('content')
<h2 class="connection-title">Créer mon compte</h2>
<div class="login-form">
    <img src="" alt="Image utilisateur"/>
    <h3>Je me crée un compte</h3>
    <hr/>
<form action="{{route("register")}}" method="post">
    @csrf
    <label for="name">Nom d'utilisateur</label>
    <input type="text" name="name" required placeholder="Name" /><br />
    <label for="email">E-mail</label>
    <input type="email" name="email" required placeholder="Email" /><br />
    <label for="password">Mot de passe</label>
    <input type="password" name="password" required placeholder="password" /><br />
    <label for="password_confirmation">Vérification mot de passe</label>
    <input type="password" name="password_confirmation" required placeholder="password" /><br />
    <input type="submit" value="Valider"/><br />
</form>
Déjà un compte ? <a href="{{route("login")}}">Connectez vous</a>
</div>
@endsection
