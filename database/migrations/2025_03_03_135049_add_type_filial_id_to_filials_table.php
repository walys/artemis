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
        Schema::table('filials', function (Blueprint $table) {
            $table->unsignedBigInteger('type_filial_id')->nullable()->after('id'); // Adiciona a coluna type_filial_id
            // Definindo a chave estrangeira
            $table->foreign('type_filial_id')->references('id')->on('type_filial')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('filials', function (Blueprint $table) {
            $table->dropForeign(['type_filial_id']); // Remove a chave estrangeira
            $table->dropColumn('type_filial_id'); // Remove a coluna
        });
    }
};
