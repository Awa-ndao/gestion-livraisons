@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-people"></i> Liste des Clients</h5>
        <a href="{{ route('clients.create') }}" class="btn btn-warning btn-sm">
            <i class="bi bi-plus-circle"></i> Nouveau Client
        </a>
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Téléphone</th>
                    <th>Adresse</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clients as $client)
                <tr>
                    <td>{{ $client->id }}</td>
                    <td>{{ $client->nom }}</td>
                    <td>{{ $client->prenom }}</td>
                    <td>{{ $client->telephone }}</td>
                    <td>{{ $client->adresse }}</td>
                    <td>
                        <a href="{{ route('clients.show', $client) }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('clients.edit', $client) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('clients.destroy', $client) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce client ?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center">Aucun client trouvé</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection