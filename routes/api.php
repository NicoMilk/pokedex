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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::apiResource('pokemons','PokedexController');

Route::middleware('auth:api')->get('users/{id}/team', 'TeamController@team');    //GET /users/{id}/team RETURNS AN ARRAY CONTAINING THE POKEMONS IN YOUR TEAM
Route::middleware('auth:api')->post('users/{id}/team', 'TeamController@trade');    //POST(PUT) /users/{id}/team SEND A POKEMON FROM YOUR TEAM TO ANOTHER USER’S TEAM

Route::middleware('auth:api')->group(function() {
    Route::apiResource('users','UserController');
});
