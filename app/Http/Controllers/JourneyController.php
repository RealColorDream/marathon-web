<?php

namespace App\Http\Controllers;

use App\Models\Journey;
use http\Client\Request;

class JourneyController extends Controller
{
    public function index(Request $request)
    {
        $query = Journey::query();

        if ($request->has('continent')) {
            $query->where('continent', $request->input('continent'));
        }

        $journeys = $query->orderBy('created_at', 'desc')->get();
        return view('journeys.index', compact('journeys'));
    }
}
