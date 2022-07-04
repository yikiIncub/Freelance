<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Projet;
use Illuminate\Http\Request;

class PostulantProjetController extends Controller
{
    public function projet_user(Request $request,$user_id,$projet_id)
    {
        $user = User::find($user_id);

        $projet = Projet::find($projet_id);

        if ($user && $projet) 
        {
            $user->projet()->attach($projet);
            return response()->json([
                'projets' => $user->projet,
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
