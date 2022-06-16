<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Competence;
use Illuminate\Http\Request;
use Illuminate\Support\facades\Validator;

class CompetenceController extends Controller
{
    public function createCompetence(Request $request)
    {
        
       $validator=validator::make($request->all(),[
            'domaine'=>'required|string|min:3',
            'specialite'=>'required|string|min:3',
            'experience'=>'required|string|min:3',
            'motivation'=>'required|string|min:8',
       ]);
       if($validator->fails()){
        return response()->json([
            'message'=>'invalide',
            'errors'=>$validator->errors()
        ],422);
       }
       $compt=Competence::create([
             'domaine'=>$request->domaine,
             'specialite'=>$request->specialite,
             'experience'=>$request->experience,
             'motivation'=>$request->motivation,
             'user_id'=>$request->user()->id
       ]);
       $compt->load('user');
       return response()->json([
        'message'=>'Données enréristrées avec succés.',
        'data'=> $compt
      ],200);
    }
    
}
