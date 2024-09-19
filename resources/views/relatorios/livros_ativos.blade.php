<!DOCTYPE html>
<html>
<head>
    <title>Relatório de Livros Cadastrados</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2; 
        } 
    </style>
</head>
<body>
    <h2>Relatório de Livros Cadastrados</h2>

    <table>
        <thead>
            <tr>                
                <th>Título do Livro</th>
                <th>Editora</th>
                <th>Edição</th>
                <th>Ano de Publicação</th>
                <th>Valor (R$)</th>
                <th>Autor</th>
                <th>Assunto</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dados as $dado)
                <tr>                    
                    <td>{{ $dado->livro_titulo }}</td>
                    <td>{{ $dado->livro_editora }}</td>
                    <td>{{ $dado->livro_edicao }}</td>
                    <td>{{ $dado->livro_ano }}</td>
                    <td>{{ number_format($dado->livro_valor, 2, ',', '.') }}</td>
                    <td>{{ $dado->autor_nome }}</td>
                    <td>{{ $dado->assunto_descricao }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
