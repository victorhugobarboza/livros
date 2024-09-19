<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use App\Models\Assunto;
use App\Models\Autor;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

/**
 * Class LivroController
 * 
 * @OA\Tag(
 *     name="Livros",
 *     description="Operações sobre livros"
 * )
 */

 /**
 * @OA\Info(
 *    title="API de Exemplo",
 *    version="1.0.0",
 *    description="Documentação da API de Exemplo",
 *    @OA\Contact(
 *         email="contato@exemplo.com"
 *    )
 * )
 */

class LivroController extends Controller
{
    /**
     * @OA\Get(
     *     path="/livros",
     *     tags={"Livros"},
     *     summary="Lista todos os livros",
     *     description="Retorna a lista de todos os livros",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de livros obtida com sucesso"
     *     )
     * )
     */
    public function index()
    {        
        $livros = Livro::with('autores', 'assuntos')->where('status', 1)->get();      
        return view('livros.index', compact('livros'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $assuntos = Assunto::ativo()->get(); 
        $autores = Autor::ativo()->get(); 
        return view('livros.create', compact('assuntos', 'autores'));
    } 

    /**
     * @OA\Post(
     *     path="/livros",
     *     tags={"Livros"},
     *     summary="Cria um novo livro",
     *     description="Cria um novo livro e vincula autores e assuntos",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"titulo", "editora", "edicao", "anoPublicacao", "valor", "autor", "assunto"},
     *             @OA\Property(property="titulo", type="string", example="Livro Exemplo"),
     *             @OA\Property(property="editora", type="string", example="Editora Exemplo"),
     *             @OA\Property(property="edicao", type="integer", example=1),
     *             @OA\Property(property="anoPublicacao", type="string", example="2024"),
     *             @OA\Property(property="valor", type="number", format="float", example="59.90"),
     *             @OA\Property(property="autor", type="integer", example=1),
     *             @OA\Property(property="assunto", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Livro criado com sucesso"
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
            'titulo' => 'required',
            'editora' => 'required',
            'edicao' => 'required|integer',
            'anoPublicacao' => 'required|digits:4',
            'valor' => 'required',
            'autor' => 'required|integer',
            'assunto' => 'required|integer',
        ]);    
        
        $valorConvertido = str_replace(',', '.', str_replace('.', '', $request->valor));        
    
        $livro = Livro::create([
            'titulo' => $request->titulo,
            'editora' => $request->editora,
            'edicao' => $request->edicao,
            'anoPublicacao' => $request->anoPublicacao,
            'valor' => $valorConvertido, 
            'status' => 1
        ]);

        $livro->autores()->attach($request->autor, ['status' => 1]);
        $livro->assuntos()->attach($request->assunto, ['status' => 1]);

        return redirect()->route('livros.index')->with('success', 'Livro inserido com sucesso!');
    }

    public function edit(Livro $livro)
    {       
        $autores = Autor::all();
        $assuntos = Assunto::all();        
        
        return view('livros.edit', compact('livro', 'autores', 'assuntos'));
    }

    /**
     * @OA\Put(
     *     path="/livros/{id}",
     *     tags={"Livros"},
     *     summary="Atualiza um livro",
     *     description="Atualiza as informações de um livro existente",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do livro",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"titulo", "editora", "edicao", "anoPublicacao", "valor", "autor", "assunto"},
     *             @OA\Property(property="titulo", type="string", example="Livro Atualizado"),
     *             @OA\Property(property="editora", type="string", example="Editora Atualizada"),
     *             @OA\Property(property="edicao", type="integer", example=2),
     *             @OA\Property(property="anoPublicacao", type="string", example="2024"),
     *             @OA\Property(property="valor", type="number", format="float", example="79.90"),
     *             @OA\Property(property="autor", type="integer", example=2),
     *             @OA\Property(property="assunto", type="integer", example=2)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Livro atualizado com sucesso"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Erro de validação"
     *     )
     * )
     */
    public function update(Request $request, Livro $livro)
    {
        $request->validate([
            'titulo' => 'required',
            'editora' => 'required',
            'edicao' => 'required|integer',            
            'anoPublicacao' => 'required|digits:4',
            'valor' => 'required',
            'autor' => 'required|integer',
            'assunto' => 'required|integer',
        ]);   
            
        $valorConvertido = str_replace(',', '.', str_replace('.', '', $request->valor));    
        
        $livro->update([
            'titulo' => $request->titulo,
            'editora' => $request->editora,
            'edicao' => $request->edicao,
            'anoPublicacao' => $request->anoPublicacao,
            'valor' => $valorConvertido, 
        ]);  
        
        $livro->autores()->sync([$request->autor => ['status' => 1]]);    
        $livro->assuntos()->sync([$request->assunto => ['status' => 1]]);
    
        return redirect()->route('livros.index')->with('success', 'Livro atualizado com sucesso!');
    }

    /**
     * @OA\Delete(
     *     path="/livros/{id}",
     *     tags={"Livros"},
     *     summary="Exclui um livro",
     *     description="Exclui logicamente um livro (status = 0) e atualiza seus vínculos",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do livro",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Livro excluído com sucesso"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Erro ao tentar excluir"
     *     )
     * )
     */
    public function destroy(Livro $livro)
    {        
        $livro->autores()->updateExistingPivot($livro->autores->pluck('CodAu'), ['status' => 0]);
        $livro->assuntos()->updateExistingPivot($livro->assuntos->pluck('codAs'), ['status' => 0]);
        
        // Exclusão lógica (status = 0)
        $livro->delete();

        return redirect()->route('livros.index')->with('success', 'Livro excluído com sucesso!');
    }
}
