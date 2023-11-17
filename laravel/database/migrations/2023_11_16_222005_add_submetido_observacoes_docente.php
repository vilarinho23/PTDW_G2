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
        Schema::table('docente', function (Blueprint $table) {
            $table->boolean('submetido')->default(false);
            $table->text('observacoes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('docente', function (Blueprint $table) {
            $table->dropColumn('submetido');
            $table->dropColumn('observacoes');
        });
    }
};
