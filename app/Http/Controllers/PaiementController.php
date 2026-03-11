<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use App\Models\Livraison;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    public function index()
    {
        $paiements = Paiement::with('livraison')->orderBy('created_at', 'desc')->get();
        return view('paiements.index', compact('paiements'));
    }

    public function create()
    {
        $livraisons = Livraison::all();
        return view('paiements.create', compact('livraisons'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'montant' => 'required|numeric',
            'mode_paiement' => 'required|string',
            'statut' => 'required|string',
            'livraison_id' => 'required|exists:livraisons,id',
        ]);

        Paiement::create($request->all());
        return redirect()->route('paiements.index')->with('success', 'Paiement ajouté avec succès');
    }

    public function edit(Paiement $paiement)
    {
        $livraisons = Livraison::all();
        return view('paiements.edit', compact('paiement', 'livraisons'));
    }

    public function update(Request $request, Paiement $paiement)
    {
        $request->validate([
            'montant' => 'required|numeric',
            'mode_paiement' => 'required|string',
            'statut' => 'required|string',
            'livraison_id' => 'required|exists:livraisons,id',
        ]);

        $paiement->update($request->all());
        return redirect()->route('paiements.index')->with('success', 'Paiement modifié avec succès');
    }

    public function destroy(Paiement $paiement)
    {
        $paiement->delete();
        return redirect()->route('paiements.index')->with('success', 'Paiement supprimé avec succès');
    }
}