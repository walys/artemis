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
        Schema::create('user_filial_company', function (Blueprint $table) {
            $table->id(); // Cria uma coluna 'id' auto-incremental
            $table->unsignedBigInteger('user_id'); // Chave estrangeira para a tabela users
            $table->unsignedBigInteger('filial_id'); // Chave estrangeira para a tabela filials
            $table->unsignedBigInteger('company_id'); // Chave estrangeira para a tabela companies
            $table->timestamps(); // Cria as colunas 'created_at' e 'updated_at'

            // Definindo as chaves estrangeiras
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('filial_id')->references('id')->on('filials')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_filial_company', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['filial_id']);
            $table->dropForeign(['company_id']);
        });

        Schema::dropIfExists('user_filial_company');
    }
};
