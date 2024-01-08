<?php

namespace Database\Seeders;

use App\Models\Paciente;
use App\Models\PacienteEndereco;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PacienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Paciente::factory()->count(20)->create()->each(function($paciente) {
            $endereco = PacienteEndereco::factory()->make();
            $paciente->endereco()->save($endereco);
        });
    }
}
