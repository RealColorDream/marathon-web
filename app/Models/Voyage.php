<?php

namespace App\Models;

use App\Repositories\IVoyageRepository;
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

    public function editeur()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function avis()
    {
        return $this->hasMany(Avis::class);
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes');
    }

    public function etapes()
    {
        return $this->hasMany(Etape::class, "voyage_id");
    }

    protected $casts = [
        'en_ligne' => 'boolean',
    ];

    public function isVisible($userId = null)
    {
        return $this->en_ligne || $this->user_id === $userId;
    }
}
