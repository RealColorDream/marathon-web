<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voyage extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'resume',
        'description',
        'continent',
        'en_ligne',
        'visuel',
        'user_id',
    ];

    public $timestamps = false;

    /**
     * Relation avec l'utilisateur qui a créé le voyage.
     */
    public function editeur()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    /**
     * Relation avec les avis sur le voyage.
     */
    public function avis()
    {
        return $this->hasMany(Avis::class);
    }

    /**
     * Relation avec les utilisateurs qui ont aimé le voyage.
     */
    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes');
    }

    /**
     * Relation avec les étapes du voyage.
     */
    public function etapes()
    {
        return $this->hasMany(Etape::class, "voyage_id");
    }

    /**
     * Casting des colonnes.
     */
    protected $casts = [
        'en_ligne' => 'boolean',
    ];

    /**
     * Détermine si un voyage est visible par un utilisateur donné.
     *
     * @param int|null $userId
     * @return bool
     */
    public function isVisible($userId = null)
    {
        return $this->en_ligne || $this->user_id === $userId;
    }

    /**
     * Vérifie si le voyage est privé (non publié).
     *
     * @return bool
     */
    public function isPrive()
    {
        return !$this->en_ligne;
    }

    public function isLikedBy($user)
    {
        if (!$user) {
            return false;
        }

        return $this->likes()->where('user_id', $user->id)->exists();
    }
}
