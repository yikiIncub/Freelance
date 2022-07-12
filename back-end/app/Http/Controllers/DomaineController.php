<?php

namespace App\Http\Controllers;

use App\Models\Domaine;
use App\Models\Competence;
use Illuminate\Http\Request;
use Illuminate\Support\facades\Validator;

class DomaineController extends Controller{

     // .........Creation de domaine........//
     public function createDomaine(Request $request) {
        $comp=$request['competence_id'];
        $competence=Competence::where('id',$comp)->first();
        if($competence){
            $validator=validator::make($request->all(),[
                'libelle'=>'required',
           ]);
        if($validator->fails()){
         return response()->json([
             'message'=>'invalide',
             'errors'=>$validator->errors()
         ],422);
        }
        $domaine=Domaine::create([
              'libelle'=>$request->libelle,
              'competence_id'=>$competence->id
        ]);
        $competence->load('competence');
        return response()->json([
         'message'=>'Opération effectuée avec succés.',
         'data'=> $domaine
        ],200);
    }
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
            ],422);
        }$domanine=Domaine::where(['id'=>$id])->first();
        $domanine->update([
             'libelle'=>$request->libelle
        ]);
        return response()->json([
            'message'=>'Modification éffectué avec succés.',
            'data'=> $domanine
            ],200);
    }else{
        return response()->json([
         'message'=>'Desolé.',
          ],400);
        }
}
    public function listDomaine(){
      $domaine=Domaine::all();
      return response()->json([
        'status'=>1,
        'message'=>'Les projet',
        'data'=>$domaine
       ]);
    }
}