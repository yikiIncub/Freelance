<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Domaine;
use App\Models\DomaineUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DomaineUserController extends Controller
{
    public function domaine_user(Request $request)
    {
        $domaine=$request['domaine_id'];
        $user=$request['user_id'];

        $domaine= Domaine::find($domaine);
        $user=User::find($user);
        if ($domaine && $user) 
        
        {
            $domaine->user()->attach($user);
            return response()->json([
                'success' => 'Opération effectuée avec succès',
                'Domaine' => $domaine->user,
            ], 200);
        } else 
        {
            return response()->json([
                'echec' => 'Echec',
            ], 200);
        }
    }
    public function domaine(Request $request){
        $users=$request['user_id'];
        $user = User::with('domaine')->find($users);
        if ($user) {
            return response()->json([
                'Les domaine de ' => $user
            ], 200);
        } else {
            return response()->json([
                'echec' => 'Pas de domaine',
            ], 200);
        }
    }
    public function dettacheDomaine(Request $request,$id)
    {
        $domaines=$request['domaine_id'];
        $users=$request['user_id'];
        $domaine = Domaine::find($domaines);
        $user=User::find($users);
        if ($domaine && $user) 
        {
            $domaine->user()->detach($user);
            return response()->json([
                'success' => 'Suppression effectuée avec succès',
                'domaine' => $domaine,
                'user' => $user,
            ], 200);
        } else {
            return response()->json([
                'echec' => 'Echec ',
            ], 200);
        }
    }

}
