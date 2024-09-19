<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use PDF;

/**
 * Class RelatorioController
 * 
 * @OA\Tag(
 *     name="relatorio",
 *     description="Operações sobre relatórios"
 * )
 */
class RelatorioController extends Controller
{
    /**
     * @OA\Get(
     *     path="/relatorios",
     *     tags={"relatorio"},
     *     summary="Página inicial de relatórios",
     *     description="Retorna a tela de escolha de relatórios",
     *     @OA\Response(
     *         response=200,
     *         description="Tela de relatórios exibida com sucesso"
     *     )
     * )
     */
    public function index()
    {
        return view('relatorios.index');
    }

    /**
     * @OA\Get(
     *     path="/relatorios/livros-autores",
     *     tags={"relatorio"},
     *     summary="Gera relatório de livros por autor",
     *     description="Retorna um relatório PDF dos livros agrupados por autores",
     *     @OA\Response(
     *         response=200,
     *         description="Relatório de livros por autor gerado com sucesso"
     *     )
     * )
     */
    public function getRelatorioLivroAutor()
    {
        $dados = DB::table('relatorio_livros_autores')->get();
        $pdf = PDF::loadView('relatorios.livros_autores', compact('dados'));
        return $pdf->stream('relatorio_livros_autores.pdf');
    }

    /**
     * @OA\Get(
     *     path="/relatorios/livros-assuntos",
     *     tags={"relatorio"},
     *     summary="Gera relatório de livros por assunto",
     *     description="Retorna um relatório PDF dos livros agrupados por assuntos",
     *     @OA\Response(
     *         response=200,
     *         description="Relatório de livros por assunto gerado com sucesso"
     *     )
     * )
     */
    public function getRelatorioLivroAssunto()
    {
        $dados = DB::table('relatorio_livros_por_assunto')->get();
        $pdf = PDF::loadView('relatorios.livros_assuntos', compact('dados'));
        return $pdf->stream('relatorio_livros_assuntos.pdf');
    }

    /**
     * @OA\Get(
     *     path="/relatorios/livros-ativos",
     *     tags={"relatorio"},
     *     summary="Gera relatório de livros ativos",
     *     description="Retorna um relatório PDF dos livros ativos",
     *     @OA\Response(
     *         response=200,
     *         description="Relatório de livros ativos gerado com sucesso"
     *     )
     * )
     */
    public function getRelatorioLivrosAtivos()
    {
        $dados = DB::table('livros_ativos')->get();
        $pdf = PDF::loadView('relatorios.livros_ativos', compact('dados'));
        return $pdf->stream('relatorio_livros_ativos.pdf');
    }
}
