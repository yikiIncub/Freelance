<?php

namespace App\Http\Controllers;

use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FreelanceController extends Controller
{
    public function listeFreelance(){
        $data = User::select("*")
        ->where('type', '=', "freelance")
        ->get();
        return response()->json([
            'message'=>'La liste des nos freelance',
            'data'=>$data
        ],200);
    }
     
}

