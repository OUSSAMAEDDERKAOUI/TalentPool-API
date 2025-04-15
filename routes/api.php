<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;

use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\API\AnnonceController;
use App\Http\Controllers\API\RecruteurController;
use App\Http\Controllers\API\CandidatureController;




Route::middleware('auth:api')->get('/me', function (Request $request) {
    return response()->json($request->user());
});



    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware('auth:api')->group(function(){
        Route::post('refresh', [AuthController::class, 'refresh'])->middleware('auth:api');
        Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');
    });
       
    
    Route::group(['middleware'=>['auth:api','CheckRole:recruteur']],function(){
        Route::get('annonce/{annonceId}/candidatures', [AnnonceController::class, 'getCandidaturesByAnnonce']);
        Route::apiResource('annonce', AnnonceController::class);  

        Route::post('candidature/{candidature}', [CandidatureController::class, 'update']);  

});

Route::apiResource('recruteur', RecruteurController::class);  


Route::get('annonces', [AnnonceController::class, 'showAll']);

        Route::apiResource('candidature', CandidatureController::class);  

Route::group(['middleware'=>['auth:api','CheckRole:candidat']],function(){
    // Route::apiResource('candidature', CandidatureController::class);  

    // Route::post('candidature/{candidature}', [CandidatureController::class, 'update']);  

});


Route::middleware(['auth:api','CheckRole:admin'])->get('/admin/statistics', [AdminController::class, 'index']);
