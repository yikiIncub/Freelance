<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use \Illuminate\Http\Request;
use \App\Models\Administrateur;
use \Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\Hash;
use \Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function createAdmin(Request $request)
    {
       $validator=validator::make($request->all(),[
            'nom'=>'required|string|min:3',
            'prenom'=>'required|string|min:3',
            'email'=>'required|email|unique:administrateurs',
            'password'=>'required|min:8|confirmed',
            'role'=>'required'
           
       ]);
       if($validator->fails()){
        return response()->json([
            'message'=>'invalide',
            'errors'=>$validator->errors()
        ],200);
       }
       $admin=new Administrateur();
       $admin->nom=ucwords($request->nom);
       $admin->prenom=($request->prenom);
       $admin->email=$request->email;
       $admin->role=$request->role;
       $admin-> password=Hash::make($request->password);
       $admin->save();
       $token = $admin->createToken('token')->accessToken;
       return response()->json([ 
           'status'=>1,
           'message'=>'Utilisateur créé avec succès'  
       ]);
    }
    public function loginAdmin(Request $request)
    {
        $validator=validator::make($request->all(),[
            'email'=>'required',
            'password'=>'required',
           
       ]);
       if($validator->fails()){
        return response()->json([
            'message'=>'invalide',
            'errors'=>$validator->errors()
        ],200);
       }
        //verification des informations

        $admin= Administrateur::where('email','=', $request->email)->first();
        if($admin){
                if(Hash::check($request->password,$admin->password)){
                //créer un jeton token
               $token=$admin->createToken('auth_token')->plainTextToken;

                return response()->json([
                    'status'=>1,
                    'message'=>'Binvenue sur la page admin ',
                    'access_token'=>$token
                ], 200);
                }else{
                    return response()->json([
                        'status'=>0,
                        'message'=>'Mot de passe incorrect'
                    ]); 
                }

        }else{
            return response()->json([
                'status'=>0,
                'message'=>'Vérifiez votre email'
            ], 200);

        }
       
   
    }
    
    public function profilAdmin(Request $request)
    {
            return response()->json([
                'status'=>1,
                'message'=>'information du profil',
                'data'=>Auth::user()       
            ]);
    
    }
    public function updateAdmin(Request $request)
    {
        //
    }


    public function updateprojet(Request $request,$id){
      if($projet=Projet::where(['id'=>$id])->exists()){
            $validator=validator::make($request->all(),[
                'titre'=>'required|string|min:5',
                'categorie'=>'required|string|min:3',
                'description'=>'required|string|min:10',
                'budget'=>'required|string|min:5',
                'competence'=>'required|string|min:3',
                'temps_realisation'=>'required',
                'etat'=>'required',
                'delai'=>'required',
            ]);
              if($validator->fails()){
                    return response()->json([
                      'message'=>'invalide',
                      'errors'=>$validator->errors()
                ],200);
              }
              $projet=Projet::where(['id'=>$id])->first();
                $projet->update([
                  'titre'=>$request->titre,
                  'categorie'=>$request->categorie,
                  'description'=>$request->description,
                  'budget'=>$request->budget,
                  'competence'=>$request->competence,
                  'delai'=>$request->delai,
                  'temps_realisation'=>$request->temps_realisation,
                  'etat'=>$request->etat,
              ]);
              return response()->json([
                'message'=>'Modification éffectué avec succés.',
                'data'=>$projet
                ],200);
        }else{
            return response()->json([
             'message'=>'Desolé.',
              ],200);
    
      }
    }

    
}
