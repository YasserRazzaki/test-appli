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
           return $users.'<br>'; });

use App\Models\Amitie;
Route::get('/amis', function () {
    $amis = Amitie::all();
    return response()->json($amis);
});

use App\Http\Controllers\Auth\LoginController;
Route::get('/login/{provider}', 'App\Http\Controllers\Auth\LoginController@redirectToProvider');
Route::get('/login/{provider}/callback', 'App\Http\Controllers\Auth\LoginController@handleProviderCallback');
Route::get('/logout', 'App\Http\Controllers\Auth\LoginController@logout');
Route::get('/profile/{username}', 'App\Http\Controllers\ProfileController@show');
Route::group(['prefix' => 'quiz'], function(){
    Route::get('/logo', 'App\Http\Controllers\QuizController@indexLogo');
    Route::get('/joueur', 'App\Http\Controllers\QuizController@indexJoueur');
});
Route::get('/posts', function () {
    $posts = DB::table('posts')->get();
    return $posts.'<br>'; 
});