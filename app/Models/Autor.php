<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    use HasFactory;

    protected $table = 'autores';
    protected $primaryKey = 'CodAu';
     
      protected $fillable = [
        'nome',
        'status'     
    ];

    public function scopeAtivo($query)
    {
        return $query->where('status', 1);
    }

    public function livros()
    {
        return $this->belongsToMany(Livro::class, 'livro_autor', 'Autor_CodAu', 'Livro_CodL');
    }

    public function delete()
    {        
        $this->status = 0;
        return $this->save();
    }
}
