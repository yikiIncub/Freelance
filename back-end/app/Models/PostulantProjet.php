<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostulantProjet extends Model
{
    protected $fillable = [
        'postulant_id', 
        'projet_id',
         
    ];
}
