@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Assunto</h2>

    <form action="{{ route('assunto.update', $assunto->codAs) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <input type="text" class="form-control" id="descricao" name="descricao" value="{{ $assunto->Descricao }}" required>
        </div>
        <button type="submit" class="btn btn-warning">Atualizar</button>
    </form>
</div>
@endsection
