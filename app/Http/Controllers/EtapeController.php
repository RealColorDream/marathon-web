<?php

namespace App\Http\Controllers;

use App\Models\Etape;
use App\Models\Media;
use Illuminate\Http\Request;

class EtapeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $etape = Etape::all();
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
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id_etape)
    {

        $etape = Etape::find($id_etape);
        $medias = $etape->medias;

        return view('etapes.show', ['etape' => $etape, 'medias' => $medias]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id_etape)
    {
        $etape = Etape::find($id_etape);
        return view('etapes.edit', ['etape' => $etape]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EtapeController $etape)
    {
        return redirect()->route('etape.show', ['id_etape' => $etape->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EtapeController $etape)
    {
        //
    }
}
