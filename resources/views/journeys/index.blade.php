@extends('templates.app')

@section('title', 'Tous les Voyages')

    @section('content')
        <div class="container mx-auto">
            <h1 class="text-3xl font-bold">Explorez nos voyages</h1>
            <div class="grid grid-cols-3 gap-6 mt-6">
                @foreach ($journeys as $journey)
                    <x-journey-card :journey="$journey" />
                @endforeach
            </div>
        </div>
    @endsection
