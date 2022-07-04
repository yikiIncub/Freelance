<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProstulantProjet extends Model
{
    protected $fillable = [
        'projet_id',
        'user_id',  
    ];
}
