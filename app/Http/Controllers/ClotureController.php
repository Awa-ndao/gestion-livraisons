<?php

namespace App\Http\Controllers;

use App\Models\Cloture;
use App\Models\Paiement;
use App\Models\Livraison;
use App\Models\Colis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClotureController extends Controller
{
    public function index()
    {
        $clotures = Cloture::with('admin')->orderBy('date_cloture', 'desc')->get();
        $total_encaisse_aujourd_hui = Paiement::whereDate('created_at', today())->sum('montant');
        $livraisons_aujourd_hui = Livraison::whereDate('created_at', today())->count();
        $colis_livres_aujourd_hui = Colis::where('statut', 'livré')->whereDate('updated_at', today())->count();

        return view('clotures.index', compact(
            'clotures',
            'total_encaisse_aujourd_hui',
            'livraisons_aujourd_hui',
            'colis_livres_aujourd_hui'
        ));
    }

    public function store(Request $request)
    {
        $dejaCloturer = Cloture::whereDate('date_cloture', today())->first();

        if ($dejaCloturer) {
            return redirect()->route('clotures.index')->with('error', 'La journée a déjà été clôturée !');
        }

        Cloture::create([
            'date_cloture' => today(),
            'total_encaisse' => Paiement::whereDate('created_at', today())->sum('montant'),
            'nombre_livraisons' => Livraison::whereDate('created_at', today())->count(),
            'nombre_colis_livres' => Colis::where('statut', 'livré')->whereDate('updated_at', today())->count(),
            'admin_id' => Auth::guard('admin')->user()->id,
        ]);

        return redirect()->route('clotures.index')->with('success', 'Journée clôturée avec succès !');
    }
}