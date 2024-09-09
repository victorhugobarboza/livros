@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Livro</h2>

    <form action="{{ route('livros.update', $livro->CodL) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="titulo">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" value="{{ $livro->Titulo }}" required>
        </div>
        <div class="form-group">
            <label for="editora">Editora</label>
            <input type="text" class="form-control" id="editora" name="editora" value="{{ $livro->Editora }}" required>
        </div>
        <div class="form-group">
            <label for="editora">Edição</label>
            <input type="text" class="form-control" id="edicao" name="edicao" value="{{ $livro->Edicao }}" required>
        </div>
        <div class="form-group">
            <label for="ano_publicacao">Ano de Publicação</label>
            <input type="number" class="form-control" id="ano_publicacao" name="ano_publicacao" value="{{ $livro->AnoPublicacao }}" required>
        </div>
        <button type="submit" class="btn btn-warning">Atualizar</button>
    </form>
</div>
@endsection
