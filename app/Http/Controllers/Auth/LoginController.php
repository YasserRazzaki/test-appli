<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['message' => 'Erreur lors de la connexion avec Google.']);
        }
    
        // Vérifiez si l'utilisateur existe déjà dans votre base de données
        $existingUser = User::where('email', $user->email)->first();
    
        if ($existingUser) {
            // L'utilisateur existe déjà, connectez-le
            Auth::login($existingUser);
        } else {
            // L'utilisateur n'existe pas, créez un nouvel utilisateur
            $newUser = new User();
            $newUser->name = $user->first_name;
            $newUser->email = $user->email;
            $newUser->save();
    
            Auth::login($newUser); // Connectez le nouvel utilisateur
        }
        return redirect('/dashboard'); // Redirigez l'utilisateur après la connexion
    }
    
    public function logout()
{
    Auth::logout();
   echo "Logout success";
   return redirect('/');
}
}