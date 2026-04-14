<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\LivreurController;
use App\Http\Controllers\ColisController;
use App\Http\Controllers\LivraisonController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\AdminController;

// Routes login
Route::get('/login', [AdminController::class, 'showLogin'])->name('login');
Route::post('/login', [AdminController::class, 'login']);
Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

// Routes protégées
Route::middleware(['auth:admin'])->group(function () {

    Route::get('/', function () {
        $stats = [
            'clients' => \App\Models\Client::count(),
            'livreurs' => \App\Models\Livreur::count(),
            'colis' => \App\Models\Colis::count(),
            'livraisons' => \App\Models\Livraison::count(),
            'paiements_total' => \App\Models\Paiement::sum('montant'),
            'colis_attente' => \App\Models\Colis::where('statut', 'en_attente')->count(),
            'colis_cours' => \App\Models\Colis::where('statut', 'en_cours')->count(),
            'colis_livres' => \App\Models\Colis::where('statut', 'livré')->count(),
        ];
        return view('dashboard', compact('stats'));
    });

    Route::resource('clients', ClientController::class);
    Route::resource('livreurs', LivreurController::class);
    Route::resource('colis', ColisController::class);
    Route::resource('livraisons', LivraisonController::class);
    Route::resource('paiements', PaiementController::class);

});