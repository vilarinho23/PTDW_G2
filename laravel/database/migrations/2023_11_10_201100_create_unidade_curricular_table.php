<?php

use App\Models\Enums\SalaAvaliacoes;
use App\Models\Enums\UtilizacaoLaboratorios;
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
        $salasAvaliacoes = array_map(fn (SalaAvaliacoes $salaAvaliacoes) => $salaAvaliacoes->value, SalaAvaliacoes::cases());
        $utilizacaoLaboratorios = array_map(fn (UtilizacaoLaboratorios $utilizacaoLaboratorios) => $utilizacaoLaboratorios->value, UtilizacaoLaboratorios::cases());

        Schema::create('unidade_curricular', function (Blueprint $table) use ($salasAvaliacoes, $utilizacaoLaboratorios) {
            $table->integer('cod_uc')->unsigned();
            $table->string('nome_uc');
            $table->integer('horas_uc')->unsigned();
            $table->string('acn_uc');
            $table->integer('num_func_resp')->unsigned();
            $table->enum('sala_avaliacoes', $salasAvaliacoes)->nullable();
            $table->enum('utilizacao_laboratorios', $utilizacaoLaboratorios)->nullable();
            $table->text('software_necessario')->nullable();
            $table->timestamps();

            $table->foreign('num_func_resp')
                ->references('num_func')
                ->on('docente')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->primary('cod_uc');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unidade_curricular');
    }
};
