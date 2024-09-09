<?php

namespace App\Http\Controllers;

use App\Models\Assunto;

use Illuminate\Http\Request;

class AssuntoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $assuntos = Assunto::all();        
        
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
    $assunto->delete();

    return redirect()->route('assunto.index')->with('success', 'Assunto excluído com sucesso!');
}

}
