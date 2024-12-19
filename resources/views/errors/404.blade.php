@extends("templates.app")
@push('css 404')
    @vite(["resources/css/404.css", "resources/css/app.css", "resources/js/app.js"])
@endpush
@section('content')
    <div class="container">
        <img id="img404" src="{{ Vite::asset('resources/images/404.svg') }}" alt="logo">
        <h1>Erreur 404</h1>
        <p>On dirait que vous avez quitté la route...</p>
    </div>
@endsection
