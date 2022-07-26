<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetenceDomaine extends Model
{
    use HasFactory;
    protected $fillable = [
        'competence_id',
        'domaine_id'
    ];
}
