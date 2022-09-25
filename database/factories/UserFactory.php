<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $email = $this->faker->unique()->safeEmail();
        return [
            'name' => $this->faker->name(),
            'email' => $email,
            'email_verified_at' => now(),
            'password' => bcrypt($email), // password
            'tipo' => $this->getTipo(),
            'cpf' => $this->faker->ean8(),
            'telefone' => $this->faker->phoneNumber(),
            'endereco' => $this->faker->streetName(),
            'remember_token' => Str::random(10),
            
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    private function getTipo() : string{
      $tipos = ['user','admin'];
      shuffle($tipos);
      return $tipos[0];
    }

}
