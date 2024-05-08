<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'date_debut',
        'date_fin',
        'projet_id',
        'assigned_to',
        'status',
        'priority',
    ];

    public function projet()
    {
        return $this->belongsTo(Projet::class);
    }

    public function user()
    {

        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function comments()
    {
        return $this->hasMany(Commentaire::class);
    }
}
