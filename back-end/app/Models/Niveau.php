<?php

namespace App\Models;

use App\Models\Domaine;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Niveau extends Model
{
    use HasFactory;
    protected $fillable = [
        'libelle',
        'domaine_id'
    ];
    public function domaine(){
        return $this->belongsTo(Domaine::class,'domaines');
    }
}
