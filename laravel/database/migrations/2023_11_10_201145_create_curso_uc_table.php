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
        Schema::create('curso_uc', function (Blueprint $table) {
            $table->string('acron_curso', 10);
            $table->integer('cod_uc')->unsigned();
            $table->timestamps();

            $table->foreign('acron_curso')
                ->references('acron_curso')
                ->on('curso')
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
            $table->primary(['acron_curso', 'cod_uc']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curso_uc');
    }
};
