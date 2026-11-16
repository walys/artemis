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
        Schema::create('plan_descriptions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('plan_id')
                ->constrained('plans')
                ->cascadeOnDelete();

            $table->foreignId('language_id')
                ->constrained('languages')
                ->cascadeOnDelete();

            $table->text('description');

            $table->timestamps();

            $table->unique(
                ['plan_id', 'language_id'],
                'plan_descriptions_unique'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_descriptions');
    }
};
