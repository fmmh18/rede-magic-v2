<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmeElencosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filme_elencos', function (Blueprint $table) {
            $table->unsignedBigInteger('filme_id');
            $table->unsignedBigInteger('ator_id');

            $table->foreign('filme_id')
                ->references('id')->on('filmes');

            $table->foreign('ator_id')
                ->references('id')->on('ators');
                
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
        Schema::dropIfExists('filme_elencos');
    }
}
