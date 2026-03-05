@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-truck"></i> Liste des Livraisons</h5>
        <a href="{{ route('livraisons.create') }}" class="btn btn-warning btn-sm">
            <i class="bi bi-plus-circle"></i> Nouvelle Livraison
        </a>
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Colis</th>
                    <th>Livreur</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($livraisons as $livraison)
                <tr>
                    <td>{{ $livraison->id }}</td>
                    <td>{{ $livraison->date_livraison }}</td>
                    <td>{{ $livraison->colis->description }}</td>
                    <td>{{ $livraison->livreur->nom }} {{ $livraison->livreur->prenom }}</td>
                    <td>
                        @if($livraison->statut == 'planifiée')
                            <span class="badge bg-warning">Planifiée</span>
                        @elseif($livraison->statut == 'en_cours')
                            <span class="badge bg-primary">En cours</span>
                        @elseif($livraison->statut == 'livrée')
                            <span class="badge bg-success">Livrée</span>
                        @else
                            <span class="badge bg-danger">Annulée</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('livraisons.edit', $livraison) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('livraisons.destroy', $livraison) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cette livraison ?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center">Aucune livraison trouvée</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection