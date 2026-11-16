<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('company_plan_overrides', function (Blueprint $table) {
            $table->id();

            $table->foreignId('company_subscription_id')
                ->constrained('company_subscriptions')
                ->cascadeOnDelete();

            $table->string('override_key');
            $table->json('override_value');

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users_master')
                ->nullOnDelete();

            $table->foreignId('updated_by')
                ->nullable()
                ->constrained('users_master')
                ->nullOnDelete();

            $table->timestamps();

            $table->unique(
                ['company_subscription_id', 'override_key'],
                'company_plan_overrides_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_plan_overrides');
    }
};