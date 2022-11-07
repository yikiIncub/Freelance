<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recrutement extends Model
{
    use HasFactory;
    protected $fillable = [
        'libelle',
        'logo',
        'annonce',
        'description',
        'dureeContrat',
        'structureRecruteur',
        'secteurActivite',
        'lieuAffectation',
        'diplome',
        'niveauEtude',
        'experience',
        'conditionAge',
        'dossier',
        'typeContrat',
        'mailRecruteur',
        'telRecruteur',
        'lien',
    ];
}
