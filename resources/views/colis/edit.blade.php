@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="bi bi-pencil"></i> Modifier Colis</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('colis.update', $coli) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label fw-bold">Description</label>
                <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description', $coli->description) }}">
                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Volume (litres)</label>
                <input type="number" step="0.01" name="poids" class="form-control @error('poids') is-invalid @enderror" value="{{ old('poids', $coli->poids) }}">
                @error('poids')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Client</label>
                <select name="client_id" class="form-select @error('client_id') is-invalid @enderror">
                    <option value=""> Choisir un client</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}" {{ old('client_id', $coli->client_id) == $client->id ? 'selected' : '' }}>
                            {{ $client->nom }} {{ $client->prenom }}
                        </option>
                    @endforeach
                </select>
                @error('client_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Statut</label>
                <select name="statut" class="form-select @error('statut') is-invalid @enderror">
                    <option value="en_attente" {{ old('statut', $coli->statut) == 'en_attente' ? 'selected' : '' }}>En attente</option>
                    <option value="en_cours" {{ old('statut', $coli->statut) == 'en_cours' ? 'selected' : '' }}>En cours</option>
                    <option value="livré" {{ old('statut', $coli->statut) == 'livré' ? 'selected' : '' }}>Livré</option>
                    <option value="annulé" {{ old('statut', $coli->statut) == 'annulé' ? 'selected' : '' }}>Annulé</option>
                </select>
                @error('statut')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <a href="{{ route('colis.index') }}" class="btn btn-secondary">Annuler</a>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
</div>
@endsection