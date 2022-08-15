<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('v1/registro',[ UserController::class,'register']);
Route::post('v1/login',[ UserController::class,'login']);

Route::middleware('auth:sanctum')->group( function () {

    //rutas animales
     Route::post('v1/animales-reg',[ UserController::class,'registerAnimal']);
     Route::post('v1/animales-updt/{id}',[ UserController::class,'updateAnimal']);
     Route::get('v1/animales-edit/{id}',[ UserController::class,'editAnimal']);
     Route::post('v1/animales-dest/{id}',[ UserController::class,'destroyAnimal']);
     Route::get('v1/animales-show',[ UserController::class,'showAnimal']);

    //rutas tipoanimales

    Route::get('v1/tipo-animales-show',[ UserController::class,'showTipoAnimal']);
});
