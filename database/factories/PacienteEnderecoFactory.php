<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PacienteEndereco>
 */
class PacienteEnderecoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $faker = \Faker\Factory::create('pt_BR');

        return [
            'cep' => $faker->numerify('########'),
            'logradouro' => $faker->streetName(),
            'numero' => random_int(1,1000),
            'bairro' => $faker->randomElement(['Jardim Europa', 'Vila Curuçá']),
            'cidade' => $faker->city(),
            'uf' => $faker->randomElement(['SP', 'RJ', 'MG', 'BA']),
        ];
    }
}
