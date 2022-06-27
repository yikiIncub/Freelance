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
}
