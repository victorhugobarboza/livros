<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $autores = Autor::all();
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
        $autor->delete();
        return redirect()->route('autor.index')->with('success', 'Autor deletado com sucesso.');
    }
}
