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
            <label for="edicao">Edição</label>
            <input type="text" class="form-control" id="edicao" name="edicao" value="{{ $livro->Edicao }}" required>
        </div>
        <div class="form-group">
            <label for="ano_publicacao">Ano de Publicação</label>
            <input type="number" class="form-control" id="ano_publicacao" name="anoPublicacao" value="{{ $livro->AnoPublicacao }}" required>
        </div>

        <!-- Select para Autores -->
        <div class="form-group">
            <label for="autor">Autor</label>
            <select name="autor" id="autor" class="form-control" required>
                @foreach($autores as $autor)
                    <option value="{{ $autor->CodAu }}" 
                        {{ $livro->autores->contains($autor->CodAu) ? 'selected' : '' }}>
                        {{ $autor->Nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Select para Assuntos -->
        <div class="form-group">
            <label for="assunto">Assunto</label>
            <select name="assunto" id="assunto" class="form-control" required>
                @foreach($assuntos as $assunto)
                    <option value="{{ $assunto->codAs }}" 
                        {{ $livro->assuntos->contains($assunto->codAs) ? 'selected' : '' }}>
                        {{ $assunto->Descricao }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-warning">Atualizar</button>
    </form>
</div>
@endsection
