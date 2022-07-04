<?php

namespace App\Http\Controllers;

use App\Models\Domaine;
use App\Models\Specialite;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\facades\Validator;

class SpecialiteController extends Controller
{
    // .........Creation de Niveau........//
    public function createSpecialite($domaine_id,Request $request)
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
       $specilite=Specialite::create([
             'libelle'=>$request->libelle,
             'domaine_id'=>$domaine->id
       ]);
       $domaine->load('competence');
       return response()->json([
        'message'=>'Opération effectuée avec succés.',
        'data'=> $specilite
      ],200);
    }

}
public function updateSpecialite(Request $request,$id){
    if($specialite=Specialite::where(['id'=>$id])->exists()){
        $validator=validator::make($request->all(),[
            'libelle'=>'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'message'=>'invalide',
                'errors'=>$validator->errors()
            ],422);
        }$specialite=Specialite::where(['id'=>$id])->first();
        $specialite->update([
             'libelle'=>$request->libelle
        ]);
        return response()->json([
            'message'=>'Modification éffectué avec succés.',
            'data'=> $specialite
            ],200);
    }else{
        return response()->json([
         'message'=>'Desolé.',
          ],400);
        }
}
public function listSpecialite(){
    $specialite=Specialite::all();
        return response()->json([
          'status'=>1,
          'message'=>'Les projet',
          'data'=>$specialite 
      ]);
    }
}
