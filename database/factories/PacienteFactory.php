<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Paciente>
 */
class PacienteFactory extends Factory
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
            'nome' => $faker->name(),
            'cpf' => $faker->cpf(false),
            'cns' => $faker->numerify('###############'),
            'data_nascimento' => $faker->date(),
            'mae' => $faker->name('female'),
            'foto_url' => $this->getFakerImage(),
        ];
    }

    private function getFakerImage()
    {
        $response = Http::get("https://100k-faces.glitch.me/random-image-url");

        $json = $response->json();

        $image = $json['url'];

        return $image ?? null;
    }
}
