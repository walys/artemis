<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('plan_prices', function (Blueprint $table) {
            $table->id();

            $table->foreignId('plan_id')
                ->constrained('plans')
                ->cascadeOnDelete();

            $table->string('currency', 3)->default('BRL');
            $table->string('billing_interval', 20);
            $table->unsignedBigInteger('amount');

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->unique([
                'plan_id',
                'currency',
                'billing_interval',
            ], 'plan_prices_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plan_prices');
    }
};
