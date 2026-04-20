<?php

namespace App\Http\Controllers;

use App\Models\Depense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepenseController extends Controller
{
    public function index()
    {
        $depenses = Depense::orderBy('date_depense', 'desc')->get();
        $total = Depense::sum('montant');
        return view('depenses.index', compact('depenses', 'total'));
    }

    public function create()
    {
        return view('depenses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'categorie' => 'required|string',
            'montant' => 'required|numeric',
            'date_depense' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        Depense::create([
            'description' => $request->description,
            'categorie' => $request->categorie,
            'montant' => $request->montant,
            'date_depense' => $request->date_depense,
            'notes' => $request->notes,
            'admin_id' => Auth::guard('admin')->user()->id,
        ]);

        return redirect()->route('depenses.index')->with('success', 'Dépense ajoutée avec succès');
    }

    public function destroy(Depense $depense)
    {
        $depense->delete();
        return redirect()->route('depenses.index')->with('success', 'Dépense supprimée avec succès');
    }
}