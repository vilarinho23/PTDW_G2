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
        Schema::create('restricao_horario', function (Blueprint $table) {
            $table->integer('num_func')->unsigned();
            $table->enum('dia_semana', ['segunda', 'terca', 'quarta', 'quinta', 'sexta']);
            $table->enum('parte_dia', ['manha', 'tarde', 'noite']);
            $table->timestamps();

            $table->foreign('num_func')
                ->references('num_func')
                ->on('docente')
                ->onUpdate('cascade')
                ->onDelete('cascade');


            /*
            "Composite" Primary Keys não são suportadas pelos Models do Laravel/Eloquent
            Solução:
            - criar uma coluna id auto-incremento
            - definir a combinação das colunas num_func, dia_semana e parte_dia como UNIQUE e INDEX
            */
            $table->id();
            $table->unique(['num_func', 'dia_semana', 'parte_dia']);
            $table->index(['num_func', 'dia_semana', 'parte_dia']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restricao_horario');
    }
};
