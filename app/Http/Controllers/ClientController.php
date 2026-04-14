<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::orderBy('created_at', 'desc')->get();
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'adresse' => 'required|string|max:255',
        ]);

        Client::create($request->all());
        return redirect()->route('clients.index')->with('success', 'Client ajouté avec succès');
    }

    public function show(Client $client)
    {
        $client->load('colis');
        return view('clients.show', compact('client'));
    }

    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'adresse' => 'required|string|max:255',
        ]);

        $client->update($request->all());
        return redirect()->route('clients.index')->with('success', 'Client modifié avec succès');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Client supprimé avec succès');
    }
}