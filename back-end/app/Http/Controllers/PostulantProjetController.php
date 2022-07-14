<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Projet;
use App\Models\Postulant;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PostulantProjetController extends Controller
{
    public function postulant_projet(Request $request)
    {

        $postulant=$request['postulant_id'];
        $projet=$request['projet_id'];

        $postulant = Postulant::find($postulant);
        $projet=Projet::find($projet);

        if ($postulant && $projet) 
        {
            $postulant->projet()->attach($projet);
            return response()->json([
                'projets' => $postulant->projet,
                'success' => 'Opération effectuée avec succès',
            ], 200);
        } else 
        {
            return response()->json([
                'echec' => 'Echec',
            ], 500);
        }
    }
}
