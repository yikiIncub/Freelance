<?php

namespace App\Http\Controllers;

use App\Models\Niveau;
use App\Models\Domaine;
use Illuminate\Http\Request;
use Illuminate\Support\facades\Validator;

class NiveauController extends Controller
{
     // .........Creation de Niveau........//
     public function createNiveau($domaine_id,Request $request)
     {
        $domaine=Domaine::where('id',$domaine_id)->first();
        if($domaine){
            $validator=validator::make($request->all(),[
                'libelle'=>'required',
           ]);
        if($validator->fails()){
         return response()->json([
             'message'=>'invalide',
             'errors'=>$validator->errors()
         ],422);
        }
        $niveau=Niveau::create([
              'libelle'=>$request->libelle,
              'domaine_id'=>$domaine->id
        ]);
        $domaine->load('competence');
        return response()->json([
         'message'=>'Opération effectuée avec succés.',
         'data'=> $niveau
       ],200);
     }
}

public function updateNiveau(Request $request,$id){
  if($niveau=Niveau::where(['id'=>$id])->exists()){
      $validator=validator::make($request->all(),[
          'libelle'=>'required'
      ]);
      if($validator->fails()){
          return response()->json([
              'message'=>'invalide',
              'errors'=>$validator->errors()
          ],422);
      }$niveau=Niveau::where(['id'=>$id])->first();
      $niveau->update([
           'libelle'=>$request->libelle
      ]);
      return response()->json([
          'message'=>'Modification éffectué avec succés.',
          'data'=> $niveau
          ],200);
  }else{
      return response()->json([
       'message'=>'Desolé.',
        ],400);
      }
}
public function listNiveau(){
  $niveau=Niveau::all();
      return response()->json([
        'status'=>1,
        'message'=>'Les projet',
        'data'=>$niveau 
    ]);
  }
  public function deleteNiveau($id){
    if(Niveau::where(['id'=>$id])->exists()){
        $niveau=Niveau::where(['id'=>$id])->first();
        $niveau->delete();
        return response()->json([
          'message'=>'La Niveau a été supprimé avec succès.',
        ],200);
    }else{
      return response()->json([
        'message'=>'Desolé.',  
      ],400);
    }
  }
}
