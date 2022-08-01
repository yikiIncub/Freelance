<?php

namespace App\Http\Controllers;

use App\Models\Domaine;
use App\Models\Specialite;
use Illuminate\Http\Request;

class DomaineSpecialiteController extends Controller
{
    public function domaine_specialite(Request $request)
    {
        $domaine=$request['domaine_id'];
        $specialite=$request['specialite_id'];

        $domaine= Domaine::find($domaine);
        $specialite=Specialite::find($specialite);
        if ($domaine && $specialite)
        
        {
            $domaine->specialite()->attach($specialite);
            return response()->json([
                'success' => 'Opération effectuée avec succès',
                'Domaine' => $domaine->specialite,
            ], 200);
        } else 
        {
            return response()->json([
                'echec' => 'Echec',
            ], 200);
        }
    }
    public function domaine(Request $request){
        $specialite=$request['specialite_id'];
        $specialite= Specialite::with('domaine')->find($specialite);
        if ($specialite) {
            return response()->json([
                'Les domaine' => $specialite
            ], 200);
        } else {
            return response()->json([
                'echec' => 'Pas de specialite',
            ], 200);
        }
    }
    public function dettacheDomaine(Request $request,$id)
    {
        $domaines=$request['domaine_id'];
        $specialite=$request['specialite_id'];
        $domaine = Domaine::find($domaines);
        $specialite=Specialite::find($specialite);
        if ($domaine && $specialite) 
        {
            $domaine->specialite()->detach($specialite);
            return response()->json([
                'success' => 'Suppression effectuée avec succès',
            ], 200);
        } else {
            return response()->json([
                'echec' => 'Echec ',
            ], 200);
        }
    }
}
