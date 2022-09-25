<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitas', function (Blueprint $table) {
          $table->id();
          $table->string('status_visita')->default("Solicitado");
          $table->unsignedBigInteger('paciente_id');
          $table->unsignedBigInteger('user_id');
          $table->date('data_visita');
          $table->time('hora_visita');
          $table->timestamps();

          $table->foreign('paciente_id')->references('id')->on('pacientes');
          $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visitas');
    }
}
