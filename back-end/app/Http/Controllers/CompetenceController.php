<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Domaine;
use App\Models\Competence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CompetenceController extends Controller
{
    //enregistrement des competences
  public function createCompetence(Request $request)
    {
      
       $validator=validator::make($request->all(),[
            'libelle'=>'required|string|min:3|unique:competences',
       ]);
       if($validator->fails()){
        return response()->json([
            'message'=>'invalide',
            'errors'=>$validator->errors()
        ],400);
       }
       $compt=Competence::create([
             'libelle'=>$request->libelle,
       ]);
      $compt->save();
       return response()->json([
        'message'=>'Opération effectuée avec succés..', 
        'data'=> $compt
      ],200);
    
  }

    //Mis à jour des competences
  public function updateCompetence(Request $request,$id){
 
  if($competence=Competence::where(['id'=>$id])->exists()){
    $validator=validator::make($request->all(),[
      'libelle'=>'required|string|min:3|unique:competences',
      
 ]);
   if($validator->fails()){
        return response()->json([
           'message'=>'invalide',
           'errors'=>$validator->errors()
  ],200);
}
    $competence=Competence::where([
      'id'=>$id])->first();
     $competence->update([
        'libelle'=>$request->libelle,
     ]);
     return response()->json([
      'message'=>'Modification éffectué avec succés.',
      'data'=> $competence
      
    ],200);
  }else{
    return response()->json([
      'message'=>'Desolé.',
      
      
    ],200);

  }
}
public function competence(){
 $competence=Competence::all();
  return response()->json([
      'status'=>1,
      'message'=>'Les competences',
      'data'=>$competence 
  ]);
}
public function deleteCompetence($id){
  if(Competence::where(['id'=>$id])->exists()){
      $competence=Competence::where(['id'=>$id])->first();
      $competence->delete();
      return response()->json([
        'message'=>'La competence a été supprimé avec succès.',
      ],200);
  }else{
    return response()->json([
      'message'=>'Desolé.',  
    ],200);
  }
}
public function SelectCompetence($id){
  $competence=Competence::where('id',$id)->get();
  return response()->json([
      'status'=>1,
      'message'=>'competence',
      'data'=>$competence     
  ]);

}
}
