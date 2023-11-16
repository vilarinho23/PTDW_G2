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
        Schema::create('laboratorio_uc', function (Blueprint $table) {
            $table->string('designacao_lab');
            $table->integer('cod_uc')->unsigned();
            $table->timestamps();

            $table->foreign('designacao_lab')
                ->references('designacao_lab')
                ->on('laboratorio')
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
            $table->primary(['designacao_lab', 'cod_uc']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laboratorio_uc');
    }
};
