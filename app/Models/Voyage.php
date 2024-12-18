<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voyage extends Model {
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'titre', 'description', 'resume', 'continent', 'user_id', 'en_ligne', 'visuel'
    ];

    public function editeur() {
        return $this->belongsTo(User::class, "user_id");
    }

    public function avis() {
        return $this->hasMany(Avis::class);
    }

    public function likes() {
        return $this->belongsToMany(User::class, 'likes');
    }

    public function etapes() {
        return $this->hasMany(Etape::class, "voyage_id");
    }
    public function casts() {
        return [
            'en_ligne' => 'boolean',
        ];
    }

    public function isVisible($userId = null)
    {
        return $this->en_ligne || $this->user_id === $userId;
    }

}
