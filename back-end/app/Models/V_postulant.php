<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class V_postulant extends Model
{
    use HasFactory;
    protected $fillable = [
        'postulant_email',
        'titre_projet',
        'email_client',
        'postulant_nom'
    ];

}
