@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="bi bi-wallet2"></i> Nouvelle Dépense</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('depenses.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-bold">Description</label>
                <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}" placeholder="-- nom fruit --">
                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Catégorie</label>
                <select name="categorie" class="form-select @error('categorie') is-invalid @enderror">
                    <option value="">-- Choisir une catégorie --</option>
                    <option value="fruits" {{ old('categorie') == 'fruits' ? 'selected' : '' }}>Fruits</option>
                    <option value="emballages" {{ old('categorie') == 'emballages' ? 'selected' : '' }}>Emballages</option>
                    <option value="transport" {{ old('categorie') == 'transport' ? 'selected' : '' }}>Transport</option>
                    <option value="livreurs" {{ old('categorie') == 'livreurs' ? 'selected' : '' }}>Livreurs</option>
                    <option value="autre" {{ old('categorie') == 'autre' ? 'selected' : '' }}>Autre</option>
                </select>
                @error('categorie')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Montant (FCFA)</label>
                <input type="number" name="montant" class="form-control @error('montant') is-invalid @enderror" value="{{ old('montant') }}">
                @error('montant')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Date</label>
                <input type="date" name="date_depense" class="form-control @error('date_depense') is-invalid @enderror" value="{{ old('date_depense', date('Y-m-d')) }}">
                @error('date_depense')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Notes <small class="text-muted">(optionnel)</small></label>
                <textarea name="notes" class="form-control" rows="2">{{ old('notes') }}</textarea>
            </div>
            <a href="{{ route('depenses.index') }}" class="btn btn-secondary">Annuler</a>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    </div>
</div>
@endsection
