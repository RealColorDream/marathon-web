<?php

namespace App\Http\Controllers;

use App\Models\Voyage;
use App\Models\Etape;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JourneyController extends Controller
{
    public function index()
    {
        // Récupérer les voyages marqués "en ligne"
        $voyages = Voyage::where('en_ligne', true)->get();

        // Retourner la vue avec les données
        return view('journeys.index', compact('voyages'));
    }

    public function show($id)
    {
        $voyage = Voyage::with(['etapes', 'avis', 'likes'])->findOrFail($id);

        // Vérifie si le voyage est activé ou si l'utilisateur est l'éditeur
        if (!$voyage->en_ligne && auth()->id() !== $voyage->user_id) {
            abort(403, 'Vous n\'avez pas accès à ce voyage.');
        }

        return view('journeys.show', compact('voyage'));
    }

    public function create()
    {
        return view('journeys.create');
    }

    public function store(Request $request)
    {
        // Valider les données
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'resume' => 'required|string',
            'continent' => 'required|string',
            'visuel' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'etape_titre' => 'required|array',
            'etape_titre.*' => 'required|string|max:255',
            'etape_description.*' => 'required|string',
            'etape_debut.*' => 'required|date',
            'etape_fin.*' => 'required|date|after:etape_debut.*',
        ]);

        // Gérer le fichier visuel
        $visuelPath = null;
        if ($request->hasFile('visuel')) {
            $visuelPath = $request->file('visuel')->store('voyages', 'public');
        }

        // Créer le voyage
        $voyage = Voyage::create([
            'titre' => $validated['titre'],
            'description' => $validated['description'],
            'resume' => $validated['resume'],
            'continent' => $validated['continent'],
            'user_id' => Auth::id(),
            'en_ligne' => true,
            'visuel' => $visuelPath ? asset('storage/' . $visuelPath) : null,
        ]);

        // Créer les étapes
        foreach ($validated['etape_titre'] as $index => $titre) {
            Etape::create([
                'titre' => $titre,
                'description' => $validated['etape_description'][$index],
                'debut' => $validated['etape_debut'][$index],
                'fin' => $validated['etape_fin'][$index],
                'voyage_id' => $voyage->id,
            ]);
        }

        return redirect()->route('voyages.show', $voyage->id)
            ->with('success', 'Voyage créé avec succès !');
    }
}
