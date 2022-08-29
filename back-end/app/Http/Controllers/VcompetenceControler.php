<?php

namespace App\Http\Controllers;

use App\Models\Vcompetence;
use Illuminate\Http\Request;

class VcompetenceControler extends Controller
{
     public function getVcompetence()
    {
        $comp=Vcompetence::all();
        return response()->json([
            'message'=>'La liste des competences',
            'data'=>$comp

        ],200);
    }
}
