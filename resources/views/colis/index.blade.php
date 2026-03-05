@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-box"></i> Liste des Colis</h5>
        <a href="{{ route('colis.create') }}" class="btn btn-warning btn-sm">
            <i class="bi bi-plus-circle"></i> Nouveau Colis
        </a>
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Description</th>
                    <th>Volume (L)</th>
                    <th>Client</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($colis as $coli)
                <tr>
                    <td>{{ $coli->id }}</td>
                    <td>{{ $coli->description }}</td>
                    <td>{{ $coli->poids }}</td>
                    <td>{{ $coli->client->nom }} {{ $coli->client->prenom }}</td>
                    <td>
                        @if($coli->statut == 'en_attente')
                            <span class="badge bg-warning">En attente</span>
                        @elseif($coli->statut == 'en_cours')
                            <span class="badge bg-primary">En cours</span>
                        @elseif($coli->statut == 'livré')
                            <span class="badge bg-success">Livré</span>
                        @else
                            <span class="badge bg-danger">Annulé</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('colis.edit', $coli) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('colis.destroy', $coli) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce colis ?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center">Aucun colis trouvé</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection