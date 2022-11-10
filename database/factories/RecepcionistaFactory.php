<?php

namespace Database\Factories;

use App\Models\Recepcionista;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecepcionistaFactory extends Factory
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
          'endereco' => $this->faker->streetName()
        ];
    }
}
