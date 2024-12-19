<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Afficher la page de profil de l'utilisateur.
     */
    public function showProfile()
    {
        return view('profile.show', ['user' => Auth::user()]);
    }

    /**
     * Mettre à jour la photo de profil.
     */
    public function updateAvatar(Request $request)
    {
        // Validation de l'image
        $request->validate([
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = Auth::user();

        if ($request->hasFile('avatar')) {
            // Supprimer l'ancien avatar si existant
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Sauvegarder le nouvel avatar
            $path = $request->file('avatar')->store('avatars', 'public');

            // Mettre à jour l'utilisateur
            $user->update(['avatar' => $path]);
        }

        return redirect()->back()->with('success', 'Avatar mis à jour avec succès.');
    }
}
