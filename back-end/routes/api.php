<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AuthApi;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NiveauController;
use App\Http\Controllers\ProjetController;
use App\Http\Controllers\DomaineController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\FreelanceController;
use App\Http\Controllers\PostulantController;
use App\Http\Controllers\CompetenceController;
use App\Http\Controllers\ProjetUserController;
use App\Http\Controllers\SpecialiteController;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\CompetenceUserController;
use App\Http\Controllers\PostulantProjetController;






//...............Authentification............/
Route::post('register',[AuthApi::class,'register']);
// Route::post('registerfreelance',[AuthApi::class,'registerfreelance']);
Route::post('login',[AuthApi::class,'login']);
Route::post('forgotpassword',[AuthApi::class,'forgotpassword']);
Route::get('getresetPassword/{reset_code}',[AuthApi::class,'getresetPassword']);
Route::post('resetPassword',[AuthApi::class,'resetPassword']);

Route::middleware('auth:sanctum')->group(function(){
    Route::get('profil' ,[AuthApi::class,'profil']);
    Route::post('logout',[AuthApi::class,'logout']);
    Route::post('updateprofile',[AuthApi::class,'updateprofile']);
   
});


//.........Projet..............//
    //...........Detaille sur un projet quelconque.........// 
Route::get('detProjet/{id}',[ProjetController::class,'detProjet']);
    //.........la liste de tout les projet
Route::get('listProjet',[ProjetController::class,'listProjet']);
Route::middleware('auth:sanctum')->group(function(){
    //.....creation de projet...........//
    Route::post('createProjet',[ProjetController::class,'createProjet']);
    //......Liste des projet d'un utulisateur.....//
    Route::get('userProjet',[ProjetController::class,'userProjet']);
    //......Liste des projet par categories
    Route::get('projetParCategorie/{categorie_id}',[ProjetController::class,'projetParCategorie']);
    //.......Detaille sur un projet..........//
    Route::get('detailleProjet/{id}',[ProjetController::class,'detailleProjet']);
    //.......Mise ?? jour d'un projet..........//
    Route::put('updateProjet/{id}',[ProjetController::class,'updateProjet']);
    //...........Suppression de projet.............//
    Route::delete('deleteProjet/{id}',[ProjetController::class,'deleteProjet']);
});




//............Les commentaire..........//
//............liste des commentaire d'un projet...........//
Route::get('list/{projet_id}',[CommentaireController::class,'list']);
Route::middleware('auth:sanctum')->group(function(){
    Route::post('create/{projet_id}',[CommentaireController::class,'create']);
    Route::delete('deleteCommantaire/{projet_id}',[CommentaireController::class,'list']); 
});

//............Les Domaine..........//
Route::get('listDomaine',[DomaineController::class,'listDomaine']);
Route::middleware('auth:sanctum')->group(function(){
    Route::post('createDomaine',[DomaineController::class,'createDomaine']);
    Route::post('updateDomaine/{id}',[DomaineController::class,'updateDomaine']);
    Route::delete('deleteDomaine/{id}',[DomaineController::class,'deleteDomaine']); 

});


//..........Competences.........// 
Route::middleware('auth:sanctum')->group(function(){
    Route::post('createCompetence',[CompetenceController::class,'createCompetence']);
    Route::get('competence',[CompetenceController::class,'competence']);
    Route::put('updateCompetence/{id}',[CompetenceController::class,'updateCompetence']);
    Route::delete('deleteCompetence/{id}',[CompetenceController::class,'deleteCompetence']);
});

//............Les Niveau..........//
    //............liste des Niveau...........//
Route::get('listNiveau',[NiveauController::class,'listNiveau']);
Route::middleware('auth:sanctum')->group(function(){
    Route::post('createNiveau/{domaine_id}',[NiveauController::class,'createNiveau']);
    Route::delete('deleteNiveau/{id}',[NiveauController::class,'deleteNiveau']); 
    Route::delete('updateNiveau/{id}',[NiveauController::class,'updateNiveau']);

});

//............Les Specialite..........//
Route::get('listSpecialite',[SpecialiteController::class,'listSpecialite']);
Route::middleware('auth:sanctum')->group(function(){
    Route::post('createSpecialite',[SpecialiteController::class,'createSpecialite']);
    Route::delete('deleteSpecialite/{id}',[SpecialiteController::class,'deleteSpecialite']); 
    Route::put('updateSpecialite/{id}',[SpecialiteController::class,'updateSpecialite']); 

});

//Competence User
Route::middleware('auth:sanctum')->group(function(){
    Route::post('competence_user/{user_id}/{competence_id}',[CompetenceUserController::class,'competence_user']);

});

Route::get('listCategorie/',[CategorieController::class,'listCategorie']);
Route::middleware('auth:sanctum')->group(function(){
    Route::post('createCategorie',[CategorieController::class,'createCategorie']);
    Route::put('updateCategorie/{id}',[CategorieController::class,'updateCategorie']);
    Route::delete('deleteCategorie/{id}',[CategorieController::class,'deleteCategorie']); 

}); 


Route::get('listeFreelance',[FreelanceController::class,'listeFreelance']);


//.................Postuler ?? un projet..............//
Route::middleware('auth:sanctum')->group(function(){
    Route::post('postuler',[PostulantController::class,'postuler']);
    Route::post('updateInfo/{id}',[PostulantController::class,'updateInfo']);
    Route::get('listePostulant',[PostulantController::class,'listePostulant']);
});


//.........Attribuer un projet ?? un Freelance.............//
Route::middleware('auth:sanctum')->group(function(){
    Route::post('postulant_projet',[PostulantProjetController::class,'postulant_projet']);
    Route::post('dettachepostulant',[PostulantProjetController::class,'dettachepostulant']);
    Route::get('postulant',[PostulantProjetController::class,'postulant']);
});



//..............Administration.................///
Route::post('createAdmin',[AdminController::class,'createAdmin']);
Route::middleware('auth:sanctum')->group(function(){
    //
});