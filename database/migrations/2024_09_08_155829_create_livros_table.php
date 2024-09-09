<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLivrosTable extends Migration
{
    public function up()
    {
        Schema::create('livros', function (Blueprint $table) {
            $table->increments('CodL'); // ID do Livro
            $table->string('Titulo', 40); // Título do Livro
            $table->string('Editora', 40); // Editora
            $table->integer('Edicao'); // Edição
            $table->string('AnoPublicacao', 4); // Ano de Publicação
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('livros');
    }
}
