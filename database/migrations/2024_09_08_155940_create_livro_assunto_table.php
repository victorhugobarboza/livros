<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLivroAssuntoTable extends Migration
{
    public function up()
    {
        Schema::create('livro_assunto', function (Blueprint $table) {
            $table->integer('Livro_CodL')->unsigned(); // FK para Livro
            $table->integer('Assunto_codAs')->unsigned(); // FK para Assunto
            
            // Definindo chaves estrangeiras e seus relacionamentos
            $table->foreign('Livro_CodL')->references('CodL')->on('livros')->onDelete('cascade');
            $table->foreign('Assunto_codAs')->references('codAs')->on('assuntos')->onDelete('cascade');
    
            $table->primary(['Livro_CodL', 'Assunto_codAs']); // Chave composta
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('livro_assunto');
    }
    
}
