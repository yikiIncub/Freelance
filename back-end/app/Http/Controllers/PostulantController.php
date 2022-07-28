<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Projet;
use App\Models\Postulant;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\facades\Validator;

class PostulantController extends Controller
{
     //........Postuler à un projet...........//
    public function postuler(Request $request)
    {
       
        $proj=$request['projet_id'];

        $projet=Projet::where('id',$proj)->first();
        if($projet)
        {
            $validator=validator::make($request->all(),[
                'description'=>'required',
                'budget'=>'required',
                'delai'=>'required',
                'disponibilite'=>'required',
                'temps_realisation'=>'required',
           ]);
            if($validator->fails()){
                return response()->json([
                'message'=>'invalide',
                'errors'=>$validator->errors()
                ],422);
            }
            $postulant=Postulant::create ([
                'user_id'=>$request->user()->id,
                'projet_id'=>$projet->id, 
                'description'=>$request->description,
                'budget'=>$request->budget,
                'delai'=>$request->delai,
                'disponibilite'=>$request->disponibilite,
                'temps_realisation'=>$request->temps_realisation

            ]);
                return response()->json([
                    'message'=>'Requête effectuée avec succés',
                    'data'=>$postulant
                ],200); 
        }
    }
    public function updateInfo(Request $request,$id)
    {
        $projet=$request['projet_id'];
        $projet=Projet::where('id',$projet)->first();
        if($postulant=Postulant::where(['id'=>$id])->exists())
        {
            $validator=validator::make($request->all(),[
                'description'=>'required',
                'budget'=>'required',
                'delai'=>'required',
                'temps_realisation'=>'required',
           ]);
            if($validator->fails()){
                return response()->json([
                'message'=>'invalide',
                'errors'=>$validator->errors()
                ],422);
            }
            $postulant=Postulant::where(['id'=>$id])->first();
            $postulant->update([
                'user_id'=>$request->user()->id,
                'projet_id'=>$projet->id, 
                'description'=>$request->description,
                'budget'=>$request->budget,
                'delai'=>$request->delai,
                'temps_realisation'=>$request->temps_realisation

            ]);
                return response()->json([
                    'message'=>'Vos informations ont été modifiées avec succés',
                    'data'=>$postulant
                ],200);
        }
    }
    public function listePostulant(Request $request)
    {
        $proj=$request['projet_id'];
        $projet=Projet::where('id',$proj)->first();
        if($projet)
        {
            $postulant=Postulant::where('projet_id',$proj)->get();
            return response()->json(
            [
                'message'=>'Les Postulants',
                'data'=>$postulant
            ],200);
        }else
        
         {
            return response()->json([
                'message'=>'Pas de postulant',
             ],500);
         }
    }
    public function detailPostulant($id){
        $postulant=Postulant::where('id',$id)->get();
        return response()->json([
            'status'=>1,
            'message'=>'information du profil',
            'data'=>$postulant       
        ]);
    }
    public function profilPostulant(Request $request,$id){
        $user=$request['user_id'];
        $postulant=Postulant::where('id',$id)->first();
        if($postulant){
        $users=User::where('id',$user)->get();
        return response()->json([
            'status'=>1,
            'message'=>'information du profil',
            'data'=>$users      
        ]);
    }
}
}
