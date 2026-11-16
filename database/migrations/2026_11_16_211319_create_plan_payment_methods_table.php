<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('plan_payment_methods', function (Blueprint $table) {
            $table->id();

            $table->foreignId('plan_id')
                ->constrained('plans')
                ->cascadeOnDelete();

            $table->string('payment_method', 30);

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->unique([
                'plan_id',
                'payment_method',
            ], 'plan_payment_methods_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plan_payment_methods');
    }
};
