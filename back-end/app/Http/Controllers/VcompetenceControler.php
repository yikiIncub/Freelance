<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use App\Models\Vcompetence;
use \Illuminate\Http\Request;

class VcompetenceControler extends Controller
{
     public function getVcompetence($user_id)
    {
        
        $comp=Vcompetence::where('user',$user_id)->get();
        $competence=Profil::where('user_id',$user_id)->get();
        return response()->json([
            'message'=>'La liste des competences',
            'data'=>$comp,
            'competence'=>$competence
        ],200);
    }

}
