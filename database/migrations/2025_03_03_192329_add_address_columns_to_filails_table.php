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
        Schema::table('filials', function (Blueprint $table) {
            $table->string('street')->nullable(); // Adiciona a coluna street
            $table->string('number')->nullable(); // Adiciona a coluna number
            $table->string('district')->nullable(); // Adiciona a coluna district
            $table->string('city')->nullable(); // Adiciona a coluna city
            $table->string('state')->nullable(); // Adiciona a coluna state
            $table->text('details')->nullable(); // Adiciona a coluna details
            $table->string('cep')->nullable(); // Adiciona a coluna cep
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('filials', function (Blueprint $table) {
            $table->dropColumn(['street', 'number', 'district', 'city', 'state', 'details', 'cep']); // Remove as colunas

        });
    }
};
