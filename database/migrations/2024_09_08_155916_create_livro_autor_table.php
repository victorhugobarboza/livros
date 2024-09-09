<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLivroAutorTable extends Migration
{
public function up()
{
    Schema::create('livro_autor', function (Blueprint $table) {
        $table->integer('Livro_CodL')->unsigned(); // FK para Livro
        $table->integer('Autor_CodAu')->unsigned(); // FK para Autor
        
        // Definindo chaves estrangeiras e seus relacionamentos
        $table->foreign('Livro_CodL')->references('CodL')->on('livros')->onDelete('cascade');
        $table->foreign('Autor_CodAu')->references('CodAu')->on('autores')->onDelete('cascade');

        $table->primary(['Livro_CodL', 'Autor_CodAu']); // Chave composta
    });
}

public function down()
{
    Schema::dropIfExists('livro_autor');
}

}
