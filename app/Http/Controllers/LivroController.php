<?php

namespace App\Http\Controllers;
use App\Models\Livro;
use App\Models\Assunto;
use App\Models\Autor;

use Illuminate\Http\Request;

class LivroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $livros = Livro::with('autores', 'assuntos')->get();       
       
        return view('livros.index', compact('livros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $assuntos = Assunto::all();
        $autores = Autor::all();
        return view('livros.create', compact('assuntos', 'autores'));
    }    

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'editora' => 'required',
            'edicao' => 'required|integer',
            'anoPublicacao' => 'required|digits:4',
            'autor' => 'required|integer',
            'assunto' => 'required|integer',
        ]);
    
        $livro = Livro::create([
            'titulo' => $request->titulo,
            'editora' => $request->editora,
            'edicao' => $request->edicao,
            'anoPublicacao' => $request->anoPublicacao,
        ]);

        $livro->autores()->attach($request->autor);
    
        $livro->assuntos()->attach($request->assunto);
    
        return redirect()->route('livros.index')->with('success', 'Livro inserido com sucesso!');
    }
    
    public function edit(Livro $livro)
    {
        return view('livros.edit', compact('livro')); 
    }
    
    public function update(Request $request, Livro $livro)
    {
        $request->validate([
            'titulo' => 'required',
            'editora' => 'required',
            'edicao' => 'required|integer',
            'ano_publicacao' => 'required|digits:4',
        ]);
    
        $livro->update($request->all());
    
        return redirect()->route('livros.index')->with('success', 'Livro atualizado com sucesso!');
    }
    
    public function destroy(Livro $livro)
    {
        $livro->delete();
    
        return redirect()->route('livros.index')->with('success', 'Livro excluído com sucesso!');
    }
    
}
