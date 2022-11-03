<?php

namespace App\Http\Controllers;

use App\Models\Recrutement;
use Illuminate\Http\Request;
use App\Http\Requests\RecrutementRequest;

class RecrutementController extends Controller
{
    public function createRecrutement(RecrutementRequest $request){

        $recutement=Recrutement::create([
                'libelle'=>$request->libelle,
                'annonce'=>$request->annonce,
                'description'=>$request->description,
                'structureRecruteur'=>$request->stuctureRecruteur,
                'secteurActivite'=>$request->secteurActivite,
                'lieuAffectation'=>$request->lieuAffectation,
                'diplome'=>$request->diplome,
                'niveauEtude'=>$request->niveauEtude,
                'experience'=>$request->experience,
                'conditionAge'=>$request->conditionAge,
                'dossier'=>$request->dossier,
                'typeContrat'=>$request->typeContrat,
                'mailRecruteur'=>$request->mailRecruteur,
                'telRecruteur'=>$request->telRecruteur,
                'lien'=>$request->lien,
        ]);
         return response()->json([
                'message'=>'Insertion éffectué avec succés.',
                'data'=>$recutement
                ],200);

    }

    public function updateRecrutement(RecrutementRequest $request,$id){

        if($recrutement=Recrutement::where(['id'=>$id])->exists()){
            $recrutement=Recrutement::where(['id'=>$id])->first();
            $recrutement->update([
                'libelle'=>$request->libelle,
                'annonce'=>$request->annonce,
                'description'=>$request->description,
                'structureRecruteur'=>$request->stuctureRecruteur,
                'secteurActivite'=>$request->secteurActivite,
                'lieuAffectation'=>$request->lieuAffectation,
                'diplome'=>$request->diplome,
                'niveauEtude'=>$request->niveauEtude,
                'experience'=>$request->experience,
                'conditionAge'=>$request->conditionAge,
                'dossier'=>$request->dossier,
                'typeContrat'=>$request->typeContrat,
                'mailRecruteur'=>$request->mailRecruteur,
                'telRecruteur'=>$request->telRecruteur,
                'lien'=>$request->lien,
            ]);
             return response()->json([
                'message'=>'Modification éffectué avec succés.',
                'data'=>$recrutement
                ],200);
        }

    }

    public function listeRecrutement(){

        $recrutement = Recrutement::orderByDesc('created_at')->get();;
         return response()->json([
                'message'=>'La liste des offres.',
                'data'=>$recrutement
                ],200);
    }

    public function deleteRecrutement($id){
      if(Recrutement::where(['id'=>$id])->exists()){
        $recrutement=Recrutement::where(['id'=>$id])->first();
        $recrutement->delete();
        return response()->json([
                'message'=>'Suppession éffectuée avec succès.',
                ],200);
       }
        return response()->json([
             'message'=>'Elément inexistant.',
            ],200);
    }
    
    public function recrutement($id){
        if(Recrutement::where(['id'=>$id])->exists()){
            $recrutement=Recrutement::where(['id'=>$id])->get();
             return response()->json([
          'message'=>'Detaille du recrutement',
          'data'=>$recrutement
        ],200);
        }else{
        return response()->json([
            'message'=>'Desolé.',
        ],200);
    }
    }
   
}
