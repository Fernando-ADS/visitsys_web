<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgendamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendamentos', function (Blueprint $table) {
          $table->id();
          $table->string('status_agendamento')->default('Solicitado');
          $table->unsignedBigInteger('paciente_id');
          $table->unsignedBigInteger('user_id');
          $table->date('data_agendamento');
          $table->time('hora_agendamento');
          $table->timestamps();
          
          $table->string('nome');

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
        Schema::dropIfExists('agendamentos');
    }
}
