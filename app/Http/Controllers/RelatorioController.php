<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

/**
 * @OA\Info(
 *    title="API de Relatorio",
 *    version="1.0.0",
 *    description="Documentação da API de Relatorio"
 * )
 */

class RelatorioController extends Controller
{    
    public function gerarRelatorio()
    {        
        $dados = DB::table('relatorio_livros_autores')->get();
        
        $pdf = PDF::loadView('relatorios.livros_autores', compact('dados'));
        
        return $pdf->stream('relatorio_livros_autores.pdf');
    }
}
