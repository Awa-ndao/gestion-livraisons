<?php

namespace App\Http\Controllers;

use App\Models\Livreur;
use Illuminate\Http\Request;

class LivreurController extends Controller
{
    public function index()
    {
        $livreurs = Livreur::orderBy('created_at', 'desc')->get();
        return view('livreurs.index', compact('livreurs'));
    }

    public function create()
    {
        return view('livreurs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'zone' => 'required|string|max:255',
        ]);

        Livreur::create($request->all());
        return redirect()->route('livreurs.index')->with('success', 'Livreur ajouté avec succès');
    }

    public function edit(Livreur $livreur)
    {
        return view('livreurs.edit', compact('livreur'));
    }

    public function update(Request $request, Livreur $livreur)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'zone' => 'required|string|max:255',
        ]);

        $livreur->update($request->all());
        return redirect()->route('livreurs.index')->with('success', 'Livreur modifié avec succès');
    }

    public function destroy(Livreur $livreur)
    {
        $livreur->delete();
        return redirect()->route('livreurs.index')->with('success', 'Livreur supprimé avec succès');
    }
}