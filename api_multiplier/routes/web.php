<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CardapioController;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/cardapio',  [CardapioController::class, 'index']);
//Route::post('/cardapio', [CardapioController::class, 'store']);