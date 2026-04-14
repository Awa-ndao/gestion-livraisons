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
}