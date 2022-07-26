<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administrateur;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\facades\Validator;
use Illuminate\Support\Facades\Auth;

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
        ],422);
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
        ],422);
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
            ], 404);

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
}
