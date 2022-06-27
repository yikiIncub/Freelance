<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AuthApi;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NiveauController;
use App\Http\Controllers\ProjetController;
use App\Http\Controllers\DomaineController;
use App\Http\Controllers\CompetenceController;
use App\Http\Controllers\SpecialiteController;
use App\Http\Controllers\CommentaireController;





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
Route::get('detProjet/{id}',[ProjetController::class,'detProjet']);
Route::get('listProjet',[ProjetController::class,'listProjet']);
Route::middleware('auth:sanctum')->group(function(){
    //.....creation de projet...........//
    Route::post('createProjet',[ProjetController::class,'createProjet']);
    //......Liste des projet d'un utulisateur.....//
    Route::get('userProjet',[ProjetController::class,'userProjet']);
    //.......Detaille sur un projet..........//
    Route::get('detailleProjet/{id}',[ProjetController::class,'detailleProjet']);
    //.......Mise à jour d'un projet..........//
    Route::put('updateProjet/{id}',[ProjetController::class,'updateProjet']);
    //...........Suppression de projet.............//
    Route::get('deleteProjet/{id}',[ProjetController::class,'deleteProjet']);
});



//............Les commentaire..........//
Route::middleware('auth:sanctum')->group(function(){
    //........Creer commentaire.............//
    Route::post('create/{projet_id}',[CommentaireController::class,'create']);
    //............liste des commentaire...........//
    Route::get('list/{projet_id}',[CommentaireController::class,'list']);
    //............Suppression de commentaire............//
    Route::delete('deleteCommantaire/{projet_id}',[CommentaireController::class,'list']); 

});

//............Les Domaine..........//
Route::middleware('auth:sanctum')->group(function(){
    //........Creer Domaine.............//
    Route::post('createDomaine/{competence_id}',[DomaineController::class,'createDomaine']);
    //............liste des Domaine...........//
    Route::get('listDomaine',[DomaineController::class,'listDomaine']);
    //............Suppression de Domaine............//
    Route::delete('deleteDomaine',[DomaineController::class,'deleteDomaine']); 

});

//............Les Niveau..........//
Route::middleware('auth:sanctum')->group(function(){
    //........Creer Niveau.............//
    Route::post('createNiveau/{domaine_id}',[NiveauController::class,'createNiveau']);
    //............liste des Niveau...........//
    Route::get('listDomaine',[NiveauController::class,'listNiveau']);
    //............Suppression de Niveau............//
    Route::delete('deleteDomaine',[NiveauController::class,'deleteNiveau']); 

});

//............Les Specialite..........//
Route::middleware('auth:sanctum')->group(function(){
    //........Creer Specialite.............//
    Route::post('createSpecialite/{domaine_id}',[SpecialiteController::class,'createSpecialite']);
    //............liste des Niveau...........//
    Route::get('listSpecialitee',[SpecialiteController::class,'listSpecialite']);
    //............Suppression de Niveau............//
    Route::delete('deleteDSpecialite',[SpecialiteController::class,'deleteSpecialite']); 

});
