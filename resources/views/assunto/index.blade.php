@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <h2>Lista de Assuntos</h2>            
            <a href="{{ route('assunto.create') }}" class="btn btn-primary">Inserir Novo Assunto</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>                        
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($assuntos as $assunto)
                        <tr>                            
                            <td>{{ $assunto->Descricao }}</td>
                            <td>                                
                                <a href="{{ route('assunto.edit', $assunto->codAs) }}" class="btn btn-warning btn-sm">Editar</a>                                
                                
                                <form action="{{ route('assunto.destroy', $assunto->codAs) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este assunto?')">Excluir</button>
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
