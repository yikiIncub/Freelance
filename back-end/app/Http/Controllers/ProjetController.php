<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\facades\Validator;

class ProjetController extends Controller
{
    // .........Creation de projet........//
    public function createProjet(Request $request)
    
    {
      $categori=$request['categorie_id'];

      $categorie=Categorie::where('id',$categori)->first();
     if($categorie) {
       $validator=validator::make($request->all(),[
            'titre'=>'required|string|min:5',
            'description'=>'required|string|min:10',
            'budget'=>'required|string|min:5',
            'competence'=>'required|string|min:3',
            'temps_realisation'=>'required',
            'disponibilite'=>'required|string|min:3',
            'competence'=>'required|string|min:3',
            'delai'=>'required',
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
             'disponibilite'=>$request->disponibilite,
             'temps_realisation'=>$request->temps_realisation,
             'delai'=>$request->delai,
             'user_id'=>$request->user()->id,
             'categorie_id'=>$categorie->id
       ]);
       $projet->load('user');
       return response()->json([
        'message'=>'Opération effectuée avec succés.',
        'data'=> $projet
      ],200);
    }else{
      return response()->json([
        'message'=>'veillez selectionne la categorie exacte.',
      ],201);
    }
    }

    //.........Modification de projet............//
    public function updateProjet(Request $request,$id){
      $categori=$request['categorie_id'];
      $categorie=Categorie::where('id',$categori)->first();
      if($projet=Projet::where(['id'=>$id])->exists()){
            $validator=validator::make($request->all(),[
                'titre'=>'required|string|min:5',
                'description'=>'required|string|min:10',
                'budget'=>'required|string|min:5',
                'competence'=>'required|string|min:3',
                'temps_realisation'=>'required',
                'disponibilite'=>'required',
                'delai'=>'required',
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
                  'temps_realisation'=>$request->temps_realisation,
                  'disponibilite'=>$request->disponibilite,
                  'user_id'=>$request->user()->id,
                  'categorie_id'=>$categorie->id
              ]);
              return response()->json([
                'message'=>'Modification éffectué avec succés.',
                'data'=>$projet
                ],200);
        }else{
            return response()->json([
             'message'=>'Desolé.',
              ],400);
    
      }
  }
  //.......Detaille de Projet pour un utilisateur............//
  public function detailleProjet($id){
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
 //.......Detaille de Projet Quelconque............//
  public function detProjet($id){
    if(Projet::where(['id'=>$id])->exists()){
        $projet=Projet::where(['id'=>$id])->get();
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

   //......Liste des projet par categorie........//
   public function projetParCategorie($categorie_id,Request $request){
    $categorie=Categorie::where('id',$categorie_id)->first();
    if($categorie){
       
        $projet=Projet::where('categorie_id',$categorie_id)->get();
        return response()->json([
            'message'=>'Les prejet',
            'data'=>$projet
        ],200);
     }else{
        return response()->json([
            'message'=>'Pas de projet',
         ],422);
     }
}
   //......la liste de tout les projet.......//
   public function listProjet(){
    $projet=Projet::all();
        return response()->json([
          'status'=>1,
          'message'=>'Les projet',
          'data'=>$projet 
      ]);

   }
   //.........Suppression de projet.........//
   public function deleteProjet($id){
    $user_id=Auth::user()->id;
    if(Projet::where(['id'=>$id,'user_id'=>$user_id])->exists()){
        $projet=Projet::where(['id'=>$id,'user_id'=>$user_id])->first();
        $projet->delete();
        return response()->json([
          'message'=>'Le projet a été supprimé avec succès.',
        ],200);
    }else{
      return response()->json([
        'message'=>'Desolé.',
      ],400);
    }
}
}