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
            'description'=>'required',
            'stuctureRecruteur'=>'required',
            'secteurActivite'=>'required',
            'lieuAffectation'=>'required',
            'diplome'=>'required',
            'niveauEtude'=>'nullable',
            'experience'=>'nullable',
            'conditionAge'=>'nullable',
            'dossier'=>'required',
            'typeContrat'=>'required',
            'mailRecruteur'=>'nullable|email',
            'telRecruteur'=>'nullable',
            'lien'=>'nullable',
        ];
    }
}
