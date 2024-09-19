<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use PDF;

class RelatorioController extends Controller
{
    public function index()
    {
        return view('relatorios.index');
    }

    public function getRelatorioLivroAutor()
    {
        $dados = DB::table('relatorio_livros_autores')->get();
        $pdf = PDF::loadView('relatorios.livros_autores', compact('dados'));
        return $pdf->stream('relatorio_livros_autores.pdf');
    }

    public function getRelatorioLivroAssunto()
    {
        $dados = DB::table('relatorio_livros_por_assunto')->get();
        $pdf = PDF::loadView('relatorios.livros_assuntos', compact('dados'));
        return $pdf->stream('relatorio_livros_assuntos.pdf');
    }

    public function getRelatorioLivrosAtivos()
    {
        $dados = DB::table('livros_ativos')->get();
        $pdf = PDF::loadView('relatorios.livros_ativos', compact('dados'));
        return $pdf->stream('relatorio_livros_ativos.pdf');
    }
}

