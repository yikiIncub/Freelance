<?php

namespace App\Http\Controllers;

use \App\Models\Domaine;
use \App\Models\Competence;
use \Illuminate\Http\Request;

class CompetenceDomaineController extends Controller
{
    public function domaine_competence(Request $request)
    {
        $domaine=$request['domaine_id'];
        $competence=$request['competence_id'];

        $domaine= Domaine::find($domaine);
        $competence=Competence::find($competence);
        if ($domaine && $competence) 
        
        {
            $domaine->competence()->attach($competence);
            return response()->json([
                'success' => 'Opération effectuée avec succès',
                'Domaine' => $domaine->competence,
            ], 200);
        } else 
        {
            return response()->json([
                'echec' => 'Echec',
            ], 200);
        }
    }
    public function competenceDomaine(Request $request){
        $competence=$request['competence_id'];
        $competence= Competence::with('domaine')->find($competence);
        if ($competence) {
            return response()->json([
                'Les domaine' => $competence
            ], 200);
        } else {
            return response()->json([
                'echec' => 'Pas de competence',
            ], 200);
        }
    }
    public function dettacheDomaine(Request $request,$id)
    {
        $domaines=$request['domaine_id'];
        $competence=$request['competence_id'];
        $domaine = Domaine::find($domaines);
        $competence=Competence::find($competence);
        if ($domaine && $competence) 
        {
            $domaine->competence()->detach($competence);
            return response()->json([
                'success' => 'Suppression effectuée avec succès',
                'domaine' => $domaine,
                'competence' => $competence,
            ], 200);
        } else {
            return response()->json([
                'echec' => 'Echec ',
            ], 200);
        }
    }
}
