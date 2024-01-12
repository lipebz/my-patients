<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Paciente extends Model
{
    use HasFactory;

    protected $table = "pacientes";
    protected $fillable = [
        "nome",
        "data_nascimento",
        "cpf",
        "cns",
        "mae",
        "foto_url",
        "importacao_id",
    ];

    public function endereco(): HasOne
    {
        return $this->hasOne(PacienteEndereco::class, 'paciente_id', 'id');
    }


}
