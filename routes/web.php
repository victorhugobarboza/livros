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
// Rota para a tela de relatórios
Route::get('/relatorios', [RelatorioController::class, 'index'])->name('relatorios.index');

// Rotas para gerar os relatórios em PDF
Route::get('/relatorios/livros-autores', [RelatorioController::class, 'getRelatorioLivroAutor'])->name('relatorio.getRelatorioLivroAutor');
Route::get('/relatorios/livros-assuntos', [RelatorioController::class, 'getRelatorioLivroAssunto'])->name('relatorio.getRelatorioLivroAssunto');
Route::get('/relatorios/livros-ativos', [RelatorioController::class, 'getRelatorioLivrosAtivos'])->name('relatorio.livros_ativos');

