<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Http\Request;

/**
 * Class AutorController
 * 
 * @OA\Tag(
 *     name="Autor",
 *     description="Operações sobre autor"
 * )
 */
class AutorController extends Controller
{
    /**
     * @OA\Get(
     *     path="/autor",
     *     tags={"Autor"},
     *     summary="Lista todos os autores",
     *     description="Retorna a lista de todos os autores",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de autores obtida com sucesso"
     *     )
     * )
     */
    public function index()
    {
        $autores = Autor::ativo()->get();
        return view('autor.index', compact('autores'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('autor.create');
    }

    /**
     * @OA\Post(
     *     path="/autor",
     *     tags={"Autor"},
     *     summary="Cria um novo autor",
     *     description="Adiciona um novo autor ao sistema",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nome"},
     *             @OA\Property(property="nome", type="string", example="Novo Autor")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Autor criado com sucesso"
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
            'nome' => 'required|string|max:255',
        ]);

        Autor::create($request->all());
        return redirect()->route('autor.index')->with('success', 'Autor criado com sucesso.');
    }

    /**
     * @OA\Get(
     *     path="/autor/{id}/edit",
     *     tags={"Autor"},
     *     summary="Exibe o formulário de edição de um autor",
     *     description="Retorna o formulário para editar um autor específico",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do autor",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Formulário de edição obtido com sucesso"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Autor não encontrado"
     *     )
     * )
     */
    public function edit(Autor $autor)
    {
        return view('autor.edit', compact('autor'));
    }

    /**
     * @OA\Put(
     *     path="/autor/{id}",
     *     tags={"Autor"},
     *     summary="Atualiza um autor",
     *     description="Atualiza os dados de um autor existente",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do autor",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nome"},
     *             @OA\Property(property="nome", type="string", example="Nome Atualizado")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Autor atualizado com sucesso"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Erro de validação"
     *     )
     * )
     */
    public function update(Request $request, Autor $autor)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        $autor->update($request->all());
        return redirect()->route('autor.index')->with('success', 'Autor atualizado com sucesso.');
    }

    /**
     * @OA\Delete(
     *     path="/autor/{id}",
     *     tags={"Autor"},
     *     summary="Exclui um autor",
     *     description="Exclui logicamente um autor (status = 0) se não estiver vinculado a um livro ativo",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do autor",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Autor excluído com sucesso"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Erro ao tentar excluir"
     *     )
     * )
     */
    public function destroy(Autor $autor)
    {
        if ($autor->livros()->where('livros.status', 1)->exists()) {
            return redirect()->route('autor.index')
                ->with('error', 'Não é possível excluir o autor, pois ele está vinculado a um ou mais livros cadastrados.');
        }

        // Exclusão lógica, definir status = 0 em vez de excluir fisicamente
        $autor->delete(); 

        return redirect()->route('autor.index')->with('success', 'Autor excluído com sucesso.');
    }
}
