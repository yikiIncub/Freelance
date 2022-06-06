<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthApi;





//Authentification
Route::post('register',[AuthApi::class,'register']);
Route::post('registerfreelance',[AuthApi::class,'registerfreelance']);
Route::post("login",[AuthApi::class,'login']);
Route::post("forgot-password",[AuthApi::class,'forgotpassword']);

Route::middleware('auth:sanctum')->group(function(){
    Route::get('profil' ,[AuthApi::class,'profil']);
    Route::post('logout',[AuthApi::class,'logout']);
   
});
//fin Authentification
