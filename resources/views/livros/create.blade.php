@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Inserir Novo Livro</h2>

    <form action="{{ route('livros.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="titulo">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" required>
        </div>
        <div class="form-group">
            <label for="editora">Editora</label>
            <input type="text" class="form-control" id="editora" name="editora" required>
        </div>
        <div class="form-group">
            <label for="edicao">Edição</label>
            <input type="number" class="form-control" id="edicao" name="edicao" required>
        </div>
        <div class="form-group">
            <label for="ano_publicacao">Ano de Publicação</label>
            <input type="number" class="form-control" id="ano_publicacao" name="anoPublicacao" required>
        </div>   
        <div class="form-group">
            <label for="valor">Valor (R$)</label>
            <input type="text" class="form-control" id="valor" name="valor" required>
        </div>
        <div class="form-group">
            <label for="autor">Autor</label>
            <select name="autor" id="autor" class="form-control" required>
                @foreach($autores as $autor)
                    <option value="{{ $autor->CodAu }}">{{ $autor->Nome }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="assunto">Assunto</label>
            <select name="assunto" id="assunto" class="form-control" required>
                @foreach($assuntos as $assunto)
                    <option value="{{ $assunto->codAs }}">{{ $assunto->Descricao }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Inserir</button>
    </form>
</div>

<!-- Inclua o jQuery aqui, antes do script da máscara -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Script para aplicar a máscara -->
<script>
    $(document).ready(function(){
        $('#valor').mask('000.000.000.000.000,00', {reverse: true});
    });
</script>
@endsection
