<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AmitieController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\UserController;
use App\Models\Post;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/login/{provider}/callback', 'App\Http\Controllers\Auth\LoginController@handleProviderCallback');
Route::get('/login/{provider}', [LoginController::class, 'redirectToProvider']);
Route::post('/login-classic', 'App\Http\Controllers\Auth\LoginController@loginCre')->withoutMiddleware('auth:sanctum');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::get('/login/google', [LoginController::class, 'redirectToProvider'])->name('login.google');
//Route::get('/login/google/callback', [LoginController::class, 'handleProviderCallback']);

//Route::get('/login/github', [LoginController::class, 'redirectToProvider'])->name('login.github');
//Route::get('/login/github/callback', [LoginController::class, 'handleProviderCallback']);

Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::group(['prefix'=>'post'], function(){
        Route::get('/',[PostController::class, 'index']);
        Route::get('/{id}',[PostController::class, 'show']);
        Route::post('/',[PostController::class, 'store']);
        Route::put('/{id}',[PostController::class, 'update']);
        Route::delete('/{id}',[PostController::class, 'destroy']);
    });

    Route::group(['prefix' => 'user'], function(){
        Route::put('/', [UserController::class, 'update']);
    });

    Route::post('/register', 'App\Http\Controllers\InscriptionController@inscription')->withoutMiddleware('auth:sanctum');

    Route::group(['prefix' => 'quiz'], function(){
        Route::get('/logo', 'App\Http\Controllers\QuizController@indexLogo');
        // post '/logo/{id}/response'
      //  Route::get('/logo', 'App\Http\Controllers\QuizController@indexLogoRandom');
        Route::get('/joueur', 'App\Http\Controllers\QuizController@indexJoueur');
    });
});
