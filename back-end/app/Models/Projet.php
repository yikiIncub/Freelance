<?php

namespace App\Models;

use App\Models\Postulant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Projet extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'categorie',
        'titre',
        'description',
        'budget',
        'delai',
        'competence',
        'temps_realisation',
        'etat'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function postulant(){
        return $this->belongsToMany(Postulant::class,'postulant_projet');
    }
}
