@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <h2>Lista de Autores</h2>           
            <a href="{{ route('autor.create') }}" class="btn btn-primary">Inserir Novo Autor</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>                        
                        <th>Nome</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($autores as $autor)
                        <tr>                            
                            <td>{{ $autor->Nome }}</td>
                            <td>                              
                                <a href="{{ route('autor.edit', $autor->CodAu) }}" class="btn btn-warning btn-sm">Editar</a>                                
                                
                                <form action="{{ route('autor.destroy', $autor->CodAu) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este autor?')">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
