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
            $table->integer('num_func')->unsigned()->nullable();
            $table->boolean('comissao')->default(false);

            $table->foreign('num_func')
                ->references('num_func')
                ->on('docente')
                ->nullOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['num_func', 'comissao']);

            $table->dropForeign(['num_func']);
        });
    }
};
