<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AuthApi;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NiveauController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ProjetController;
use App\Http\Controllers\DomaineController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\FreelanceController;
use App\Http\Controllers\PostulantController;
use App\Http\Controllers\CompetenceController;
use App\Http\Controllers\ProjetUserController;
use App\Http\Controllers\SpecialiteController;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\DomaineUserController;
use App\Http\Controllers\CompetenceUserController;
use App\Http\Controllers\PostulantProjetController;
use App\Http\Controllers\CompetenceDomaineController;
use App\Http\Controllers\DomaineSpecialiteController;






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
    //.......Mise à jour d'un projet..........//
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
    Route::put('updateDomaine/{id}',[DomaineController::class,'updateDomaine']);
    Route::delete('deleteDomaine/{id}',[DomaineController::class,'deleteDomaine']); 

    //..........Domaine User.................//
    Route::post('domaine_user',[DomaineUserController::class,'domaine_user']); 
    Route::get('domaine',[DomaineUserController::class,'domaine']); 
    Route::delete('dettacheDomaine/{id}',[DomaineUserController::class,'dettacheDomaine']); 
});


//..........Competences.........// 
Route::post('createCompetence',[CompetenceController::class,'createCompetence']);
Route::middleware('auth:sanctum')->group(function(){
    Route::get('competence',[CompetenceController::class,'competence']);
    Route::put('updateCompetence/{id}',[CompetenceController::class,'updateCompetence']);
    Route::delete('deleteCompetence/{id}',[CompetenceController::class,'deleteCompetence']);

    //..........Domaine Competence.................//
    Route::post('domaine_competence',[CompetenceDomaineController::class,'domaine_competence']); 
    Route::get('competenceDomaine',[CompetenceDomaineController::class,'competenceDomaine']); 
    Route::delete('dettacheDomaine/{id}',[CompetenceDomaineController::class,'dettacheDomaine']); 
});

//............Les Specialite..........//
Route::get('listSpecialite',[SpecialiteController::class,'listSpecialite']);
Route::middleware('auth:sanctum')->group(function(){
    Route::post('createSpecialite',[SpecialiteController::class,'createSpecialite']);
    Route::delete('deleteSpecialite/{id}',[SpecialiteController::class,'deleteSpecialite']); 
    Route::put('updateSpecialite/{id}',[SpecialiteController::class,'updateSpecialite']); 

    //..........Domaine Specialite.................//
    Route::post('domaine_specialite',[DomaineSpecialiteController::class,'domaine_specialite']); 
    Route::get('domaine',[DomaineSpecialiteController::class,'domaine']); 
    Route::delete('dettacheDomaine/{id}',[DomaineSpecialiteController::class,'dettacheDomaine']); 

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


//.................Postuler à un projet..............//
Route::middleware('auth:sanctum')->group(function(){
    Route::post('postuler',[PostulantController::class,'postuler']);
    Route::post('updateInfo/{id}',[PostulantController::class,'updateInfo']);
    Route::post('listePostulant',[PostulantController::class,'listePostulant']);
});


//.........Attribuer un projet à un Freelance.............//
Route::middleware('auth:sanctum')->group(function(){
    Route::post('postulant_projet',[PostulantProjetController::class,'postulant_projet']);
    Route::post('dettachepostulant',[PostulantProjetController::class,'dettachepostulant']);
    Route::get('postulant',[PostulantProjetController::class,'postulant']);
});



//..............Administration.................///
Route::post('createAdmin',[AdminController::class,'createAdmin']);
Route::post('loginAdmin',[AdminController::class,'loginAdmin']);
Route::middleware('auth:sanctum')->group(function(){
    Route::post('profilAdmin',[AdminController::class,'profilAdmin']);
});

Route::middleware('auth:sanctum')->group(function(){
    //............Details du postulant..........//
    Route::get('detailPostulant/{id}',[PostulantController::class,'detailPostulant']);
    Route::get('profilPostulant/{id}',[PostulantController::class,'profilPostulant']);
});


Route::middleware('auth:sanctum')->group(function(){
    //............Details du postulant..........//
    Route::post('userCompetence',[ProfilController::class,'userCompetence']);
    Route::get('listCompetence/{user_id}',[ProfilController::class,'listCompetence']);
});