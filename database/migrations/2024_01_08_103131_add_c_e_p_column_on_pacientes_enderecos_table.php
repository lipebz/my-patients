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
        Schema::table('pacientes_enderecos', function (Blueprint $table) {
            $table->string('cep')->nullable()->after('paciente_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pacientes_enderecos', function (Blueprint $table) {
            $table->dropColumn('cep');
        });
    }
};
