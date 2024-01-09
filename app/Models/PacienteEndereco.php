<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PacienteEndereco extends Model
{
    use HasFactory;

    protected $table = "pacientes_enderecos";
    protected $fillable = [
        "cep",
        "logradouro",
        "numero",
        "complemento",
        "bairro",
        "cidade",
        "uf",
    ];

    public function paciente(): BelongsTo
    {
        return $this->belongsTo(Paciente::class, 'id', 'paciente_id');
    }

}
