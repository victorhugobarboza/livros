<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    use HasFactory;

    // Define o nome da tabela e a chave primária personalizada
    protected $table = 'livros';
    protected $primaryKey = 'CodL';

    // Definir os campos que podem ser atribuídos em massa
    protected $fillable = [
        'titulo', 
        'editora',
        'edicao', 
        'anoPublicacao'
    ];

    // Relacionamento muitos para muitos com o modelo Autor
    public function autores()
    {
        return $this->belongsToMany(Autor::class, 'livro_autor', 'Livro_CodL', 'Autor_CodAu');
    }

    // Relacionamento muitos para muitos com o modelo Assunto
    public function assuntos()
    {
        return $this->belongsToMany(Assunto::class, 'livro_assunto', 'Livro_CodL', 'Assunto_codAs');
    }
}
