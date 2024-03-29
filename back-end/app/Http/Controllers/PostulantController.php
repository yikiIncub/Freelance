<?php

namespace App\Http\Controllers;

use \App\Models\User;
use \App\Models\Projet;
use \App\Models\Postulant;
use App\Mail\PostulantMail;
use \Illuminate\Http\Request;
use \Illuminate\Routing\Controller;
use \Illuminate\Support\Facades\Mail;
use \Illuminate\Support\Facades\Validator;

class PostulantController extends Controller
{
     //........Postuler à un projet...........//
    public function postuler(Request $request)
    {
       
        $proj=$request['projet_id'];
        $user=$request['user_id'];
        $projet=Projet::where('id',$proj)->first();
        $users=User::where('id',$user)->first();
        if($postulant=Postulant::where('projet_id',$proj)){
            return response()->json([
                'message'=>'Vous avez déja postuler à ce projet',
                ],200);
        }
        if($projet && $users)
        {
            $validator=validator::make($request->all(),[
                'description'=>'required',
                'budget'=>'required',
                'disponibilite'=>'required',
                'temps_realisation'=>'required',
           ]);
            if($validator->fails()){
                return response()->json([
                'message'=>'invalide',
                'errors'=>$validator->errors()
                ],200);
            }
            $postulant=Postulant::create ([
                'user_id'=>$request->user()->id,
                'projet_id'=>$projet->id, 
                'description'=>$request->description,
                'budget'=>$request->budget,
                'disponibilite'=>$request->disponibilite,
                'temps_realisation'=>$request->temps_realisation

            ]);
                return response()->json([
                    'message'=>'Requête effectuée avec succés',
                    'data'=>$postulant
                ],200); 
        }else{
            return response()->json([
                'message'=>'Vous n êtes pas autorisé à poustuler à ce projet',
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
                'temps_realisation'=>'required',
           ]);
            if($validator->fails()){
                return response()->json([
                'message'=>'invalide',
                'errors'=>$validator->errors()
                ],200);
            }
            $postulant=Postulant::where(['id'=>$id])->first();
            $postulant->update([
                'user_id'=>$request->user()->id,
                'projet_id'=>$projet->id, 
                'description'=>$request->description,
                'budget'=>$request->budget,
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
             ],200);
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
    public function profilPostulant($id){
        $user=User::where('id',$id)->get();
        return response()->json([
            'status'=>1,
            'message'=>'information du profil',
            'data'=>$user     
        ]);
    
}
    public function usermail(Request $request)
    {
        $email=$request->email;
        Mail::to($email)->send(new PostulantMail());
         return response()->json([
            'status'=>1,
            'message'=>'Email envoyé avec succès',
        ]);
    }
    public function countpostulant($projet_id){
        $postulant=Postulant::where('projet_id',$projet_id)->count();
         return response()->json([
            'message'=>'nombre de postulants',
            'data'=>$postulant    
        ]);

    }
}