<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Profil;
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
     public function Freelance()
     {
        $users = DB::table('users')
        ->rightJoin('profils', 'users.id', '=', 'profils.user_id')
        ->get();
        return response()->json([
            'message'=>'La liste des nos freelancers',
            'data'=>$users
        ],200);
     }
}

