<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Mail;
use Carbon\carbon;
use Illuminate\Support\facades\Validator;
use Illuminate\Validation\Rules\Password;
use App\Mail\forgotpasswordMail;
use App\Models\PasswordReset;

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
                'massage'=>'Vous n êtes pas inscrit'
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
        Auth::user()->token()->delete();
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
        $user=User::where('email',$request->email)->first();
        if(!$user){
             return redirect()->back()->with('error','Email not found');
            
        }else{
            $reset_code=Str::random(200);
            PasswordReset::create([
                'user_id'=>$user->id,
                'reset_code'=>$reset_code
            ]);
            Mail::to($user->email)->send(new forgotpasswordMail($user->first_name,$reset_code));
         }
       
        throw ValidationExeception::withMessages([
            'email'=>[trans($status)]
        ]);
    }
    public function resetPassword($reset_code){
        $password_reset_data=PasswordReset::where('reset_code')->first();
      if(!$password_reset_data||carbon::now()->subMinutes((50)>$password));
        return response()->json([
        'status'=>0,
        'message'=>'Lien expiré.'
        ]);
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:8|confirmed'
        ]);
        $user=User::find($password_reset_data->user_id);
        if($user->email!=$request->email){
            return  response()->json([
                'status'=>0,
                'message'=>'Email invalide.'
            ]);
        }else{
            $password_reset_data->delete();
            $user->update([
                'password'=>bcrypt($request->password)
            ]);
            return  response()->json([
                'status'=>1,
                'message'=>'Modification effectué avec succés.'
            ]);
        }
}

//Mise à jour du profil
public function updateprofil(Request $request){
    $validator=validator::make($request->all(),[
        'name'=>'required|string|min:3',
        'prenom'=>'required|string|min:3',
        'telephone'=>'nullable|min:8',
        'nationalite'=>'nullable|max:50',
        'residence'=>'nullable|max:50',
        'Sexe'=>'nullable', 
        'photo'=>'nullable|image|mimes:jpeg,jpg,png',
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
    $user=$request->user();
    
}
}
