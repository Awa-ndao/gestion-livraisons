@extends('layouts.app')

@section('content')

<div class="text-center mb-4">
    <h2 style="color: #8B2E2E;">Bienvenue sur Maison D'Awa</h2>
    <p class="text-muted">Tableau de bord — Gestion des Livraisons</p>
</div>

<!-- Ligne 1 : chiffres clés -->
<div class="row g-3 mb-3">
    <div class="col-md-3">
        <div class="card text-center" style="border-left: 5px solid #8B2E2E;">
            <div class="card-body py-3">
                <i class="bi bi-people" style="font-size: 1.8rem; color: #8B2E2E;"></i>
                <h3 class="mt-1 mb-0" style="color: #8B2E2E;">{{ $stats['clients'] }}</h3>
                <small class="text-muted">Clients</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center" style="border-left: 5px solid #C4973A;">
            <div class="card-body py-3">
                <i class="bi bi-person-badge" style="font-size: 1.8rem; color: #C4973A;"></i>
                <h3 class="mt-1 mb-0" style="color: #C4973A;">{{ $stats['livreurs'] }}</h3>
                <small class="text-muted">Livreurs</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center" style="border-left: 5px solid #4A6741;">
            <div class="card-body py-3">
                <i class="bi bi-box" style="font-size: 1.8rem; color: #4A6741;"></i>
                <h3 class="mt-1 mb-0" style="color: #4A6741;">{{ $stats['colis'] }}</h3>
                <small class="text-muted">Colis</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center" style="border-left: 5px solid #8B2E2E;">
            <div class="card-body py-3">
                <i class="bi bi-truck" style="font-size: 1.8rem; color: #8B2E2E;"></i>
                <h3 class="mt-1 mb-0" style="color: #8B2E2E;">{{ $stats['livraisons'] }}</h3>
                <small class="text-muted">Livraisons</small>
            </div>
        </div>
    </div>
</div>

<!-- Ligne 2 : paiements + statuts colis -->
<div class="row g-3">
    @if(auth()->guard('admin')->user()->role === 'admin')
    <div class="col-md-4">
        <div class="card text-center" style="border-left: 5px solid #198754;">
            <div class="card-body py-3">
                <i class="bi bi-cash-coin" style="font-size: 1.8rem; color: #198754;"></i>
                <h4 class="mt-1 mb-0" style="color: #198754;">{{ number_format($stats['paiements_total'], 0, ',', ' ') }} FCFA</h4>
                <small class="text-muted">Total encaissé</small>
            </div>
        </div>
    </div>
    @endif
    <div class="col-md-4">
        <div class="card text-center" style="border-left: 5px solid #C4973A;">
            <div class="card-body py-3">
                <i class="bi bi-hourglass-split" style="font-size: 1.8rem; color: #C4973A;"></i>
                <h4 class="mt-1 mb-0" style="color: #C4973A;">{{ $stats['colis_attente'] }}</h4>
                <small class="text-muted">Colis en attente</small>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center" style="border-left: 5px solid #4A6741;">
            <div class="card-body py-3">
                <i class="bi bi-check-circle" style="font-size: 1.8rem; color: #4A6741;"></i>
                <h4 class="mt-1 mb-0" style="color: #4A6741;">{{ $stats['colis_livres'] }}</h4>
                <small class="text-muted">Colis livrés</small>
            </div>
        </div>
    </div>
</div>

@endsection