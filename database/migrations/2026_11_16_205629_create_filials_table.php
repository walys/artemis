<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('filials', function (Blueprint $table) {
            $table->id();

            $table->foreignId('company_id')
                ->constrained('companies')
                ->cascadeOnDelete();

            $table->foreignId('country_id')
                ->constrained('countries')
                ->restrictOnDelete();

            $table->string('name');
            $table->string('cnpj')->unique();

            $table->string('website')->nullable();
            $table->text('description')->nullable();

            // Identifica a matriz da empresa
            $table->boolean('is_headquarters')->default(false);

            // Endereço da filial
            $table->string('street')->nullable();
            $table->string('number')->nullable();
            $table->string('district')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->text('details')->nullable();
            $table->string('cep')->nullable();
            $table->string('phone')->nullable();

            // Auditoria
            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users_master')
                ->nullOnDelete();

            $table->foreignId('updated_by')
                ->nullable()
                ->constrained('users_master')
                ->nullOnDelete();

            $table->timestamps();

            $table->index('company_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('filials');
    }
};
