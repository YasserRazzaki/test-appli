<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function redirectToGoogle($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleGoogleCallback($provider)
    {            $user = Socialite::driver($provider)->user();
        // try {

        // } catch (\Exception $e) {
        //     return response()->json(['error' => 'Erreur lors de la connexion avec Google.']);
        // }

        $existingUser = User::where('email', $user->email)->first();

        if ($existingUser) {
            // L'utilisateur existe déjà, connectez-le
            Auth::login($existingUser);
        } else {
            $newUser = new User();
            $newUser->username = $user->name;
            $newUser->email = $user->email;
            $newUser->save();

            Auth::login($newUser);

            // Créez un message de bienvenue
            return $newUser;
        }

        return response()->json(['message' => 'Connected successfully !']);
    }

    public function logout()
    {
        Auth::logout();
        return "Logout success";
    }
}