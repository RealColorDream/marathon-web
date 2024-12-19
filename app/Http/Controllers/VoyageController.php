<?php

namespace App\Http\Controllers;

use App\Models\Voyage;
use App\Models\Etape;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoyageController extends Controller
{
    public function index()
    {
        // Si l'utilisateur est connecté
        if (Auth::check()) {
            $voyagesPrives = Voyage::where('user_id', Auth::id())
                ->where('en_ligne', false)
                ->get(); // Voyages non publiés

            $voyagesPublics = Voyage::where('en_ligne', true)->get(); // Voyages publics
        } else {
            // Seulement les voyages publics pour les visiteurs
            $voyagesPublics = Voyage::where('en_ligne', true)->get();
            $voyagesPrives = collect(); // Collection vide
        }

        return view('voyages.index', compact('voyagesPublics', 'voyagesPrives'));
    }

    public function show($id)
    {
        // Vérifier que le voyage existe et que l'utilisateur a le droit d'y accéder
        $voyage = Voyage::findOrFail((int) $id);

        if (!$voyage->en_ligne && Auth::id() !== $voyage->user_id) {
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
        // Validation des données du formulaire
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'resume' => 'required|string',
            'continent' => 'required|string',
            'visuel' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Gestion du visuel
        $visuelPath = null;
        if ($request->hasFile('visuel')) {
            $visuelPath = $request->file('visuel')->store('voyages', 'public');
        }

        // Création du voyage
        Voyage::create([
            'titre' => $validated['titre'],
            'description' => $validated['description'],
            'resume' => $validated['resume'],
            'continent' => $validated['continent'],
            'user_id' => Auth::id(),
            'en_ligne' => false, // Non publié par défaut
            'visuel' => $visuelPath ? asset('storage/' . $visuelPath) : null,
        ]);

        // Redirection avec message de confirmation
        return redirect()->route('voyages.index')->with('success', 'Voyage créé avec succès ! Il est actuellement désactivé.');
    }

    public function activate($id)
    {
        // Récupération du voyage
        $voyage = Voyage::findOrFail($id);

        // Vérification des droits d'accès
        if (Auth::id() !== $voyage->user_id) {
            abort(403, 'Vous n\'avez pas l\'autorisation d\'activer ce voyage.');
        }

        // Activation du voyage
        $voyage->update(['en_ligne' => true]);

        return redirect()->route('voyages.index')->with('success', 'Voyage activé avec succès !');
    }

    public function continent(Request $request)
    {
        $continent = $request->query('c', 'Europe'); // Continent par défaut : Europe
        $voyages = Voyage::where('continent', $continent)->get();

        $continents = ["Afrique", "Amérique", "Asie", "Europe", "Océanie"];

        return view('voyages.continent', compact('voyages', 'continent', 'continents'));
    }

    public function toggleLike(Request $request, Voyage $voyage)
    {
        $user = $request->user();

        if ($voyage->isLikedBy($user)) {
            $voyage->likes()->detach($user->id);
            $isLiked = false;
        } else {
            $voyage->likes()->attach($user->id);
            $isLiked = true;
        }

        return response()->json([
            'is_liked' => $isLiked,
            'likes_count' => $voyage->likes()->count(),
        ]);
    }
}

