<?php

namespace App\Http\Controllers;

use App\Models\Assunto;
use Illuminate\Http\Request;

/**
 * Class AssuntoController
 * 
 * @OA\Tag(
 *     name="Assunto",
 *     description="Operações sobre assunto"
 * )
 */
class AssuntoController extends Controller
{
    /**
     * @OA\Get(
     *     path="/assunto",
     *     tags={"Assunto"},
     *     summary="Lista todos os assuntos",
     *     description="Retorna a lista de todos os assuntos",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de assuntos obtida com sucesso"
     *     )
     * )
     */
    public function index()
    {
        $assuntos = Assunto::ativo()->get(); // Apenas os assuntos ativos      
        return view('assunto.index', compact('assuntos'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('assunto.create'); 
    }


    /**
     * @OA\Post(
     *     path="/assunto",
     *     tags={"Assunto"},
     *     summary="Cria um novo assunto",
     *     description="Adiciona um novo assunto ao sistema",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"descricao"},
     *             @OA\Property(property="descricao", type="string", example="Novo Assunto")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Assunto criado com sucesso"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Erro de validação"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'descricao' => 'required|max:255',
        ]); 

        Assunto::create($request->all());

        return redirect()->route('assunto.index')->with('success', 'Assunto inserido com sucesso!');
    }

    /**
     * @OA\Get(
     *     path="/assunto/{id}/edit",
     *     tags={"Assunto"},
     *     summary="Exibe o formulário de edição de um assunto",
     *     description="Retorna o formulário para editar um assunto específico",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do assunto",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Formulário de edição obtido com sucesso"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Assunto não encontrado"
     *     )
     * )
     */
    public function edit(Assunto $assunto)
    {
        return view('assunto.edit', compact('assunto')); 
    }

    /**
     * @OA\Put(
     *     path="/assunto/{id}",
     *     tags={"Assunto"},
     *     summary="Atualiza um assunto",
     *     description="Atualiza os dados de um assunto existente",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do assunto",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"descricao"},
     *             @OA\Property(property="descricao", type="string", example="Descrição Atualizada")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Assunto atualizado com sucesso"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Erro de validação"
     *     )
     * )
     */
    public function update(Request $request, Assunto $assunto)
    {
        $request->validate([
            'descricao' => 'required|max:255',
        ]);

        $assunto->update($request->all());

        return redirect()->route('assunto.index')->with('success', 'Assunto atualizado com sucesso!');
    }

    /**
     * @OA\Delete(
     *     path="/assunto/{id}",
     *     tags={"Assunto"},
     *     summary="Exclui um assunto",
     *     description="Exclui logicamente um assunto (status = 0) se não estiver vinculado a um livro ativo",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do assunto",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Assunto excluído com sucesso"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Erro ao tentar excluir"
     *     )
     * )
     */
    public function destroy(Assunto $assunto)
    {
        if ($assunto->livros()->where('livros.status', 1)->exists()) {
            return redirect()->route('assunto.index')
                ->with('error', 'Não é possível excluir o assunto, pois ele está vinculado a um ou mais livros cadastrados.');
        }

        $assunto->delete(); 

        return redirect()->route('assunto.index')->with('success', 'Assunto excluído com sucesso!');
    }
}
