<?php

namespace App\Http\Controllers;

use App\Models\Vcompetence;
use Illuminate\Http\Request;

class VcompetenceControler extends Controller
{
     public function getVcompetence(Request $request)
    {
        $Vr=$request['user_id'];
        $comp=Vcompetence::where('user',$Vr)->get();
        return response()->json([
            'message'=>'La liste des competences',
            'data'=>$comp
        ],200);
    }

}
