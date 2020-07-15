<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmeClassificacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filme_classificacaos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('filme_id'); 

            $table->foreign('filme_id')
                ->references('id')->on('filmes');
            $table->float('classficacao');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('filme_classificacaos');
    }
}
