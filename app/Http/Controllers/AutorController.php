<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *    title="API de Autor",
 *    version="1.0.0",
 *    description="Documentação da API de Autor"
 * )
 */

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

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

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        Autor::create($request->all());
        return redirect()->route('autor.index')->with('success', 'Autor criado com sucesso.');
    }

    public function show(Autor $autor)
    {
        return view('autor.show', compact('autor'));
    }

    public function edit(Autor $autor)
    {
        return view('autor.edit', compact('autor'));
    }

    public function update(Request $request, Autor $autor)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        $autor->update($request->all());
        return redirect()->route('autor.index')->with('success', 'Autor atualizado com sucesso.');
    }

    public function destroy(Autor $autor)
    {             
        if ($autor->livros()->where('livros.status', 1)->exists()) {
            return redirect()->route('autor.index')
                ->with('error', 'Não é possível excluir o autor, pois ele está vinculado a um ou mais livros cadastrados.');
        }

        $autor->delete();

        return redirect()->route('autor.index')->with('success', 'Autor deletado com sucesso.');
    }
}
