<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use App\Models\Assunto;
use App\Models\Autor;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *    title="API de Livros",
 *    version="1.0.0",
 *    description="Documentação da API de Livros"
 * )
 */

/**
 * Class LivroController
 * 
 * @OA\Tag(
 *     name="Livros",
 *     description="Operações sobre livros"
 * )
 */

class LivroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

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
    
    
    public function destroy(Livro $livro)
    {        
        $livro->autores()->updateExistingPivot($livro->autores->pluck('CodAu'), ['status' => 0]);
        $livro->assuntos()->updateExistingPivot($livro->assuntos->pluck('codAs'), ['status' => 0]);
        
        $livro->delete();

        return redirect()->route('livros.index')->with('success', 'Livro excluído com sucesso!');
    }    
}
