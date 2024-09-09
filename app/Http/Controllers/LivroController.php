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
            'autor' => 'required|integer',
            'assunto' => 'required|integer',
        ]);
    
        // Atualizar os detalhes do livro
        $livro->update([
            'titulo' => $request->titulo,
            'editora' => $request->editora,
            'edicao' => $request->edicao,
            'anoPublicacao' => $request->anoPublicacao,
        ]);
    
        // Atualizar ou criar o vínculo de autores (removendo os antigos e mantendo o atual ativo)
        $livro->autores()->sync([$request->autor => ['status' => 1]]);
    
        // Atualizar ou criar o vínculo de assuntos (removendo os antigos e mantendo o atual ativo)
        $livro->assuntos()->sync([$request->assunto => ['status' => 1]]);
    
        return redirect()->route('livros.index')->with('success', 'Livro atualizado com sucesso!');
    }
    
    
    public function destroy(Livro $livro)
    {
        // Marcar os vínculos atuais como inativos
        $livro->autores()->updateExistingPivot($livro->autores->pluck('CodAu'), ['status' => 0]);
        $livro->assuntos()->updateExistingPivot($livro->assuntos->pluck('codAs'), ['status' => 0]);

        // Excluir o livro (ou apenas inativar o livro, se for necessário)
        $livro->delete();

        return redirect()->route('livros.index')->with('success', 'Livro excluído com sucesso!');
    }

    
}
