<?php

namespace App\Http\Controllers;

use App\Models\Voyage;
use Illuminate\Http\Request

;class JourneyController extends Controller
{
    public function index()
    {
        // Récupérer les voyages marqués "en ligne"
        $voyages = Voyage::where('en_ligne', true)->get();

        // Retourner la vue avec les données
        return view('journeys.index', compact('voyages'));
    }
}
