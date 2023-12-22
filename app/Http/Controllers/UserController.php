<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\TestEvent;

//use App\Http\Controllers\UserController;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function update(Request $request){
        $user = User::where('id', auth()->id())->first();

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->bio = $request->bio;
        $user->team = $request->team;

        $user->save();

        TestEvent::dispatch(auth()->id());

        return $user;
    }
}