<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show($username)
    {
        // Trouvez l'utilisateur par son nom d'utilisateur
        $user = User::where('username', $username)->first();
        if (!$user) {
            return response()->json(['error' => 'Utilisateur non trouvé'], 404);
        }

        // Récupérez les posts de l'utilisateur
        $posts = Post::where('user_id', $user->id)->get();
        return response()->json(['user' => $user, 'posts' => $posts]);
    }
}
// grafikart : policies