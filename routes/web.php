<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\LivreurController;
use App\Http\Controllers\ColisController;
use App\Http\Controllers\LivraisonController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClotureController;
use App\Http\Controllers\BilanController;
use App\Http\Controllers\DepenseController;

// Routes login
Route::get('/login', [AdminController::class, 'showLogin'])->name('login');
Route::post('/login', [AdminController::class, 'login']);
Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

// Routes employés et admin (tous les connectés)
Route::middleware(['employe'])->group(function () {

    Route::get('/', function () {
        $stats = [
            'clients' => \App\Models\Client::count(),
            'livreurs' => \App\Models\Livreur::count(),
            'colis' => \App\Models\Colis::count(),
            'livraisons' => \App\Models\Livraison::count(),
            'colis_attente' => \App\Models\Colis::where('statut', 'en_attente')->count(),
            'colis_cours' => \App\Models\Colis::where('statut', 'en_cours')->count(),
            'colis_livres' => \App\Models\Colis::where('statut', 'livré')->count(),
        ];

        if (auth()->guard('admin')->user()->role === 'admin') {
            $stats['paiements_total'] = \App\Models\Paiement::sum('montant');
        }

        return view('dashboard', compact('stats'));
    });

    Route::resource('clients', ClientController::class);
    Route::resource('livreurs', LivreurController::class);
    Route::resource('colis', ColisController::class);
    Route::resource('livraisons', LivraisonController::class);
    Route::resource('paiements', PaiementController::class);
});

// Routes admin uniquement
Route::middleware(['admin'])->group(function () {
    Route::get('/utilisateurs', [AdminController::class, 'utilisateurs'])->name('utilisateurs.index');
    Route::get('/utilisateurs/create', [AdminController::class, 'createUtilisateur'])->name('utilisateurs.create');
    Route::post('/utilisateurs', [AdminController::class, 'storeUtilisateur'])->name('utilisateurs.store');
    Route::get('/utilisateurs/{id}/edit', [AdminController::class, 'editUtilisateur'])->name('utilisateurs.edit');
    Route::put('/utilisateurs/{id}', [AdminController::class, 'updateUtilisateur'])->name('utilisateurs.update');
    Route::delete('/utilisateurs/{id}', [AdminController::class, 'destroyUtilisateur'])->name('utilisateurs.destroy');

    Route::get('/clotures', [ClotureController::class, 'index'])->name('clotures.index');
    Route::post('/clotures', [ClotureController::class, 'store'])->name('clotures.store');

    Route::get('/depenses', [DepenseController::class, 'index'])->name('depenses.index');
    Route::get('/depenses/create', [DepenseController::class, 'create'])->name('depenses.create');
    Route::post('/depenses', [DepenseController::class, 'store'])->name('depenses.store');
    Route::delete('/depenses/{depense}', [DepenseController::class, 'destroy'])->name('depenses.destroy');

    Route::get('/bilans', [BilanController::class, 'index'])->name('bilans.index');
    Route::post('/bilans', [BilanController::class, 'store'])->name('bilans.store');
});