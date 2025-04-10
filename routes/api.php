<?php

use App\Http\Controllers\API\AnnonceController;
use App\Http\Controllers\API\CandidatureController;
use App\Http\Controllers\API\AdminController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;







    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware('auth:api')->group(function(){
        Route::post('refresh', [AuthController::class, 'refresh'])->middleware('auth:api');
        Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');
    });
       
    
    Route::group(['middleware'=>['auth:api','CheckRole:recruteur']],function(){
        Route::apiResource('annonce', AnnonceController::class);  

    Route::get('annonce/{annonceId}/candidatures', [AnnonceController::class, 'getCandidaturesByAnnonce']);

});



Route::group(['middleware'=>['auth:api','CheckRole:candidat']],function(){

    Route::apiResource('candidature', CandidatureController::class);  
    Route::post('candidature/{candidature}', [CandidatureController::class, 'update']);  

});


Route::middleware(['auth:api','CheckRole:admin'])->get('/admin/statistics', [AdminController::class, 'index']);
