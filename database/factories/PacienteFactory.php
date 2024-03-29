<?php

namespace Database\Factories;

use App\Models\Paciente;
use Illuminate\Database\Eloquent\Factories\Factory;

class PacienteFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'cpf' => $this->faker->cpf(),
      'nome' => $this->faker->name(),
      'telefone' => $this->faker->phoneNumber(),
      'email' => $this->faker->email(),
      'endereco' => $this->faker->streetName(),
      'ala' => $this->getAla(),
      'quarto' => $this->getQuarto(),
      'observacoes' => $this->faker->text()

    ];
  }

  private function getAla(): string
  {
    $alas = ['1', '2', '3', '4', '5', '6'];
    shuffle($alas);
    return $alas[0];
  }

  private function getQuarto(): string
  {
    $quartos = ['1', '2', '3', '4', '5', '6'];
    shuffle($quartos);
    return $quartos[0];
  }


}
