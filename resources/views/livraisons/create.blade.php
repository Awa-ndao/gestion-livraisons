@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="bi bi-truck"></i> Nouvelle Livraison</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('livraisons.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-bold">Date de livraison</label>
                <input type="date" name="date_livraison" class="form-control @error('date_livraison') is-invalid @enderror" value="{{ old('date_livraison') }}">
                @error('date_livraison')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Colis</label>
                <select name="colis_id" class="form-select @error('colis_id') is-invalid @enderror">
                    <option value="">-- Choisir un colis --</option>
                    @foreach($colis as $coli)
                        <option value="{{ $coli->id }}" {{ old('colis_id') == $coli->id ? 'selected' : '' }}>
                            {{ $coli->description }} ({{ $coli->poids }} kg)
                        </option>
                    @endforeach
                </select>
                @error('colis_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Livreur</label>
                <select name="livreur_id" class="form-select @error('livreur_id') is-invalid @enderror">
                    <option value="">-- Choisir un livreur --</option>
                    @foreach($livreurs as $livreur)
                        <option value="{{ $livreur->id }}" {{ old('livreur_id') == $livreur->id ? 'selected' : '' }}>
                            {{ $livreur->nom }} {{ $livreur->prenom }} — {{ $livreur->zone }}
                        </option>
                    @endforeach
                </select>
                @error('livreur_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Statut</label>
                <select name="statut" class="form-select @error('statut') is-invalid @enderror">
                    <option value="planifiée" {{ old('statut') == 'planifiée' ? 'selected' : '' }}>Planifiée</option>
                    <option value="en_cours" {{ old('statut') == 'en_cours' ? 'selected' : '' }}>En cours</option>
                    <option value="livrée" {{ old('statut') == 'livrée' ? 'selected' : '' }}>Livrée</option>
                    <option value="annulée" {{ old('statut') == 'annulée' ? 'selected' : '' }}>Annulée</option>
                </select>
                @error('statut')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <a href="{{ route('livraisons.index') }}" class="btn btn-secondary">Annuler</a>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    </div>
</div>
@endsection