<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmeProducaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filme_producaos', function (Blueprint $table) {
            $table->unsignedBigInteger('filme_id');
            $table->unsignedBigInteger('diretor_id');

            $table->foreign('filme_id')
                ->references('id')->on('filmes');

            $table->foreign('diretor_id')
                ->references('id')->on('diretors');
                
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
        Schema::dropIfExists('filme_producaos');
    }
}
