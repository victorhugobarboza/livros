<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    use HasFactory;
    
    protected $table = 'livros';
    protected $primaryKey = 'CodL';
    
    protected $fillable = [
        'titulo', 
        'editora',
        'edicao', 
        'anoPublicacao',
        'valor',
        'status'
    ];

    public function scopeAtivo($query)
    {
        return $query->where('status', 1);
    }
    
    public function autores()
    {
        return $this->belongsToMany(Autor::class, 'livro_autor', 'Livro_CodL', 'Autor_CodAu');
    }
    
    public function assuntos()
    {
        return $this->belongsToMany(Assunto::class, 'livro_assunto', 'Livro_CodL', 'Assunto_codAs');
    }

    public function delete()
    {        
        $this->status = 0;
        return $this->save();
    }
}
