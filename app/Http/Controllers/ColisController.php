<?php

namespace App\Http\Controllers;

use App\Models\Colis;
use App\Models\Client;
use Illuminate\Http\Request;

class ColisController extends Controller
{
    public function index()
    {
        $colis = Colis::with('client')->orderBy('created_at', 'desc')->get();
        return view('colis.index', compact('colis'));
    }

    public function create()
    {
        $clients = Client::all();
        return view('colis.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'poids' => 'required|numeric',
            'statut' => 'required|string',
            'client_id' => 'required|exists:clients,id',
        ]);

        Colis::create($request->all());
        return redirect()->route('colis.index')->with('success', 'Colis ajouté avec succès');
    }

    public function edit(Colis $coli)
    {
        $clients = Client::all();
        return view('colis.edit', compact('coli', 'clients'));
    }

    public function update(Request $request, Colis $coli)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'poids' => 'required|numeric',
            'statut' => 'required|string',
            'client_id' => 'required|exists:clients,id',
        ]);

        $coli->update($request->all());
        return redirect()->route('colis.index')->with('success', 'Colis modifié avec succès');
    }

    public function destroy(Colis $coli)
    {
        $coli->delete();
        return redirect()->route('colis.index')->with('success', 'Colis supprimé avec succès');
    }
}