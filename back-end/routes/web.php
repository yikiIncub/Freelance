<?php

use App\Http\Controllers\AuthApi;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('getresetPassword/{reset_code}',[AuthApi::class,'getresetPassword']);

Route::get('getPassword',[AuthApi::class,'getPassword']); 

Route::get('reset-password/{token}',[AuthApi::class,'getPassword']); 

Route::get('forget-password',[AuthApi::class,'geteMail']);  