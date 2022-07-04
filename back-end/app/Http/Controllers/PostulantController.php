<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostulantController extends Controller
{
     //........Postuler...........//
    public function create(Request $request)
    {
       
        $postulant=Postulant::create ([
             'user_id'=>$request->user()->id
            ]);
            return response()->json([
                'message'=>'Commentaire créé avec succés',
                'data'=>$commentaire
                ],200); 
    }
}
