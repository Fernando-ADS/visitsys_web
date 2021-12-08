<?php

namespace Database\Factories;

use App\Models\Agendamento;
use App\Models\Visitante;
use App\Models\Paciente;
use Illuminate\Database\Eloquent\Factories\Factory;


class AgendamentoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
      return [
        'paciente_id' => Paciente::factory(),
        'visitante_id' => Visitante::factory(),
        'data_agendamento'=>$this->faker->date(),
        'hora_agendamento'=>$this->faker->time(),
        'status_agendamento' => $this->faker->word(),
      ];
    }
}
