@extends('layouts.app')

@section('content')
<div class="text-center mb-4">
    <h2 style="color: #8B2E2E;"> Bienvenue sur Maison D'Awa</h2>
    
</div>

<div class="row g-4">
    <div class="col-md-3">
        <div class="card text-center h-100">
            <div class="card-body">
                <i class="bi bi-people" style="font-size: 3rem; color: #8B2E2E;"></i>
                <h5 class="mt-2">Clients</h5>
                <a href="{{ route('clients.index') }}" class="btn btn-primary mt-2">Gérer</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center h-100">
            <div class="card-body">
                <i class="bi bi-person-badge" style="font-size: 3rem; color: #8B2E2E;"></i>
                <h5 class="mt-2">Livreurs</h5>
                <a href="{{ route('livreurs.index') }}" class="btn btn-primary mt-2">Gérer</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center h-100">
            <div class="card-body">
                <i class="bi bi-box" style="font-size: 3rem; color: #8B2E2E;"></i>
                <h5 class="mt-2">Colis</h5>
                <a href="{{ route('colis.index') }}" class="btn btn-primary mt-2">Gérer</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center h-100">
            <div class="card-body">
                <i class="bi bi-truck" style="font-size: 3rem; color: #8B2E2E;"></i>
                <h5 class="mt-2">Livraisons</h5>
                <a href="{{ route('livraisons.index') }}" class="btn btn-primary mt-2">Gérer</a>
            </div>
        </div>
    </div>
</div>
@endsection