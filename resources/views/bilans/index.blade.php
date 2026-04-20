@extends('layouts.app')

@section('content')

<div class="text-center mb-4">
    <h2 style="color: #8B2E2E;"><i class="bi bi-bar-chart"></i> Bilans</h2>
</div>

<!-- Bilan semaine -->
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-calendar-week"></i> Semaine en cours
            <small class="text-white-50">({{ $debut_semaine->format('d/m') }} — {{ $fin_semaine->format('d/m/Y') }})</small>
        </h5>
        <form action="{{ route('bilans.store') }}" method="POST" class="d-inline">
            @csrf
            <input type="hidden" name="type" value="hebdomadaire">
            <input type="hidden" name="date_debut" value="{{ $debut_semaine->format('Y-m-d') }}">
            <input type="hidden" name="date_fin" value="{{ $fin_semaine->format('Y-m-d') }}">
            <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Enregistrer le bilan de cette semaine ?')">
                <i class="bi bi-save"></i> Enregistrer
            </button>
        </form>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-3">
                <div class="card text-center" style="border-left: 5px solid #198754;">
                    <div class="card-body py-2">
                        <i class="bi bi-cash-coin" style="color: #198754;"></i>
                        <h5 style="color: #198754;">{{ number_format($semaine['total_encaisse'], 0, ',', ' ') }} FCFA</h5>
                        <small class="text-muted">Encaissé</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center" style="border-left: 5px solid #dc3545;">
                    <div class="card-body py-2">
                        <i class="bi bi-wallet2" style="color: #dc3545;"></i>
                        <h5 style="color: #dc3545;">{{ number_format($semaine['total_depenses'], 0, ',', ' ') }} FCFA</h5>
                        <small class="text-muted">Dépenses</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center" style="border-left: 5px solid #C4973A;">
                    <div class="card-body py-2">
                        <i class="bi bi-graph-up" style="color: #C4973A;"></i>
                        <h5 style="color: #C4973A;">{{ number_format($semaine['benefice'], 0, ',', ' ') }} FCFA</h5>
                        <small class="text-muted">Bénéfice net</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center" style="border-left: 5px solid #8B2E2E;">
                    <div class="card-body py-2">
                        <i class="bi bi-truck" style="color: #8B2E2E;"></i>
                        <h5 style="color: #8B2E2E;">{{ $semaine['livraisons'] }}</h5>
                        <small class="text-muted">Livraisons</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center" style="border-left: 5px solid #4A6741;">
                    <div class="card-body py-2">
                        <i class="bi bi-check-circle" style="color: #4A6741;"></i>
                        <h5 style="color: #4A6741;">{{ $semaine['colis_livres'] }}</h5>
                        <small class="text-muted">Colis livrés</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center" style="border-left: 5px solid #dc3545;">
                    <div class="card-body py-2">
                        <i class="bi bi-x-circle" style="color: #dc3545;"></i>
                        <h5 style="color: #dc3545;">{{ $semaine['colis_annules'] }}</h5>
                        <small class="text-muted">Colis annulés</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center" style="border-left: 5px solid #C4973A;">
                    <div class="card-body py-2">
                        <i class="bi bi-person-plus" style="color: #C4973A;"></i>
                        <h5 style="color: #C4973A;">{{ $semaine['nouveaux_clients'] }}</h5>
                        <small class="text-muted">Nouveaux clients</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bilan mois -->
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-calendar-month"></i> Mois en cours
            <small class="text-white-50">({{ $debut_mois->format('d/m') }} — {{ $fin_mois->format('d/m/Y') }})</small>
        </h5>
        <form action="{{ route('bilans.store') }}" method="POST" class="d-inline">
            @csrf
            <input type="hidden" name="type" value="mensuel">
            <input type="hidden" name="date_debut" value="{{ $debut_mois->format('Y-m-d') }}">
            <input type="hidden" name="date_fin" value="{{ $fin_mois->format('Y-m-d') }}">
            <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Enregistrer le bilan de ce mois ?')">
                <i class="bi bi-save"></i> Enregistrer
            </button>
        </form>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-3">
                <div class="card text-center" style="border-left: 5px solid #198754;">
                    <div class="card-body py-2">
                        <i class="bi bi-cash-coin" style="color: #198754;"></i>
                        <h5 style="color: #198754;">{{ number_format($mois['total_encaisse'], 0, ',', ' ') }} FCFA</h5>
                        <small class="text-muted">Encaissé</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center" style="border-left: 5px solid #dc3545;">
                    <div class="card-body py-2">
                        <i class="bi bi-wallet2" style="color: #dc3545;"></i>
                        <h5 style="color: #dc3545;">{{ number_format($mois['total_depenses'], 0, ',', ' ') }} FCFA</h5>
                        <small class="text-muted">Dépenses</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center" style="border-left: 5px solid #C4973A;">
                    <div class="card-body py-2">
                        <i class="bi bi-graph-up" style="color: #C4973A;"></i>
                        <h5 style="color: #C4973A;">{{ number_format($mois['benefice'], 0, ',', ' ') }} FCFA</h5>
                        <small class="text-muted">Bénéfice net</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center" style="border-left: 5px solid #8B2E2E;">
                    <div class="card-body py-2">
                        <i class="bi bi-truck" style="color: #8B2E2E;"></i>
                        <h5 style="color: #8B2E2E;">{{ $mois['livraisons'] }}</h5>
                        <small class="text-muted">Livraisons</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center" style="border-left: 5px solid #4A6741;">
                    <div class="card-body py-2">
                        <i class="bi bi-check-circle" style="color: #4A6741;"></i>
                        <h5 style="color: #4A6741;">{{ $mois['colis_livres'] }}</h5>
                        <small class="text-muted">Colis livrés</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center" style="border-left: 5px solid #dc3545;">
                    <div class="card-body py-2">
                        <i class="bi bi-x-circle" style="color: #dc3545;"></i>
                        <h5 style="color: #dc3545;">{{ $mois['colis_annules'] }}</h5>
                        <small class="text-muted">Colis annulés</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center" style="border-left: 5px solid #C4973A;">
                    <div class="card-body py-2">
                        <i class="bi bi-person-plus" style="color: #C4973A;"></i>
                        <h5 style="color: #C4973A;">{{ $mois['nouveaux_clients'] }}</h5>
                        <small class="text-muted">Nouveaux clients</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Historique -->
<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="bi bi-clock-history"></i> Historique des bilans</h5>
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Période</th>
                    <th>Encaissé</th>
                    <th>Livraisons</th>
                    <th>Colis livrés</th>
                    <th>Nouveaux clients</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bilans as $bilan)
                <tr>
                    <td>
                        @if($bilan->type == 'hebdomadaire')
                            <span class="badge" style="background-color: #C4973A;">Semaine</span>
                        @else
                            <span class="badge" style="background-color: #8B2E2E;">Mois</span>
                        @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($bilan->date_debut)->format('d/m/Y') }} — {{ \Carbon\Carbon::parse($bilan->date_fin)->format('d/m/Y') }}</td>
                    <td style="color: #198754; font-weight: bold;">{{ number_format($bilan->total_encaisse, 0, ',', ' ') }} FCFA</td>
                    <td>{{ $bilan->nombre_livraisons }}</td>
                    <td>{{ $bilan->nombre_colis_livres }}</td>
                    <td>{{ $bilan->nouveaux_clients }}</td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center">Aucun bilan enregistré</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection