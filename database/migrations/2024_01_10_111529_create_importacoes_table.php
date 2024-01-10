<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('importacoes', function (Blueprint $table) {
            $table->id();
            $table->integer('quantidade');
            $table->string('tabela');
            $table->json('data');
            $table->enum('status', [
                'Em processamento',
                'Aguardando validação',
                'Finalizado',
                'Cancelado',
            ]);
            $table->dateTime('finish_at')->nullable();
            $table->dateTime('proccess_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('importacoes');
    }
};
