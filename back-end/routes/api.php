<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AuthApi;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjetController;
use App\Http\Controllers\CompetenceController;





//...............Authentification............/
Route::post('register',[AuthApi::class,'register']);
// Route::post('registerfreelance',[AuthApi::class,'registerfreelance']);
Route::post('login',[AuthApi::class,'login']);
Route::post('forgotpassword',[AuthApi::class,'forgotpassword']);
Route::get('getresetPassword/{reset_code}',[AuthApi::class,'getresetPassword']);
Route::post('resetPassword',[AuthApi::class,'resetPassword']);

Route::middleware('auth:sanctum')->group(function(){
    Route::get('profil' ,[AuthApi::class,'profil']);
    Route::post('change_password',[AuthApi::class,'change_password']);
    Route::post('logout',[AuthApi::class,'logout']);
    Route::post('updateprofile',[AuthApi::class,'updateprofile']);
   
});
//fin Authentification

//..........Competences.........// 
Route::middleware('auth:sanctum')->group(function(){
    Route::post('createCompetence',[CompetenceController::class,'createCompetence']);
    Route::get('competence',[CompetenceController::class,'competence']);
    Route::put('updateCompetence/{id}',[CompetenceController::class,'updateCompetence']);
});



//.........Projet..............//
    //.........la liste de tout les projet
Route::get('listProjet',[ProjetController::class,'listProjet']);
Route::middleware('auth:sanctum')->group(function(){
    //.....creation de projet...........//
    Route::post('createProjet',[ProjetController::class,'createProjet']);
    //......Liste des projet d'un utulisateur.....//
    Route::get('userProjet',[ProjetController::class,'userProjet']);
    //.......Detaille sur un projet..........//
    Route::get('ditailleProjet/{id}',[ProjetController::class,'ditailleProjet']);
    //.......Mise à jour d'un projet..........//
    Route::put('updateProjet/{id}',[ProjetController::class,'updateProjet']);
    //...........Suppression de projet.............//
    Route::get('deleteProjet/{id}',[ProjetController::class,'deleteProjet']);
});
