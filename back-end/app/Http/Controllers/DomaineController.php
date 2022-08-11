<?php

namespace App\Http\Controllers;

use App\Models\Domaine;
use App\Models\Competence;
use App\Models\Specialite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\facades\Validator;

class DomaineController extends Controller{

     // .........Creation de domaine........//
     public function createDomaine(Request $request) {
      
      $validator=validator::make($request->all(),[
                'libelle'=>'required|unique:domaines',
           ]);
        if($validator->fails()){
         return response()->json([
             'message'=>'invalide',
             'errors'=>$validator->errors()
         ],200);
        }
        $domaine=Domaine::create([
              'libelle'=>$request->libelle,
        ]);
        $domaine->save();
        return response()->json([
         'message'=>'Opération effectuée avec succés.',
         'data'=> $domaine
        ],200);
    
  }
  public function updateDomaine(Request $request,$id){
     
    if($domanine=Domaine::where(['id'=>$id])->exists()){
        $validator=validator::make($request->all(),[
            'libelle'=>'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'message'=>'invalide',
                'errors'=>$validator->errors()
            ],200);
        }$domanine=Domaine::where(['id'=>$id])->first();
        $domanine->update([
             'libelle'=>$request->libelle,
             
        ]);
        return response()->json([
            'message'=>'Modification éffectué avec succés.',
            'data'=> $domanine
            ],200);
    }else{
        return response()->json([
         'message'=>'Desolé.',
          ],200);
        }
}
    public function listDomaine(){
      $domaine=Domaine::all();
      return response()->json([
        'status'=>1,
        'message'=>'Les domaines',
        'data'=>$domaine
       ]);
    }
    public function deleteDomaine($id){
        if(Domaine::where(['id'=>$id])->exists()){
            $domaine=Domaine::where(['id'=>$id])->first();
            $domaine->delete();
            return response()->json([
              'message'=>'La Domaine a été supprimé avec succès.',
            ],200);
        }else{
          return response()->json([
            'message'=>'Desolé.',  
          ],200);
        }
      }
      public function Domaine($id){
        $domaine=Domaine::where('id',$id)->get();
        return response()->json([
            'status'=>1,
            'message'=>'damaine',
            'data'=>$domaine     
        ]);
    
}
}