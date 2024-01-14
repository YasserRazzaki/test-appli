<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class InscriptionController extends Controller
{
    public function inscription(Request $request)
    {
        // Validez les données soumises par l'utilisateur
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required|min:6',
            'email' => 'required',
        ]);

        // Enregistrez les données dans la base de données
        DB::table('users')->insert([
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'email' => $request->input('email'),
        ]);

        // Retournez un message de succès ou d'erreur en fonction du résultat de l'insertion
        if (DB::table('users')->latest('id')->first()) {
            return response()->json(['message' => 'Inscription réussie !']);
        } else {
            return response()->json(['message' => 'Erreur lors de l\'inscription.'], 500);
        }
        
    }
}
