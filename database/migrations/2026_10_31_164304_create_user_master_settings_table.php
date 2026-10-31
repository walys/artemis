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
        Schema::create('user_master_settings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_master_id')
                ->unique()
                ->constrained('users_master')
                ->cascadeOnDelete();

            $table->string('language', 10)->default('pt-BR');
            $table->string('theme', 20)->default('light');
            $table->boolean('notifications')->default(true);

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_master_settings');
    }
};
