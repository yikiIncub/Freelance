<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postulant extends Model
{
    use HasFactory;
    protected $fillable = [
        'projet_id',
        'user_id',
        'description',
        'budget',
        'delai',
        'disponibilite',
        'temps_realisation'
    ];
    public function user(){
        return $this->belongsToMany(User::class);
    }
    public function projets(){
        return $this->belongsToMany(Projet::class,'postulant_projet');
    }
}
