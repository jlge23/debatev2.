<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preguntas', function (Blueprint $table) {
            $table->id();
            $table->integer('numero');
            $table->longtext('pregunta')->unique();
            $table->unsignedBigInteger('tipo_id');
            $table->foreign('tipo_id')->references('id')->on('tipos')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('dificultade_id');
            $table->foreign('dificultade_id')->references('id')->on('dificultades')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->boolean('demo');
            $table->boolean('status');
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
        Schema::dropIfExists('preguntas');
    }
};
