<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('plan_features', function (Blueprint $table) {
            $table->id();

            $table->foreignId('plan_id')
                ->unique()
                ->constrained('plans')
                ->cascadeOnDelete();

            // Limites
            $table->integer('max_exams')->default(0);
            $table->integer('max_laboratories')->default(0);
            $table->integer('max_users')->default(0);
            $table->integer('max_branches')->default(0);

            // Recursos
            $table->boolean('reports')->default(false);
            $table->boolean('financial_management')->default(false);
            $table->boolean('custom_branding')->default(false);
            $table->boolean('data_export')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plan_features');
    }
};
