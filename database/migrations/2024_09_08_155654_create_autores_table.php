<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('autores', function (Blueprint $table) {
        $table->increments('CodAu'); // ID do Autor
        $table->string('Nome', 40); // Nome do Autor
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('autores');
}

}
