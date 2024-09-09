@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <h2>Lista de Livros</h2>            
            <a href="{{ route('livros.create') }}" class="btn btn-primary">Inserir Novo Livro</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>                        
                        <th>Título</th>
                        <th>Editora</th>
                        <th>Edição</th>
                        <th>Ano de Publicação</th>
                        <th>Autor</th>
                        <th>Assunto</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($livros as $livro)
                        <tr>                            
                            <td>{{ $livro->Titulo }}</td>
                            <td>{{ $livro->Editora }}</td>
                            <td>{{ $livro->Edicao }}</td>
                            <td>{{ $livro->AnoPublicacao }}</td>
                            
                            <!-- Exibir o(s) autor(es) -->
                            <td>
                                @foreach($livro->autores as $autor)
                                    {{ $autor->Nome }}<br>
                                @endforeach
                            </td>
                            
                            <!-- Exibir o(s) assunto(s) -->
                            <td>
                                @foreach($livro->assuntos as $assunto)
                                    {{ $assunto->Descricao }}<br>
                                @endforeach
                            </td>

                            <td>                                
                                <a href="{{ route('livros.edit', $livro->CodL) }}" class="btn btn-warning btn-sm">Editar</a>                                
                                
                                <form action="{{ route('livros.destroy', $livro->CodL) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este livro?')">Excluir</button>
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
