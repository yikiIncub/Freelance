<?php

namespace App\Http\Controllers;

use App\Models\user;
use App\Models\Projet;
use App\Models\Postulant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FreelanceController extends Controller
{
    public function listeFreelance(){
        $data = User::select("*")
        ->where('type', '=', "freelanceur")
        ->get();
        return response()->json([
            'message'=>'La liste des nos freelancers',
            'data'=>$data
        ],200);
    }
     public function projetDuFreelance($user_id)
     {
       $postulant=Postulant::where('user_id',$user_id)->first();
       if($postulant)
       {
        $projets = Projet::join('users', 'users.projet_id', '=', 'projets.id')
        ->join('postulants', 'postulans.user_id', '=', 'postulants.id')
        ->get(['projets.*', 'users.name']);
       }
       return response()->json([
        'message'=>'La liste des projets',
        'data'=>$projets 
    ],200);
     }
}

