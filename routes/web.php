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
    return view('auth/login'); // Le nom du fichier Blade (ex: resources/views/login.blade.php)
})->name('login');


Route::get('/auth/register', function () {
    return view('auth/register'); // Le nom du fichier Blade (ex: resources/views/login.blade.php)
})->name('login');