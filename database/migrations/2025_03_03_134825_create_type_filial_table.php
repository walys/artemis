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
        Schema::create('type_filial', function (Blueprint $table) {
            $table->id(); // Cria uma coluna 'id' auto-incremental
            $table->string('name'); // Nome do tipo de filial
            $table->text('description')->nullable(); // Descrição do tipo de filial (opcional)
            $table->timestamps(); // Cria as colunas 'created_at' e 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_filial'); // Remove a tabela
    }
};
