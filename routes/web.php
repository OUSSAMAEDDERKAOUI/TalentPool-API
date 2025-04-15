<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::get('/auth/login', function () {
    return view('auth/login'); 
})->name("login");

Route::get('/auth/register', function () {
    return view('auth/register'); 
})->name("register");


Route::get('/recruteur/dashboard', function () {
    return view('/recruteur/dashboard'); 
})->name('recruteur/dashboard');

// Route::group(['middleware'=>['auth:api']],function(){

Route::get('/recruteur/annonces' , function(){
    return view('/recruteur/annonces');
});
// });
Route::get('/recruteur/candidatures' , function(){
    return view('/recruteur/candidatures');
});
Route::get('/recruteur/profile' , function(){
    return view('/recruteur/profile');
});



Route::get('/candidat/annonces' , function(){
    return view('/candidat/annonce');
});


Route::get('/candidat/details' , function(){
    return view('/candidat/details');
});
