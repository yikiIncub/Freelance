<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecrutementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'libelle'=>'required',
            'description'=>'nullable',
            'logo'=>'nullable',
            'etat'=>'nullable',
            'dateLimite'=>'nullable',
            'dureeContrat'=>'nullable',
            'structureRecruteur'=>'nullable',
            'secteurActivite'=>'nullable',
            'lieuAffectation'=>'nullable',
            'diplome'=>'nullable',
            'niveauEtude'=>'nullable',
            'experience'=>'nullable',
            'conditionAge'=>'nullable',
            'dossier'=>'nullable',
            'typeContrat'=>'nullable',
            'mailRecruteur'=>'nullable|email',
            'telRecruteur'=>'nullable',
            'lien'=>'nullable',
        ];
    }
}
