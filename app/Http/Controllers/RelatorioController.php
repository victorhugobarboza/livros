<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class RelatorioController extends Controller
{
    // Método para gerar o relatório em PDF
    public function gerarRelatorio()
    {
        // Consultar os dados da view "relatorio_livros_autores"
        $dados = DB::table('relatorio_livros_autores')->get();

        // Gerar o PDF a partir dos dados
        $pdf = PDF::loadView('relatorios.livros_autores', compact('dados'));

        // Retornar o PDF para visualização no navegador
        return $pdf->stream('relatorio_livros_autores.pdf');
    }
}
