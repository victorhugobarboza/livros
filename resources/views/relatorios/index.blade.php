@extends('layouts.app')

@section('content')
<div class="container mt-4">  

    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>                        
                        <th>Tipo Relatório</th>                     
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>                    
                    <tr>                            
                        <td>Relatório de livros por autores</td>
                        <td>                                
                            <a href="{{ route('relatorio.getRelatorioLivroAutor') }}" class="btn btn-primary btn-sm">Gerar</a>
                        </td>
                    </tr>
                    <tr>                            
                        <td>Relatório de livros por assuntos</td>
                        <td>                                
                            <a href="{{ route('relatorio.getRelatorioLivroAssunto') }}" class="btn btn-primary btn-sm">Gerar</a>
                        </td>
                    </tr>
                    <tr>                            
                        <td>Relatório de livros ativos</td>
                        <td>                                
                            <a href="{{ route('relatorio.livros_ativos') }}" class="btn btn-primary btn-sm">Gerar</a>
                        </td>
                    </tr>                   
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
