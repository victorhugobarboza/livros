<?php

use App\Http\Controllers\LivroController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\AssuntoController;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('livros', LivroController::class);
Route::resource('autor', AutorController::class);
Route::resource('assunto', AssuntoController::class);

// Rota para relatórios
Route::get('relatorios/livros-por-autor', [LivroController::class, 'relatorio'])->name('relatorios.livros-por-autor');

//Route::get('/', function () {
    //return view('welcome');
//});
