<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;
use App\Http\Controllers\AmitieController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'post'], function(){
    Route::get('/',[PostController::class, 'index']);
    Route::get('/{id}');
    Route::post('/',[PostController::class, 'store']);
    Route::put('/{id}');
    Route::delete('/{id}');
});

Route::group(['prefix'=>'post'], function(){
    Route::get('/',[AmitieController::class, 'index']);
    Route::get('/{id}');
    Route::post('/',[AmitieController::class, 'store']);
    Route::put('/{id}');
    Route::delete('/{id}');
});