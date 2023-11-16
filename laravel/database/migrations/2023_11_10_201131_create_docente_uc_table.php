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
        Schema::create('docente_uc', function (Blueprint $table) {
            $table->integer('num_func')->unsigned();
            $table->integer('cod_uc')->unsigned();
            $table->integer('perc_horas')->unsigned();
            $table->timestamps();

            $table->foreign('num_func')
                ->references('num_func')
                ->on('docente')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('cod_uc')
                ->references('cod_uc')
                ->on('unidade_curricular')
                ->onUpdate('cascade')
                ->onDelete('cascade');


            /*
            "Composite" Primary Keys não são suportadas pelos Models do Laravel/Eloquent
            Mas neste caso não há problema porque é uma tabela pivot
            */
            $table->primary(['num_func', 'cod_uc']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('docente_uc');
    }
};
