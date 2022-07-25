<?php

namespace App\Models;

use App\Models\Niveau;
use App\Models\Competence;
use App\Models\Specialite;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Domaine extends Model
{
    protected $fillable = [
        'libelle',
        'competence_id',
        'specialite_id'
    ];
    use HasFactory;
    public function competence(){
        return $this->belongsToMany(Competence::class);
    }
    public function domaine(){
        return $this->belongsToMany(Competence::class);
    }
    public function user(){
        return $this->belongsToMany(User::class);
    }
}