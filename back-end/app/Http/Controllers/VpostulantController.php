<?php

namespace App\Http\Controllers;

use \App\Models\Postulant;
use \App\Mail\PostulantMail;
use \App\Models\V_postulant;
use \App\Mail\EmailPostulant;
use \Illuminate\Http\Request;
use \Illuminate\Support\Facades\Mail;
use \Illuminate\Support\facades\Validator;


class VpostulantController extends Controller
{
    public function vpostulant(Request $request)
    {
        if($request->isMethod('POST')){
            $Datapostulant=$request->input();
             foreach($Datapostulant as $key => $value){
              $V_postulant= new V_postulant();
              $V_postulant->postulant_email=$value['postulant_email'];
              $V_postulant->email_client=$value['email_client'];
              $V_postulant->titre_projet=$value['titre_projet'];
              $V_postulant->save();
              Mail::to($Datapostulant=$value['postulant_email'])->send(new EmailPostulant($V_postulant));
            }
                return response()->json([
                'status'=>1,
                'message'=>'Un message a été envoyé à chacun des postulants que vous avez sélectionné. Ils vous enverront  leur offre technique et financière pour  que vous puissiez faire votre sélection. Merci pour votre confiance !',
        ]);
       }
    }
}
