<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(25);
        return response()->json($posts); 
    }

    public function store(Request $request){
        $post = new Post();
        $post->title = $request->title;
        $post->slug = 'mon-titre';
        $post->content = 'Mon conte';
        $post->save();
    }
    
}
