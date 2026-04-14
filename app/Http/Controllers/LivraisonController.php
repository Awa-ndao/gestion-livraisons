<?php

namespace App\Http\Controllers;

use App\Models\Livraison;
use App\Models\Colis;
use App\Models\Livreur;
use Illuminate\Http\Request;

class LivraisonController extends Controller
{
    public function index()
    {
        $livraisons = Livraison::with('colis', 'livreur')->orderBy('created_at', 'desc')->get();
        return view('livraisons.index', compact('livraisons'));
    }

    public function create()
    {
        $colis = Colis::all();
        $livreurs = Livreur::all();
        return view('livraisons.create', compact('colis', 'livreurs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date_livraison' => 'required|date',
            'statut' => 'required|string',
            'colis_id' => 'required|exists:colis,id',
            'livreur_id' => 'required|exists:livreurs,id',
        ]);

        Livraison::create($request->all());
        return redirect()->route('livraisons.index')->with('success', 'Livraison ajoutée avec succès');
    }

    public function show(Livraison $livraison)
    {
        $livraison->load('colis.client', 'livreur', 'paiement');
        return view('livraisons.show', compact('livraison'));
    }

    public function edit(Livraison $livraison)
    {
        $colis = Colis::all();
        $livreurs = Livreur::all();
        return view('livraisons.edit', compact('livraison', 'colis', 'livreurs'));
    }

    public function update(Request $request, Livraison $livraison)
    {
        $request->validate([
            'date_livraison' => 'required|date',
            'statut' => 'required|string',
            'colis_id' => 'required|exists:colis,id',
            'livreur_id' => 'required|exists:livreurs,id',
        ]);

        $livraison->update($request->all());
        return redirect()->route('livraisons.index')->with('success', 'Livraison modifiée avec succès');
    }

    public function destroy(Livraison $livraison)
    {
        $livraison->delete();
        return redirect()->route('livraisons.index')->with('success', 'Livraison supprimée avec succès');
    }
}