<?php

namespace App\Http\Controllers;

use App\Models\Domaine;
use App\Models\Specialite;
use \Illuminate\Http\Request;
use \Illuminate\Routing\Controller;
use \Illuminate\Support\facades\Validator;

class SpecialiteController extends Controller
{
    // .........Creation de Niveau........//
    public function createSpecialite(Request $request)
    {
    
      $validator=validator::make($request->all(),[
               'libelle'=>'required|unique:specialites',
          ]);
       if($validator->fails()){
        return response()->json([
            'message'=>'invalide',
            'errors'=>$validator->errors()
        ],200);
       }
       $specialite=Specialite::create([
             'libelle'=>$request->libelle,
       ]);
       $specialite->save();
       return response()->json([
        'message'=>'Opération effectuée avec succés.',
        'data'=> $specialite
      ],200);

}
public function updateSpecialite(Request $request,$id){
    if($specialite=Specialite::where(['id'=>$id])->exists()){
        $validator=validator::make($request->all(),[
            'libelle'=>'required|unique:specialites'
        ]);
        if($validator->fails()){
            return response()->json([
                'message'=>'invalide',
                'errors'=>$validator->errors()
            ],200);
        }$specialite=Specialite::where(['id'=>$id])->first();
        $specialite->update([
             'libelle'=>$request->libelle,
        ]);
        return response()->json([
            'message'=>'Modification éffectué avec succés.',
            'data'=> $specialite
            ],200);
    }else{
        return response()->json([
         'message'=>'Desolé.',
          ],200);
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
    public function deleteSpecialite($id){
        if(Specialite::where(['id'=>$id])->exists()){
            $specialite=Specialite::where(['id'=>$id])->first();
            $specialite->delete();
            return response()->json([
              'message'=>'La Specialite a été supprimé avec succès.',
            ],200);
        }else{
          return response()->json([
            'message'=>'Desolé.',  
          ],200);
        }
      }
      public function Specialite($id){
        $specialite=Specialite::where('id',$id)->get();
        return response()->json([
            'status'=>1,
            'message'=>'Specialite',
            'data'=>$specialite     
        ]);
      }
}
