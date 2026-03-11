@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="bi bi-pencil"></i> Modifier Paiement</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('paiements.update', $paiement) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label fw-bold">Livraison</label>
                <select name="livraison_id" class="form-select @error('livraison_id') is-invalid @enderror">
                    <option value="">-- Choisir une livraison --</option>
                    @foreach($livraisons as $livraison)
                        <option value="{{ $livraison->id }}" {{ old('livraison_id', $paiement->livraison_id) == $livraison->id ? 'selected' : '' }}>
                            Livraison #{{ $livraison->id }} — {{ $livraison->colis->description ?? '' }}
                        </option>
                    @endforeach
                </select>
                @error('livraison_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Montant (FCFA)</label>
                <input type="number" step="0.01" name="montant" class="form-control @error('montant') is-invalid @enderror" value="{{ old('montant', $paiement->montant) }}">
                @error('montant')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Mode de paiement</label>
                <select name="mode_paiement" class="form-select @error('mode_paiement') is-invalid @enderror">
                    <option value="cash" {{ old('mode_paiement', $paiement->mode_paiement) == 'cash' ? 'selected' : '' }}>Cash</option>
                    <option value="orange_money" {{ old('mode_paiement', $paiement->mode_paiement) == 'orange_money' ? 'selected' : '' }}>Orange Money</option>
                    <option value="wave" {{ old('mode_paiement', $paiement->mode_paiement) == 'wave' ? 'selected' : '' }}>Wave</option>
                </select>
                @error('mode_paiement')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Statut</label>
                <select name="statut" class="form-select @error('statut') is-invalid @enderror">
                    <option value="en_attente" {{ old('statut', $paiement->statut) == 'en_attente' ? 'selected' : '' }}>En attente</option>
                    <option value="payé" {{ old('statut', $paiement->statut) == 'payé' ? 'selected' : '' }}>Payé</option>
                </select>
                @error('statut')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <a href="{{ route('paiements.index') }}" class="btn btn-secondary">Annuler</a>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
</div>
@endsection