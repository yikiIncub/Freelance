<?php

namespace App\Http\Controllers;

use App\Models\Vcompetence;
use Illuminate\Http\Request;

class VcompetenceControler extends Controller
{
     public function getVcompetence($user_id)
    {
    
        $comp=Vcompetence::where('user',$user_id)->get();
        return response()->json([
            'message'=>'La liste des competences',
            'data'=>$comp
        ],200);
    }

}
