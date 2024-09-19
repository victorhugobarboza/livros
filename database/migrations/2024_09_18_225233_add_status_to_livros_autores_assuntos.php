<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToLivrosAutoresAssuntos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('livros', function (Blueprint $table) {
            if (!Schema::hasColumn('livros', 'status')) {
                $table->tinyInteger('status')->default(1);
            }
        });

        Schema::table('autores', function (Blueprint $table) {
            if (!Schema::hasColumn('autores', 'status')) {
                $table->tinyInteger('status')->default(1);
            }
        });

        Schema::table('assuntos', function (Blueprint $table) {
            if (!Schema::hasColumn('assuntos', 'status')) {
                $table->tinyInteger('status')->default(1);
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('livros', function (Blueprint $table) {
            if (Schema::hasColumn('livros', 'status')) {
                $table->dropColumn('status');
            }
        });

        Schema::table('autores', function (Blueprint $table) {
            if (Schema::hasColumn('autores', 'status')) {
                $table->dropColumn('status');
            }
        });

        Schema::table('assuntos', function (Blueprint $table) {
            if (Schema::hasColumn('assuntos', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
}
