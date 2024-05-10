<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rapport extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'user_id',
        'tache_id',
        'projet_id',
        'date_debut',
        'date_fin',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tache()
    {
        return $this->belongsTo(Tache::class);
    }

    public function projet()
    {
        return $this->belongsTo(Projet::class);
    }

}
