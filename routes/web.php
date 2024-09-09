<?php

use App\Http\Controllers\LivroController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\AssuntoController;
use App\Http\Controllers\RelatorioController;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('livros', LivroController::class);
Route::resource('autor', AutorController::class);
Route::resource('assunto', AssuntoController::class);
Route::get('/relatorio/livros-autores', [RelatorioController::class, 'gerarRelatorio'])->name('relatorio.livros_autores');

