<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Laravel\Sanctum\Contracts\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }

    public function handleProviderCallback($provider) {
        $user = Socialite::driver($provider)->stateless()->user();    
        $existingUser = User::where('email', $user->email)->first();

        if (!$existingUser) {
            $newUser = new User();
            $newUser->username = $user->name;
            $newUser->email = $user->email;
            $newUser->first_name = $user->first_name;
            $newUser->last_name = $user->last_name;
            $newUser->user_image = $user->getAvatar();
            $newUser->save();
            Auth::login($newUser);
            // Créez un message de bienvenue
            $existingUser = $newUser;
        }

        $token = $existingUser->createToken('test');

        $responseData = [
            'message' => 'Connected successfully!',
           'user' => $existingUser,
           'token' => $token,
        ];
        
        return response()->json($responseData);
    }
    public function logout(Request $request)
{
    $user = $request->user();

    // Vérifiez si l'utilisateur a un jeton actuel
    if ($user && $user->currentAccessToken()) {
        $user->currentAccessToken()->delete();
        return "Logout success";
    }

    return response()->json(['error' => 'No active token found'], 400);
}
public function loginCre(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        $token = $user->createToken('token-name')->plainTextToken;
        return response()->json(['token' => $token]);
    }

    return response()->json(['message' => 'Invalid credentials'], 401);
}}