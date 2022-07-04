<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Competence;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class CompetenceUserController extends Controller
{
    public function competence_user(Request $request,$user_id,$competence_id)
    {
        $user = User::find($user_id);

        $competence = Competence::find($competence_id);

        if ($user && $competence) {
            $user->competence()->attach($competence);
            return response()->json([
                'competences' => $user->competence,
                'success' => 'competence crée avec succès',
            ], 200);
        } else {
            return response()->json([
                'echec' => 'Echec de création de la competence',
            ], 500);
        }
    }
}
