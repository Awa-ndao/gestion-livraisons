<?php

namespace App\Http\Controllers;

use App\Models\Bilan;
use App\Models\Paiement;
use App\Models\Livraison;
use App\Models\Colis;
use App\Models\Client;
use App\Models\Depense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BilanController extends Controller
{
    public function index()
    {
        // Bilan semaine en cours
        $debut_semaine = Carbon::now()->startOfWeek();
        $fin_semaine = Carbon::now()->endOfWeek();

        // Bilan mois en cours
        $debut_mois = Carbon::now()->startOfMonth();
        $fin_mois = Carbon::now()->endOfMonth();

        // Stats semaine
        $semaine = [
            'total_encaisse' => Paiement::whereBetween('created_at', [$debut_semaine, $fin_semaine])->sum('montant'),
            'total_depenses' => Depense::whereBetween('date_depense', [$debut_semaine, $fin_semaine])->sum('montant'),
            'livraisons' => Livraison::whereBetween('created_at', [$debut_semaine, $fin_semaine])->count(),
            'colis_livres' => Colis::where('statut', 'livré')->whereBetween('updated_at', [$debut_semaine, $fin_semaine])->count(),
            'colis_annules' => Colis::where('statut', 'annulé')->whereBetween('updated_at', [$debut_semaine, $fin_semaine])->count(),
            'nouveaux_clients' => Client::whereBetween('created_at', [$debut_semaine, $fin_semaine])->count(),
        ];
        $semaine['benefice'] = $semaine['total_encaisse'] - $semaine['total_depenses'];

        // Stats mois
        $mois = [
            'total_encaisse' => Paiement::whereBetween('created_at', [$debut_mois, $fin_mois])->sum('montant'),
            'total_depenses' => Depense::whereBetween('date_depense', [$debut_mois, $fin_mois])->sum('montant'),
            'livraisons' => Livraison::whereBetween('created_at', [$debut_mois, $fin_mois])->count(),
            'colis_livres' => Colis::where('statut', 'livré')->whereBetween('updated_at', [$debut_mois, $fin_mois])->count(),
            'colis_annules' => Colis::where('statut', 'annulé')->whereBetween('updated_at', [$debut_mois, $fin_mois])->count(),
            'nouveaux_clients' => Client::whereBetween('created_at', [$debut_mois, $fin_mois])->count(),
        ];
        $mois['benefice'] = $mois['total_encaisse'] - $mois['total_depenses'];

        // Historique bilans
        $bilans = Bilan::orderBy('date_debut', 'desc')->get();

        return view('bilans.index', compact('semaine', 'mois', 'bilans', 'debut_semaine', 'fin_semaine', 'debut_mois', 'fin_mois'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:hebdomadaire,mensuel',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
            'observations' => 'nullable|string',
        ]);

        $debut = $request->date_debut;
        $fin = $request->date_fin;

        Bilan::create([
            'type' => $request->type,
            'date_debut' => $debut,
            'date_fin' => $fin,
            'total_encaisse' => Paiement::whereBetween('created_at', [$debut, $fin])->sum('montant'),
            'nombre_livraisons' => Livraison::whereBetween('created_at', [$debut, $fin])->count(),
            'nombre_colis_livres' => Colis::where('statut', 'livré')->whereBetween('updated_at', [$debut, $fin])->count(),
            'nombre_colis_annules' => Colis::where('statut', 'annulé')->whereBetween('updated_at', [$debut, $fin])->count(),
            'nouveaux_clients' => Client::whereBetween('created_at', [$debut, $fin])->count(),
            'observations' => $request->observations,
            'admin_id' => Auth::guard('admin')->user()->id,
        ]);

        return redirect()->route('bilans.index')->with('success', 'Bilan enregistré avec succès !');
    }
}