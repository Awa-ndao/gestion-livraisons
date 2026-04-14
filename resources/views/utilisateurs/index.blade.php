@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-people"></i> Gestion des Utilisateurs</h5>
        <a href="{{ route('utilisateurs.create') }}" class="btn btn-warning btn-sm">
            <i class="bi bi-plus-circle"></i> Nouvel Utilisateur
        </a>
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($utilisateurs as $utilisateur)
                <tr>
                    <td>{{ $utilisateur->id }}</td>
                    <td>{{ $utilisateur->nom }}</td>
                    <td>{{ $utilisateur->email }}</td>
                    <td>
                        @if($utilisateur->role === 'admin')
                            <span class="badge" style="background-color: #8B2E2E;">Admin</span>
                        @else
                            <span class="badge" style="background-color: #C4973A;">Employé</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('utilisateurs.edit', $utilisateur->id) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i>
                        </a>
                        @if($utilisateur->id !== auth()->guard('admin')->user()->id)
                        <form action="{{ route('utilisateurs.destroy', $utilisateur->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cet utilisateur ?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                        @else
                            <span class="text-muted">Votre compte</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center">Aucun utilisateur trouvé</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection