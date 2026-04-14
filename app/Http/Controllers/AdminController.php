<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            Auth::guard('admin')->login($admin);
            return redirect('/')->with('success', 'Bienvenue ' . $admin->nom . ' !');
        }

        return back()->withErrors(['email' => 'Email ou mot de passe incorrect']);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/login');
    }

    public function utilisateurs()
    {
        $utilisateurs = Admin::orderBy('created_at', 'desc')->get();
        return view('utilisateurs.index', compact('utilisateurs'));
    }

    public function createUtilisateur()
    {
        return view('utilisateurs.create');
    }

    public function storeUtilisateur(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,employe',
        ]);

        Admin::create([
            'nom' => $request->nom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('utilisateurs.index')->with('success', 'Utilisateur créé avec succès');
    }

    public function destroyUtilisateur($id)
    {
        $admin = Admin::findOrFail($id);

        if ($admin->id === Auth::guard('admin')->user()->id) {
            return redirect()->route('utilisateurs.index')->with('error', 'Vous ne pouvez pas supprimer votre propre compte !');
        }

        $admin->delete();
        return redirect()->route('utilisateurs.index')->with('success', 'Utilisateur supprimé avec succès');
    }
}