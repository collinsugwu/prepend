<?php

use App\Http\Controllers\PokemonsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//
//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [PokemonsController::class, 'index'])->name('index');

Route::group(['namespace' => 'pokemons'], function () {
    Route::post('/', [PokemonsController::class, 'create'])->name('create');
    Route::group(['namespace' => '{id}'], function (){
        Route::get('/show', [PokemonsController::class, 'show'])->name('show');
        Route::get('/edit', [PokemonsController::class, 'edit'])->name('edit');
        Route::put('/', [PokemonsController::class, 'update'])->name('update');
        Route::delete('/', [PokemonsController::class, 'delete'])->name('delete');
    });
});
