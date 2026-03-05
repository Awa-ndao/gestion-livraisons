@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-person-badge"></i> Liste des Livreurs</h5>
        <a href="{{ route('livreurs.create') }}" class="btn btn-warning btn-sm">
            <i class="bi bi-plus-circle"></i> Nouveau Livreur
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
                    <th>Zone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($livreurs as $livreur)
                <tr>
                    <td>{{ $livreur->id }}</td>
                    <td>{{ $livreur->nom }}</td>
                    <td>{{ $livreur->prenom }}</td>
                    <td>{{ $livreur->telephone }}</td>
                    <td>{{ $livreur->zone }}</td>
                    <td>
                        <a href="{{ route('livreurs.edit', $livreur) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('livreurs.destroy', $livreur) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce livreur ?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center">Aucun livreur trouvé</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection