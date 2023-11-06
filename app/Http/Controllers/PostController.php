<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(25);
        return response()->json($posts);
    }

    public function show(Post $post)
    {
        return $post;
    }

    public function store(Request $request)
    {
        // Vérifiez si l'utilisateur est connecté avant de créer un post
        if (auth()->check()) {
            $post = new Post();
            $post->title = $request->title;
            $post->slug = Str::slug($request->title);
            $post->content = $request->post;
            $post->user_id = auth()->user()->id;
            $post->save();

            return $post;
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function update(Request $request, Post $post)
    {
        // Vérifiez si l'utilisateur est connecté et est le propriétaire du post avant de le mettre à jour
        if (auth()->check() && auth()->user()->id === $post->user_id) {
            $post->title = $request->title;
            $post->content = $request->post;
            $post->save();
            return $post;
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function destroy(Post $post)
    {
        // Vérifiez si l'utilisateur est connecté et est le propriétaire du post avant de le supprimer
        if (auth()->check() && auth()->user()->id === $post->user_id) {
            $post->delete();
            return response()->json(['message' => 'Post deleted']);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
