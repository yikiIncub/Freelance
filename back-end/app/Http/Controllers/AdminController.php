<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administrateur;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function createAdmin(Request $request)
    {
        
       $validator=validator::make($request->all(),[
            'name'=>'required|string|min:3',
            'prenom'=>'required|string|min:3',
            'email'=>'required|email|unique:administrateurs',
            'password'=>'required|min:8|confirmed',
           
       ]);
       if($validator->fails()){
        return response()->json([
            'message'=>'invalide',
            'errors'=>$validator->errors()
        ],422);
       }
       $admin=new Administrateur();
       $admin->name=ucwords($request->name);
       $admin->prenom=($request->prenom);
       $admin->email=$request->email;
       $admin-> password=Hash::make($request->password);
       $admin->save();
       $token=$admin->createToken('auth_token')->plainTextToken;
       return response()->json([ 
           'status'=>1,
           'message'=>'Utilisateur créé avec succès'  
       ]);
    }
}
