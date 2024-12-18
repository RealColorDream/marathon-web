<?php

namespace App\Http\Controllers;

use App\Models\Voyage;
use App\Models\Etape;
use App\Repositories\IVoyageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoyageController extends Controller
{
    public function __construct(private IVoyageRepository $voyageRepository)
    {
    }

    public function index()
    {
        // Récupérer les voyages marqués "en ligne"
        $voyages = $this->voyageRepository->all(true);

        // Retourner la vue avec les données
        return view('voyages.index', compact('voyages'));
    }

    public function show($id)
    {
        // Ensure $id is an integer
        $voyage = $this->voyageRepository->find((int) $id);

        // Vérifie si le voyage est activé ou si l'utilisateur est l'éditeur
        if (!$voyage->en_ligne && auth()->id() !== $voyage->user_id) {
            abort(403, 'Vous n\'avez pas accès à ce voyage.');
        }

        return view('voyages.show', compact('voyage'));
    }

    public function create()
    {
        return view('voyages.create-voyage');
    }

    public function store(Request $request)
    {
        // Valider les données principales
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
            'etape_fin.*' => 'required|date',
        ]);

        // Validation des dates dynamiques (fin > début)
        foreach ($validated['etape_debut'] as $index => $debut) {
            if (strtotime($validated['etape_fin'][$index]) <= strtotime($debut)) {
                return back()->withErrors([
                    'etape_fin.' . $index => 'La date de fin doit être après la date de début pour l\'étape ' . ($index + 1),
                ])->withInput();
            }
        }

        // Gérer le fichier visuel
        $visuelPath = null;
        if ($request->hasFile('visuel')) {
            $visuelPath = $request->file('visuel')->store('voyages', 'public');
        }

        // Créer le voyage
        $voyage = $this->voyageRepository->create([
            'titre' => $validated['titre'],
            'description' => $validated['description'],
            'resume' => $validated['resume'],
            'continent' => $validated['continent'],
            'user_id' => Auth::id(),
            'en_ligne' => true,
            'visuel' => $visuelPath ? asset('storage/' . $visuelPath) : null,
        ]);

        // Créer les étapes associées
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
