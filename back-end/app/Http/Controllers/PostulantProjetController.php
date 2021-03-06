<?php


namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Projet;
use App\Models\Postulant;
use Illuminate\Http\Request;
use App\Models\PostulantProjet;
use Illuminate\Routing\Controller;
use Illuminate\Support\facades\Validator;

class PostulantProjetController extends Controller
{
    public function postulant_projet(Request $request)
    {
        $postulant=$request['postulant_id'];
        $projet=$request['projet_id'];

        $postulant = Postulant::find($postulant);
        $projet=Projet::find($projet);
        if( $postulantProjet=PostulantProjet::where($postulant && $projet)->exists()) 
        {
            return response()->json([
                'message' => 'Le lien existe ',
            ], 200);
        }
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
    public function postulant(Request $request){
        $proj=$request['projet_id'];
        $projet = Projet::with('postulants')->find($proj);
        if ($projet) {
            return response()->json([
                'postulants' => $projet
            ], 200);
        } else {
            return response()->json([
                'echec' => 'Pas de postulant',
            ], 404);
        }
    }
    public function dettachepostulant(Request $request)
    {

        $postulant=$request['postulant_id'];
        $projet=$request['projet_id'];

        $postulant = Postulant::find($postulant);
        $projet=Projet::find($projet);
        if ($postulant && $projet) 
        {
            $postulant->projet()->detach($projet);
            return response()->json([
                'expert' => $postulant,
                'mission' => $projet,
                'success' => 'Suppression effectuée avec succès',
            ], 200);
        } else {
            return response()->json([
                'echec' => 'Echec ',
            ], 500);
        }
    }
}
