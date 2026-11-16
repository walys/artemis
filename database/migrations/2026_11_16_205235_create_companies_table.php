<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();

            $table->foreignId('country_id')
                ->constrained('countries')
                ->restrictOnDelete();

            $table->string('name');
            $table->string('cnpj')->unique();
            $table->string('website')->nullable();
            $table->text('description')->nullable();

            // Endereço da empresa
            $table->string('street')->nullable();
            $table->string('number')->nullable();
            $table->string('district')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->text('details')->nullable();
            $table->string('cep')->nullable();
            $table->string('phone')->nullable();

            // Auditoria: administrador Master responsável
            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users_master')
                ->nullOnDelete();

            $table->foreignId('updated_by')
                ->nullable()
                ->constrained('users_master')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
