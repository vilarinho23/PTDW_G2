<?php

namespace Database\Seeders;

use App\Models\Docente;
use App\Models\RestricaoHorario;
use Illuminate\Database\Seeder;

class RestricoesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obter docentes
        $docentes = Docente::all();

        // Criar docentes se não existirem
        if ($docentes->isEmpty())
        {
            $this->call(DocenteSeeder::class);
            $docentes = Docente::all();
        }

        // Criar restrições se não existirem e associar a docentes
        $modelsMade = RestricaoHorario::factory(10)
        ->recycle($docentes)
        ->make();

        foreach ($modelsMade as $model) RestricaoHorario::firstOrCreate($model->toArray());
    }
}
