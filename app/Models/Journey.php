<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Journey extends Model
{
    protected $fillable = ['title', 'description', 'image', 'continent', 'likes'];
}
