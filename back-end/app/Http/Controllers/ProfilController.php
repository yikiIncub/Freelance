<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profil;
use App\Models\Domaine;
use App\Models\Competence;
use App\Models\Specialite;
use \Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function createAllCompetence(Request $request)
    {
        $competence=$request['competence_id'];
        $specialite=$request['specialite_id'];
        $domaine=$request['domaine_id'];
        $competences=Competence::where('id',$competence)->first();
        $specialites=Specialite::where('id',$specialite)->first();
        $domaines=Domaine::where('id',$domaine)->first();
        if($competences && $specialites && $domaines) 
        { 
            $profil=Profil::create([
                'user_id'=>$request->user()->id,
                'competence_id'=>$competences->id,
                'specialite_id'=>$specialites->id,
                'domaine_id'=>$domaines->id
            ]);
            $profil->save();
            return response()->json([
                'message'=>'Opération effectuée avec succés.',
                'data'=> $profil,
                
              ],200);
        }
    }
    public function listCompetence($user_id,Request $request){
        $user=User::where('id',$user_id)->first();
        
        if($user){
           
            $competence=Profil::where('user_id',$user_id)->get();
            return response()->json([
                'Freelanceur'=>$user,
                'Competence'=>$competence,
            ],200);
         }else{
            return response()->json([
                'message'=>'Pas de projet',
             ],200);
         }
         
    }
}
