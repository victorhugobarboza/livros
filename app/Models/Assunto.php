<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assunto extends Model
{
    use HasFactory;

    protected $table = 'assuntos';
    protected $primaryKey = 'codAs';

    protected $fillable = [
        'descricao',
        'status'       
    ];

    public function scopeAtivo($query)
    {
        return $query->where('status', 1);
    }

    public function livros()
    {
        return $this->belongsToMany(Livro::class, 'livro_assunto', 'Assunto_codAs', 'Livro_CodL');
    }

    public function delete()
    {        
        $this->status = 0;
        return $this->save();
    }
}
