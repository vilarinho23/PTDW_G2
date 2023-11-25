<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Docente;
use App\Models\UnidadeCurricular;

class DocenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Docente sem UCs
        $docenteSemUCs = Docente::find(1);
        if ($docenteSemUCs == null)
        {
            $docenteSemUCs = Docente::factory()->make();
            $docenteSemUCs->num_func = 1;
            $docenteSemUCs->save();
        }

        // Docente com UCs
        $docenteComUCs = Docente::find(2);
        if ($docenteComUCs == null)
        {
            $docenteComUCs = Docente::factory()->make();
            $docenteComUCs->num_func = 2;
            $docenteComUCs->save();
        }

        if ($docenteComUCs->unidadesCurriculares->isEmpty())
        {
            $ucs = UnidadeCurricular::all();
            $ucsDocente = fake()->randomElements($ucs, 2);
            foreach ($ucsDocente as $uc)
                $uc->docentes()->attach(
                    $docenteComUCs->num_func,
                    ['perc_horas' => fake()->numberBetween(0, 100)]
                );
            $docenteComUCs = Docente::find(2);
        }

        if ($docenteComUCs->respUnidadesCurriculares->isEmpty())
        {
            if ($docenteComUCs->unidadesCurriculares->isEmpty()) return;

            $primeiraUC = $docenteComUCs->unidadesCurriculares[0];
            $primeiraUC->responsavel()->associate($docenteComUCs);
            $primeiraUC->save();
        }
    }
}
