<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subscription_payments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('company_subscription_id')
                ->constrained('company_subscriptions')
                ->restrictOnDelete();

            // Informações financeiras
            $table->unsignedBigInteger('amount');
            $table->string('currency', 3)->default('BRL');

            // Forma e provedor de pagamento
            $table->string('payment_method', 30);
            $table->string('gateway', 50)->nullable();

            $table->string('gateway_payment_id')->nullable();

            // Status do pagamento
            $table->string('status', 30)->default('pending');

            // Datas
            $table->timestamp('due_at')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('refunded_at')->nullable();

            // Dados adicionais do gateway
            $table->json('metadata')->nullable();

            $table->timestamps();

            $table->index([
                'company_subscription_id',
                'status',
            ]);

            $table->index('gateway_payment_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscription_payments');
    }
};
