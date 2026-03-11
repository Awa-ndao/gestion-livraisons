@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-cash-coin"></i> Liste des Paiements</h5>
        <a href="{{ route('paiements.create') }}" class="btn btn-warning btn-sm">
            <i class="bi bi-plus-circle"></i> Nouveau Paiement
        </a>
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Livraison</th>
                    <th>Montant</th>
                    <th>Mode</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($paiements as $paiement)
                <tr>
                    <td>{{ $paiement->id }}</td>
                    <td>Livraison #{{ $paiement->livraison->id }} — {{ $paiement->livraison->colis->description ?? '' }}</td>
                    <td>{{ number_format($paiement->montant, 0, ',', ' ') }} FCFA</td>
                    <td>
                        @if($paiement->mode_paiement == 'cash')
                            <span class="badge bg-secondary">Cash</span>
                        @elseif($paiement->mode_paiement == 'orange_money')
                            <span class="badge" style="background-color:#FF6600">Orange Money</span>
                        @else
                            <span class="badge" style="background-color:#0066CC">Wave</span>
                        @endif
                    </td>
                    <td>
                        @if($paiement->statut == 'payé')
                            <span class="badge bg-success">Payé</span>
                        @else
                            <span class="badge bg-warning">En attente</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('paiements.edit', $paiement) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('paiements.destroy', $paiement) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce paiement ?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center">Aucun paiement trouvé</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection