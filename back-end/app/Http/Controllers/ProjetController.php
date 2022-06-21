<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\facades\Validator;

class ProjetController extends Controller
{
    // .........Creation de projet........//
    public function createProjet(Request $request)
    {
        
       $validator=validator::make($request->all(),[
            'titre'=>'required|string|min:5',
            'description'=>'required|string|min:10',
            'budget'=>'required|string|min:5',
            'competence'=>'required|string|min:3',
            'delai'=>'required'
       ]);
       if($validator->fails()){
        return response()->json([
            'message'=>'invalide',
            'errors'=>$validator->errors()
        ],422);
       }
       $projet=Projet::create([
             'titre'=>$request->titre,
             'description'=>$request->description,
             'budget'=>$request->budget,
             'competence'=>$request->competence,
             'delai'=>$request->delai,
             'user_id'=>$request->user()->id
       ]);
       $projet->load('user');
       return response()->json([
        'message'=>'Opération effectuée avec succés.',
        'data'=> $projet
      ],200);
    }
    //.........Modification de projet............//
    public function updateProjet(Request $request,$id){
    
      if($projet=Projet::where(['id'=>$id])->exists()){
            $validator=validator::make($request->all(),[
                'titre'=>'required|string|min:5',
                'description'=>'required|string|min:10',
                'budget'=>'required|string|min:5',
                'competence'=>'required|string|min:3',
                'delai'=>'required'
            ]);
              if($validator->fails()){
                    return response()->json([
                      'message'=>'invalide',
                      'errors'=>$validator->errors()
                ],422);
              }
              $projet=Projet::where(['id'=>$id])->first();
                $projet->update([
                  'titre'=>$request->titre,
                  'description'=>$request->description,
                  'budget'=>$request->budget,
                  'competence'=>$request->competence,
                  'delai'=>$request->delai,
                  'user_id'=>$request->user()->id
              ]);
              return response()->json([
                'message'=>'Modification éffectué avec succés.',
                'data'=> $projet
                
                ],200);
              }else{
                return response()->json([
                  'message'=>'Desolé.',
                ],400);
    
      }
  }
  //.......Detaille de Projet............//
  public function ditailleProjet($id){
      $user_id=Auth::user()->id;
      if(Projet::where(['id'=>$id,'user_id'=>$user_id])->exists()){
          $projet=Projet::where(['id'=>$id,'user_id'=>$user_id])->get();
          return response()->json([
            'message'=>'Detaille du projet.',
            'data'=>$projet
          ],200);
      }else{
        return response()->json([
          'message'=>'Desolé.',
        ],400);
      }
  }
  //......Liste des projet d'un utilisateur........//
  public function userProjet(){
    $user_id = Auth::user()->id;
     $projet=Projet::where('user_id',$user_id)->get();
     return response()->json([
         'status'=>1,
         'message'=>'Les projet',
         'data'=>$projet 
     ]);
   }
}