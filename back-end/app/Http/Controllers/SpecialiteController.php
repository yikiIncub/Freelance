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
}
