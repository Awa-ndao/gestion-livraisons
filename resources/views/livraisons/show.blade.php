@extends('layouts.app')

@section('content')
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-truck"></i> Détail de la Livraison #{{ $livraison->id }}</h5>
        <div>
            <a href="{{ route('livraisons.edit', $livraison) }}" class="btn btn-warning btn-sm">
                <i class="bi bi-pencil"></i> Modifier
            </a>
            <a href="{{ route('livraisons.index') }}" class="btn btn-secondary btn-sm">
                <i class="bi bi-arrow-left"></i> Retour
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p><strong>Date :</strong> {{ $livraison->date_livraison }}</p>
                <p><strong>Statut :</strong>
                    @if($livraison->statut == 'planifiée')
                        <span class="badge bg-warning">Planifiée</span>
                    @elseif($livraison->statut == 'en_cours')
                        <span class="badge bg-primary">En cours</span>
                    @elseif($livraison->statut == 'livrée')
                        <span class="badge bg-success">Livrée</span>
                    @else
                        <span class="badge bg-danger">Annulée</span>
                    @endif
                </p>
            </div>
            <div class="col-md-6">
                <p><strong>Livreur :</strong> {{ $livraison->livreur->nom }} {{ $livraison->livreur->prenom }}</p>
                <p><strong>Zone :</strong> {{ $livraison->livreur->zone }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Détail du colis -->
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0"><i class="bi bi-box"></i> Colis</h5>
    </div>
    <div class="card-body">
        <p><strong>Description :</strong> {{ $livraison->colis->description }}</p>
        <p><strong>Volume :</strong> {{ $livraison->colis->poids }} litres</p>
        <p><strong>Client :</strong> {{ $livraison->colis->client->nom }} {{ $livraison->colis->client->prenom }}</p>
        <p><strong>Téléphone :</strong> {{ $livraison->colis->client->telephone }}</p>
        <p><strong>Adresse :</strong> {{ $livraison->colis->client->adresse }}</p>
    </div>
</div>

<!-- Paiement -->
<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="bi bi-cash-coin"></i> Paiement</h5>
    </div>
    <div class="card-body">
        @if($livraison->paiement)
            <p><strong>Montant :</strong> {{ number_format($livraison->paiement->montant, 0, ',', ' ') }} FCFA</p>
            <p><strong>Mode :</strong>
                @if($livraison->paiement->mode_paiement == 'cash')
                    <span class="badge bg-secondary">Cash</span>
                @elseif($livraison->paiement->mode_paiement == 'orange_money')
                    <span class="badge" style="background-color:#FF6600">Orange Money</span>
                @else
                    <span class="badge" style="background-color:#0066CC">Wave</span>
                @endif
            </p>
            <p><strong>Statut :</strong>
                @if($livraison->paiement->statut == 'payé')
                    <span class="badge bg-success">Payé</span>
                @else
                    <span class="badge bg-warning">En attente</span>
                @endif
            </p>
        @else
            <p class="text-muted">Aucun paiement enregistré pour cette livraison.</p>
            <a href="{{ route('paiements.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-circle"></i> Ajouter un paiement
            </a>
        @endif
    </div>
</div>
@endsection