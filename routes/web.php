<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\LivreurController;
use App\Http\Controllers\ColisController;
use App\Http\Controllers\LivraisonController;

Route::get('/', function () {
    return view('dashboard');
});

Route::resource('clients', ClientController::class);
Route::resource('livreurs', LivreurController::class);
Route::resource('colis', ColisController::class);
Route::resource('livraisons', LivraisonController::class);


use App\Http\Controllers\PaiementController;
Route::resource('paiements', PaiementController::class);