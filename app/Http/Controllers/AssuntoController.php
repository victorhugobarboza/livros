<?php

namespace App\Http\Controllers;

use App\Models\Assunto;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *    title="API de Assuntos",
 *    version="1.0.0",
 *    description="Documentação da API de Livros"
 * )
 */

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

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
        $assuntos = Assunto::ativo()->get();          
        
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

    public function store(Request $request)
    {
        $request->validate([
            'descricao' => 'required|max:255',
        ]); 

        Assunto::create($request->all());

        return redirect()->route('assunto.index')->with('success', 'Assunto inserido com sucesso!');
    }

    public function edit(Assunto $assunto)
    {
        return view('assunto.edit', compact('assunto')); 
    }

    public function update(Request $request, Assunto $assunto)
    {
        $request->validate([
            'descricao' => 'required|max:255',
        ]);

        $assunto->update($request->all());

        return redirect()->route('assunto.index')->with('success', 'Assunto atualizado com sucesso!');
    }

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
