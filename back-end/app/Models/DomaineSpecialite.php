<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DomaineSpecialite extends Model
{
    use HasFactory;
    protected $fillable = [
        'domaine_id',
        'specialite_id'
    ];
}
