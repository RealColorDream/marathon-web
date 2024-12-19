<?php

namespace App\Http\Controllers;

use App\Models\Voyage;
use Illuminate\Http\Request;

class AvisController extends Controller
{
    public function store(Request $request, Voyage $voyage)
    {
        $request->validate([
            'contenu' => 'required|string|max:1000',
        ]);

        $avis = $voyage->avis()->create([
            'user_id' => auth()->id(),
            'contenu' => $request->contenu,
        ]);

        return response()->json([
            'id' => $avis->id,
            'contenu' => $avis->contenu,
            'user_name' => $avis->user->name,
            'created_at' => $avis->created_at->format('d/m/Y à H:i'),
        ]);
    }
}
