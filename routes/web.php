<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/yasser', function () {
    return "Yasser iz the king lessgo ! Welcome to laravel";
});
/*Route::get('/{slug}', function($slug){
    return "ana ".$slug;
});

*/

Route::get('/blog', function () {
    return [
        'title' => 'Mon premier article',
        'content' => 'Ceci est le contenu de mon article'
    ];
});

Route::get('/blogz', function (Request $request) {
   return $request->input('name');
   // modifier l'url avec ? name = adada
});

Route::get('/blogzz', function (Request $request) {
    return ["name" => $request->input('name', "Yass raz"),  
];
    // modifier l'url avec ? name = adada
 });

 Route::get('/blogs/{slug}-{id}', function (Request $request,$slug,$id) {
    // ... 
    return "blog ".$slug;
});

use App\Models\User;

Route::get('/utilisateurs', function () {
    $utilisateurs = User::all();
    return response()->json($utilisateurs);
});

Route::post('/inscription', 'InscriptionController@inscription');
use Illuminate\Support\Facades\DB;

Route::get('/att', function () {
    $users = DB::table('users')->get();
    foreach ($users as $user) {
        $username = $user->username;
        $password = $user->password;
        $prenom = $user->first_name;
        $nom = $user->last_name;
        $email = $user->email;
        // Vous pouvez maintenant utiliser ces valeurs comme vous le souhaitez
        // Par exemple, afficher les valeurs ou les stocker dans une autre variable
        return "Je suis ".$username."<br>Mon vrai nom est:".$prenom." ".$nom."<br>";

    }

    // Vous pouvez également renvoyer ces valeurs au format JSON si vous le souhaitez
   
});

use App\Models\Amitie;
Route::get('/amis', function () {
    $amis = Amitie::all();
    return response()->json($amis);
});

use App\Http\Controllers\Auth\LoginController;
Route::get('/login/{provider}', 'App\Http\Controllers\Auth\LoginController@redirectToGoogle');
Route::get('/login/{provider}/callback', 'App\Http\Controllers\Auth\LoginController@handleGoogleCallback');
Route::get('/logout', 'App\Http\Controllers\Auth\LoginController@logout');