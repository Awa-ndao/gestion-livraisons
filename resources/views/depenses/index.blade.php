@extends('layouts.app')

@section('content')
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-wallet2"></i> Gestion des Dépenses</h5>
        <a href="{{ route('depenses.create') }}" class="btn btn-warning btn-sm">
            <i class="bi bi-plus-circle"></i> Nouvelle Dépense
        </a>
    </div>
    <div class="card-body">
        <div class="alert" style="background-color: #fff3cd; border-left: 5px solid #C4973A;">
            <i class="bi bi-cash-coin"></i> <strong>Total dépensé :</strong>
            <span style="color: #8B2E2E; font-size: 1.2rem; font-weight: bold;">
                {{ number_format($total, 0, ',', ' ') }} FCFA
            </span>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Catégorie</th>
                    <th>Montant</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($depenses as $depense)
                <tr>
                    <td>{{ $depense->id }}</td>
                    <td>{{ \Carbon\Carbon::parse($depense->date_depense)->format('d/m/Y') }}</td>
                    <td>{{ $depense->description }}</td>
                    <td>
                        @if($depense->categorie == 'fruits')
                            <span class="badge bg-success">Fruits</span>
                        @elseif($depense->categorie == 'emballages')
                            <span class="badge bg-info">Emballages</span>
                        @elseif($depense->categorie == 'transport')
                            <span class="badge bg-warning">Transport</span>
                        @elseif($depense->categorie == 'livreurs')
                            <span class="badge bg-primary">Livreurs</span>
                        @else
                            <span class="badge bg-secondary">Autre</span>
                        @endif
                    </td>
                    <td style="color: #8B2E2E; font-weight: bold;">{{ number_format($depense->montant, 0, ',', ' ') }} FCFA</td>
                    <td>
                        <form action="{{ route('depenses.destroy', $depense) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cette dépense ?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center">Aucune dépense enregistrée</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection