<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToLivroAutorAndLivroAssunto extends Migration
{
    public function up()
{
    Schema::table('livro_autor', function (Blueprint $table) {
        $table->boolean('status')->default(1); // 1 para ativo, 0 para inativo
    });

    Schema::table('livro_assunto', function (Blueprint $table) {
        $table->boolean('status')->default(1); // 1 para ativo, 0 para inativo
    });
}

public function down()
{
    Schema::table('livro_autor', function (Blueprint $table) {
        $table->dropColumn('status');
    });

    Schema::table('livro_assunto', function (Blueprint $table) {
        $table->dropColumn('status');
    });
}
}
