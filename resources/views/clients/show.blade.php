@extends('layouts.app')

@section('content')
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-person"></i> Détail du Client</h5>
        <div>
            <a href="{{ route('clients.edit', $client) }}" class="btn btn-warning btn-sm">
                <i class="bi bi-pencil"></i> Modifier
            </a>
            <a href="{{ route('clients.index') }}" class="btn btn-secondary btn-sm">
                <i class="bi bi-arrow-left"></i> Retour
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p><strong>Nom :</strong> {{ $client->nom }}</p>
                <p><strong>Prénom :</strong> {{ $client->prenom }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Téléphone :</strong> {{ $client->telephone }}</p>
                <p><strong>Adresse :</strong> {{ $client->adresse }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Colis du client -->
<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="bi bi-box"></i> Colis de {{ $client->nom }} {{ $client->prenom }}</h5>
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Description</th>
                    <th>Volume (litres)</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                @forelse($client->colis as $coli)
                <tr>
                    <td>{{ $coli->id }}</td>
                    <td>{{ $coli->description }}</td>
                    <td>{{ $coli->poids }}</td>
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
                </tr>
                @empty
                <tr><td colspan="4" class="text-center">Aucun colis pour ce client</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection