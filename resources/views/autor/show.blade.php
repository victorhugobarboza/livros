@extends('layouts.app')

@section('content')
    <h2>Detalhes do Autor</h2>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $autor->nome }}</h5>
            <p class="card-text">ID: {{ $autor->id }}</p>
            <a href="{{ route('autores.index') }}" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
@endsection
