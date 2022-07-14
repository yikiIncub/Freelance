<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\facades\Validator;
 
class CategorieController extends Controller
{
    public function createCategorie(Request $request)
    {
        
       $validator=validator::make($request->all(),[
            'libelle'=>'required|string|unique:categories|min:3',
       ]);
       if($validator->fails()){
        return response()->json([
            'message'=>'invalide',
            'errors'=>$validator->errors()
        ],422);
       }
       $categorie=Categorie::create([
             'libelle'=>$request->libelle,
       ]);
       $categorie->save();
       return response()->json([
        'message'=>'Opération effectuée avec succés..',
        'data'=> $categorie
      ],200);
    }

  
  public function updateCategorie(Request $request,$id){
    
  if($categorie=Categorie::where(['id'=>$id])->exists()){
    $validator=validator::make($request->all(),[
      'libelle'=>'required',
      
 ]);
   if($validator->fails()){
        return response()->json([
           'message'=>'invalide',
           'errors'=>$validator->errors()
  ],422);
}
    $categorie=Categorie::where([
      'id'=>$id])->first();
     $categorie->update([
          
        'libelle'=>$request->libelle,
     ]);
     return response()->json([
      'message'=>'Modification éffectué avec succés.',
      'data'=> $categorie
      
    ],200);
  }else{
    return response()->json([
      'message'=>'Desolé.',
      
      
    ],400);

  }
}
public function listCategorie(){
    $categorie=Categorie::all();
        return response()->json([
          'status'=>1,
          'message'=>'Les categories',
          'data'=>$categorie 
      ]);

}


public function deleteCategorie($id){
  if(Categorie::where(['id'=>$id])->exists()){
      $categorie=Categorie::where(['id'=>$id])->first();
      $categorie->delete();
      return response()->json([
        'message'=>'Le categorie a été supprimé avec succès.',
      ],200);
  }else{
    return response()->json([
      'message'=>'Desolé.',  
    ],400);
  }
}

}
