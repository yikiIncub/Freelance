<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use App\Models\Commentaire;
use Illuminate\Http\Request;
use Illuminate\Support\facades\Validator;

class CommentaireController extends Controller
{
    //........Creation de commentaire...........//
    public function create($projet_id,Request $request){
        $projet=Projet::where('id',$projet_id)->first();
        if($projet){
            $validator=validator::make($request->all(),[
                'message'=>'required',
           ]);
           if($validator->fails()){
                return response()->json([
                'message'=>'invalide',
                'errors'=>$validator->errors()
                ],200);
            }
            $commentaire=Commentaire::create([
             'message'=>$request->message,
             'projet_id'=>$projet->id,
             'user_id'=>$request->user()->id
            ]);
            return response()->json([
                'message'=>'Commentaire créé avec succés',
                'data'=>$commentaire
                ],200);

        
        }else{
             return response()->json([
                'message'=>'Pas de projet',
                ],200);
        }

        
    }
    public function list($projet_id,Request $request){
        $projet=Projet::where('id',$projet_id)->first();
        if($projet){
           
            $commentaire=Commentaire::where('projet_id',$projet_id)->get();
            return response()->json([
                'message'=>'Les commentaires',
                'data'=>$commentaire
            ],200);
         }else{
            return response()->json([
                'message'=>'Pas de projet',
             ],200);
         }
    }
}
