@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Inserir Novo Assunto</h2>

    <form action="{{ route('assunto.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <input type="text" class="form-control" id="descricao" name="descricao" required>
        </div>
        <button type="submit" class="btn btn-primary">Inserir</button>
    </form>
</div>
@endsection
