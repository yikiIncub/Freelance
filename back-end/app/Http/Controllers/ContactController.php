<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Mail\ContactMail;
use \Illuminate\Http\Request;
use App\Mail\Reponsecontatmail;
use \Illuminate\Support\Facades\Mail;
use \Illuminate\Support\Facades\Validator;


class ContactController extends Controller
{
    public function createContact(Request $request)
       {
            $validation=validator::make($request->all(),[
                'nom'=>'required|string|min:3',
                'email'=>'required|email',
                'numero'=>'required|min:8',
                'message'=>'required|string'
            ]);
            if($validation->fails()){
            return response()->json([
                'message'=>'Vérifiez vos informations',
                'errors'=>$validation->errors()
            ],200);
            } 
            $contact=Contact::create([
                'nom'=>$request->nom,
                'email'=>$request->email,
                'numero'=>$request->numero,
                'message'=>$request->message
            ]);
            $mailable=new ContactMail($request->nom,$request->email,$request->numero ,$request->message);
            Mail::to('contact@yikifree.com')->send($mailable);
            return response()->json([
                'message'=>'message envoyé avec succès.',
                'data'=>$contact
            ],200);
        }
    public function contact()
    {
        $contact=Contact::all();
         return response()->json([
            'message'=>'La liste des contacts',
            'data'=>$contact
        ],200);
    }

    public function reponsecontact(Request $request){
         $validation=validator::make($request->all(),[
                'email'=>'required|email',
                'message'=>'required|string'
            ]);
            $mailable=new Reponsecontatmail($request->email,$request->message);
            Mail::to($request->email)->send($mailable);
            return response()->json([
                'message'=>'Message envoyé avec succès.'
            ]);
    }
}
