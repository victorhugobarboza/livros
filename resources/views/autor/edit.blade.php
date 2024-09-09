@extends('layouts.app')

@section('content')
    <h2>Editar Autor</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Erro!</strong> Verifique os campos abaixo.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('autor.update', $autor->CodAu) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" placeholder="Nome do Autor" value="{{ $autor->Nome }}">
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
@endsection
