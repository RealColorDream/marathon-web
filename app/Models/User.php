<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Les attributs qui peuvent être attribués en masse.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar', // Ajout de l'attribut avatar
    ];

    /**
     * Les attributs à masquer pour la sérialisation.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Les attributs à caster.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relation avec les voyages créés par l'utilisateur.
     */
    public function mesVoyages()
    {
        return $this->hasMany(Voyage::class, "user_id");
    }

    /**
     * Relation avec les avis laissés par l'utilisateur.
     */
    public function avis()
    {
        return $this->hasMany(Avis::class, "user_id");
    }

    /**
     * Relation avec les voyages que l'utilisateur a aimés.
     */
    public function likes()
    {
        return $this->belongsToMany(Voyage::class, 'likes');
    }

    /**
     * Récupère les voyages non publiés de l'utilisateur.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function voyagesNonPublies()
    {
        return $this->mesVoyages()->where('en_ligne', false)->get();
    }
}
