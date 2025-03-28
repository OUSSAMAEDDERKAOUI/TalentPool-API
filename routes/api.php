<?php

use App\Http\Controllers\API\AnnonceController;
use App\Http\Controllers\API\CandidatureController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;







// Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('logout', [AuthController::class, 'logout']);
// });

Route::middleware('auth:api')->group(function () {
    Route::apiResource('annonce', AnnonceController::class);  

    Route::apiResource('candidature', CandidatureController::class);  
    Route::post('candidature/{candidature}', [CandidatureController::class, 'update']);  

    Route::get('annonce/{annonceId}/candidatures', [AnnonceController::class, 'getCandidaturesByAnnonce']);
});
