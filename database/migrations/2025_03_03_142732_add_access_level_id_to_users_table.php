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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('access_level_id')->nullable()->after('id'); // Adiciona a coluna access_level_id
            // Definindo a chave estrangeira
            $table->foreign('access_level_id')->references('id')->on('access_level_user')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['access_level_id']); // Remove a chave estrangeira
            $table->dropColumn('access_level_id');
        });
    }
};
