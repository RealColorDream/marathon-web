<?php

namespace App\Http\Controllers;

use App\Models\Etape;
use App\Models\Media;
use App\Models\Voyage;
use App\Repositories\EtapeRepository;
use App\Repositories\IEtapeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EtapeController extends Controller
{

    public function __construct(private IEtapeRepository $etapeRepository)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $etape = $this->etapeRepository->all();
        return view('etapes.index', ['etapes' => $etape]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $voyage = Voyage::findOrFail($id); // Récupère le voyage par son ID
        return view('etapes.create', compact('voyage'));
    }

    public function store(Request $request, int $id, EtapeRepository $etapeRepository)
    {
        $data = $request->validate([
            'titre' => 'required|string|max:255',
            'resume' => 'required|string|max:500',
            'description' => 'nullable|string',
            'debut' => 'required|date',
            'fin' => 'required|date|after:debut', // Validation stricte pour que "fin" soit après "debut"
            'image' => 'nullable|image|max:2048',
        ]);

        // Validation supplémentaire pour des cas spécifiques
        if (strtotime($data['debut']) >= strtotime($data['fin'])) {
            return back()
                ->withErrors(['debut' => 'La date de début doit être antérieure à la date de fin.'])
                ->withInput();
        }

        // Ajout de l'ID du voyage dans les données
        $data['voyage_id'] = $id;

        // Gestion de l'upload de l'image
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images/etapes', 'public');
            $data['image'] = $path;
        }

        // Création de l'étape
        $etape = $etapeRepository->create($data);

        return redirect()->route('voyages.index')->with('success', 'Étape créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id_etape)
    {

        $etape = $this->etapeRepository->find($id_etape);
        $medias = $etape->medias;

        return view('etapes.show', ['etape' => $etape, 'medias' => $medias]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id_etape)
    {
        $etape = $this->etapeRepository->find($id_etape);
        return view('etapes.edit', ['etape' => $etape]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id_etape)
    {
        $etape = $this->etapeRepository->find($id_etape);
        $etape->titre = $request->input('titre');
        $etape->resume = $request->input('resume');
        $etape->save();

        return redirect()->route('etape.show', ['id' => $etape->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id_etape)
    {
        $etape = $this->etapeRepository->find($id_etape);
        $etape->delete();

        return redirect()->route('etapes.index');
    }
}
