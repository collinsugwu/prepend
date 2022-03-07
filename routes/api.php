<?php

use App\Http\Controllers\Auth\SessionsController;
use App\Http\Controllers\PokemonsController;
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

Route::post('/login', [SessionsController::class, 'login']);
Route::group(['middleware' => 'auth:sanctum'], function (){
    Route::get('/pokemons', [PokemonsController::class, 'index']);
    Route::get('/pokemons/{id}', [PokemonsController::class, 'show']);
});


