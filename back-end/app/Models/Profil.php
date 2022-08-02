<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'competence_id',
        'domaine_id',
        'specialite_id'
    ];
    public function competence(){
        return $this->belongsToMany(Competence::class);
    }
    public function specialite(){
        return $this->belongsToMany(Specialite::class);
    }
    public function user(){
        return $this->belongsToMany(User::class);
    }
    public function domaine(){
        return $this->belongsToMany(Domaine::class);
    }
}

