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
            'first_name' => 'required',
            'last_name' => 'required',
            'date_of_birth' => 'required|date',
            'gender' => 'required',
        ]);

        // Enregistrez les données dans la base de données
        DB::table('users')->insert([
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'date_of_birth' => $request->input('date_of_birth'),
            'gender' => $request->input('gender'),
        ]);

        // Retournez un message de succès ou d'erreur en fonction du résultat de l'insertion
        if (DB::table('users')->latest('id')->first()) {
            return 'Inscription réussie !';
        } else {
            return 'Erreur lors de l\'inscription.';
        }
    }
}
