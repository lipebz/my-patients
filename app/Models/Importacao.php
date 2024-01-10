<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Importacao extends Model
{
    use HasFactory;

    protected $table = "importacoes";
    protected $fillable = [
        "quantidade",
        "tabela",
        "data",
        "status",
        "path",
        "finish_at",
        "proccess_at",
    ];

}
