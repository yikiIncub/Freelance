<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Freelance;
use Illuminate\Support\facades\Validator;
use Auth;

class AuthApi extends Controller
{
    //Création de compte pour un client
    public function register(Request $request)
    {
        //Validation
       $validator=validator::make($request->all(),[
            'name'=>'required|string|min:3',
            'prenom'=>'required|string|min:3',
            'email'=>'required|email|unique:users',
            'type'=>'required|string|min:3',
            'password'=>'required|min:8|confirmed',
           
       ]);
       if($validator->fails()){
        return response()->json([
            'message'=>'invalide',
            'errors'=>$validator->errors()
        ],422);
       }
       $user=new User();
       $user->name=ucwords($request->name);
       $user->prenom=($request->prenom);
       $user->email=$request->email;
       $user->type=($request->type);
       $user-> password=Hash::make($request->password);
       $user->save();
       return response()->json([
           'status'=>1,
           'message'=>'Utilisateur créé avec succès'
       ]);
    // Fin Création de compte client
        
    }
    
    //Connexion
    public function login(Request $request)
    {
        //validation
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
        $user= User::where('email','=', $request->email)->first();
        if($user){
                if(Hash::check($request->password,$user->password)){
                //créer un jeton token
               $token=$user->createToken('auth_token')->plainTextToken;

                return response()->json([
                    'status'=>1,
                    'massage'=>'Vous étes connecté',
                    'access_token'=>$token
                ], 404);
                }else{
                    return response()->json([
                        'status'=>0,
                        'massage'=>'Mot de passe incorrect'
                    ]); 
                }

        }else{
            return response()->json([
                'status'=>0,
                'massage'=>'Vous êtes pas inscrit'
            ], 404);

        }
        //Fin connexion
    }
    //profil
    public function profil(){
        return response()->json([
            'status'=>1,
            'massage'=>'information du profil',
            'datas'=>Auth::user()        
        ]);
    }
    //la deconnexion
    public function logout(Request $request){
        Auth::user()->tokens()->delete();
        return response()->json([
            'status'=>1,
            'message'=>'Vous étes deconnecter'
        ]);

    }
    //Recuperation de mot de passe
    public function forgotpassword(Request $request){
        $request->validate([
            'email'=>'required|email'
        ]);
        $status=Password::sendRsetLink(
            $request->only('email')
        );
        if($status== Password::RESET_LINK_SENT){
            return [
                 'status'=>__($status)
            ];
        }
        throw ValidationExeception::withMessages([
            'email'=>[trans($status)]
        ]);
    }
}
