<?php

namespace App\Http\Controllers;

use App\Models\Domaine;
use App\Models\Competence;
use Illuminate\Http\Request;
use Illuminate\Support\facades\Validator;

class DomaineController extends Controller
{
     // .........Creation de domaine........//
     public function createDomaine($competence_id,Request $request)
     {
        $competence=Competence::where('id',$competence_id)->first();
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
}