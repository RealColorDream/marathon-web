@extends("templates.app")

@section('content')
<section class="register">
    <h2 class="connection-title">Créer mon compte</h2>
    <div class="login-form">
        <i class='bx bx-user'></i>
    <form action="{{route("register")}}" method="post">
        @csrf
        <div>
            <label for="name">Nom d'utilisateur</label>
            <input type="text" name="name" required placeholder="Name" />
        </div>
        <div>
            <label for="email">E-mail</label>
            <input type="email" name="email" required placeholder="Email" />
        </div>
        <div>
            <label for="password">Mot de passe</label>
            <input type="password" name="password" required placeholder="password" />
        </div>
        <div>
            <label for="password_confirmation">Vérification mot de passe</label>
            <input type="password" name="password_confirmation" required placeholder="password" />
        </div>
        <input type="submit" value="Valider"/>
    </form>
    Déjà un compte ? <a href="{{route("login")}}">Connectez vous</a>
    </div>
</section>
@endsection
