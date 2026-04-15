@extends('layouts.app')

@section('content')

<!-- Résumé du jour -->
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-calendar-check"></i> Clôture du {{ now()->format('d/m/Y') }}</h5>
        <form action="{{ route('clotures.store') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger" onclick="return confirm('Confirmer la clôture de la journée ?')">
                <i class="bi bi-lock"></i> Clôturer la journée
            </button>
        </form>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-4">
                <div class="card text-center" style="border-left: 5px solid #198754;">
                    <div class="card-body py-3">
                        <i class="bi bi-cash-coin" style="font-size: 1.8rem; color: #198754;"></i>
                        <h4 class="mt-1 mb-0" style="color: #198754;">{{ number_format($total_encaisse_aujourd_hui, 0, ',', ' ') }} FCFA</h4>
                        <small class="text-muted">Encaissé aujourd'hui</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center" style="border-left: 5px solid #8B2E2E;">
                    <div class="card-body py-3">
                        <i class="bi bi-truck" style="font-size: 1.8rem; color: #8B2E2E;"></i>
                        <h4 class="mt-1 mb-0" style="color: #8B2E2E;">{{ $livraisons_aujourd_hui }}</h4>
                        <small class="text-muted">Livraisons aujourd'hui</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center" style="border-left: 5px solid #4A6741;">
                    <div class="card-body py-3">
                        <i class="bi bi-check-circle" style="font-size: 1.8rem; color: #4A6741;"></i>
                        <h4 class="mt-1 mb-0" style="color: #4A6741;">{{ $colis_livres_aujourd_hui }}</h4>
                        <small class="text-muted">Colis livrés aujourd'hui</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Historique -->
<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="bi bi-clock-history"></i> Historique des clôtures</h5>
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Total encaissé</th>
                    <th>Livraisons</th>
                    <th>Colis livrés</th>
                    <th>Clôturé par</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clotures as $cloture)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($cloture->date_cloture)->format('d/m/Y') }}</td>
                    <td style="color: #198754; font-weight: bold;">{{ number_format($cloture->total_encaisse, 0, ',', ' ') }} FCFA</td>
                    <td>{{ $cloture->nombre_livraisons }}</td>
                    <td>{{ $cloture->nombre_colis_livres }}</td>
                    <td>{{ $cloture->admin->nom }}</td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center">Aucune clôture effectuée</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection