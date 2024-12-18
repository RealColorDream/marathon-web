<?php

namespace App\Http\Controllers;

use App\Models\Etape;
use App\Models\Media;
use App\Repositories\IEtapeRepository;
use Illuminate\Http\Request;

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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     Route::delete('/etape/{id}', [EtapeController::class, 'destroy'])->name('etape.destroy');
    public function store(Request $request)
    {
        //
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

        return redirect()->route('etape.index');
    }
}
