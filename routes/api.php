<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::post('/logout', [\App\Http\Controllers\Auth\StatelessUserAuthController::class, 'logout']);

    Route::get('/user', function (Request $request){
        return $request->user();
    });

    Route::apiResource('notes', \App\Http\Controllers\NoteController::class);
    Route::apiResource('labels', \App\Http\Controllers\LabelController::class);

});

Route::post('/register', [\App\Http\Controllers\Auth\StatelessUserAuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\Auth\StatelessUserAuthController::class, 'login']);
