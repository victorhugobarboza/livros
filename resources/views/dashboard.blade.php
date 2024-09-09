@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Dashboard</h1>
    
    <div class="row">
        <!-- Card para Livros -->
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Livros</h5>
                    <p class="card-text">Gerencie todos os livros cadastrados.</p>
                    <a href="{{ route('livros.index') }}" class="btn btn-primary">Ver Livros</a>
                </div>
            </div>
        </div>

        <!-- Card para Autores -->
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Autores</h5>
                    <p class="card-text">Gerencie todos os autores cadastrados.</p>
                    <a href="{{ route('autor.index') }}" class="btn btn-success">Ver Autores</a>
                </div>
            </div>
        </div>

        <!-- Card para Assuntos -->
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Assuntos</h5>
                    <p class="card-text">Gerencie todos os assuntos cadastrados.</p>
                    <a href="{{ route('assunto.index') }}" class="btn btn-warning">Ver Assuntos</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
