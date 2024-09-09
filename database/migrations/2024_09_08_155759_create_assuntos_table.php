<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssuntosTable extends Migration
{
    public function up()
{
    Schema::create('assuntos', function (Blueprint $table) {
        $table->increments('codAs'); // ID do Assunto
        $table->string('Descricao', 20); // Descrição do Assunto
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('assuntos');
}
}
