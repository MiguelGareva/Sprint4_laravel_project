<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntrenadorController;
use App\Http\Controllers\PokemonController;
use App\Http\Controllers\CombateController;

Route::get('/', function () {
    return redirect()->route('entrenadores.index');
});

Route::resource('entrenadores', EntrenadorController::class);

Route::resource('pokemon', PokemonController::class);

Route::resource('combates', CombateController::class);
