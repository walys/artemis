<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilialsTable extends Migration
{
    /**
     * Execute as migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filials', function (Blueprint $table) {
            $table->id(); // Cria uma coluna 'id' auto-incremental
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade'); // Chave estrangeira para a tabela 'companies'
            $table->foreignId('country_id')->constrained('countries')->onDelete('cascade'); // Chave estrangeira para a tabela 'countries'
            $table->string('name'); // Nome da filial
            $table->string('cnpj')->unique(); // CNPJ da filial
            $table->string('slug')->unique(); // Slug da filial
            $table->string('website')->nullable(); // Website da filial
            $table->text('description')->nullable(); // Descrição da filial
            $table->integer('number_users')->default(0); // Número de usuários
            $table->unsignedBigInteger('created_by'); // ID do usuário que criou
            $table->unsignedBigInteger('updated_by'); // ID do usuário que atualizou
            $table->timestamps(); // Cria as colunas 'created_at' e 'updated_at'

            // Adicionando chaves estrangeiras para created_by e updated_by, se necessário
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverte as migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('filials', function (Blueprint $table) {
            // Remover as chaves estrangeiras antes de dropar a tabela
            $table->dropForeign(['company_id']);
            $table->dropForeign(['country_id']);
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
        });

        Schema::dropIfExists('filials');
    }
}