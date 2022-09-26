<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profil;
use App\Models\Domaine;
use App\Models\Competence;
use App\Models\Specialite;
use \Illuminate\Http\Request;
use \Illuminate\Support\Facades\DB;

class ProfilController extends Controller
{
    public function createAllCompetence(Request $request)
    {
        $competence=$request['competence_id'];
        $specialite=$request['specialite_id'];
        $user=$request['user_id'];
        $domaine=$request['domaine_id'];
        $competences=Competence::where('id',$competence)->first();
        $specialites=Specialite::where('id',$specialite)->first();
        $domaines=Domaine::where('id',$domaine)->first();
        $comp=DB::table('profils')
                ->where('competence_id','=',$competence)
                ->where('user_id','=',$user)
                ->where('specialite_id','=',$specialite)
                ->where('domaine_id','=',$domaine)
                ->exists();

        if($comp){
          return response()->json([
              'message'=>'cette competence existe'
          ]);
        }else
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
    public function deletecompetence($id){
       
        if(Profil::where(['id'=>$id])->exists()){
            $comp=Profil::where(['id'=>$id])->first();
            $comp->delete();
            return response()->json([
              'message'=>'competence supprimé avec succès.',
            ],200);
        }else{
          return response()->json([
            'message'=>'Desolé.',  
          ],200);
        }
      }
}
