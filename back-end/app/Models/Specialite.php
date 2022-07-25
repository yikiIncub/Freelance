<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialite extends Model
{
    use HasFactory;
    protected $fillable = [
        'libelle',
    ];
    public function domaine(){
        return $this->belongsTo(Domaine::class);
    }
}
