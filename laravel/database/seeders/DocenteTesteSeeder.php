<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Docente;
use App\Models\UnidadeCurricular;

class DocenteTesteSeeder extends Seeder
{
    private function createDocenteSemUCs(): Docente
    {
        // Docente sem UCs
        $docenteSemUCs = Docente::find(1);
        if ($docenteSemUCs != null) return $docenteSemUCs;

        $docenteSemUCs = Docente::factory()->make();
        $docenteSemUCs->num_func = 1;
        $docenteSemUCs->save();
        return $docenteSemUCs;
    }

    private function createDocenteComUCs(): Docente
    {
        // Docente com UCs
        $docenteComUCs = Docente::find(2);
        if ($docenteComUCs != null) return $docenteComUCs;

        $docenteComUCs = Docente::factory()->make();
        $docenteComUCs->num_func = 2;
        $docenteComUCs->save();
        return $docenteComUCs;
    }

    private function associateUCs(Docente $docenteComUCs): void
    {
        if (!$docenteComUCs->unidadesCurriculares->isEmpty()) return;

        $ucs = UnidadeCurricular::all();
        if ($ucs->count() < 2)
        {
            $this->call(UCSeeder::class);
            $ucs = UnidadeCurricular::all();
        }

        $ucsDocente = fake()->randomElements($ucs, 2);
        foreach ($ucsDocente as $uc)
            $uc->docentes()->attach(
                $docenteComUCs->num_func,
                ['perc_horas' => fake()->numberBetween(0, 100)]
            );
    }

    private function associateResponsavel(Docente $docenteComUCs): void
    {
        if (!$docenteComUCs->respUnidadesCurriculares->isEmpty()) return;

        $ucs = $docenteComUCs->unidadesCurriculares;
        $ucResponsavel = fake()->randomElement($ucs);

        $ucResponsavel->responsavel()->associate($docenteComUCs);
        $ucResponsavel->save();
    }


    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createDocenteSemUCs();
        $docenteComUCs = $this->createDocenteComUCs();

        // Associar UCs
        $this->associateUCs($docenteComUCs);

        // Associar responsável
        $docenteComUCs = Docente::find(2);
        $this->associateResponsavel($docenteComUCs);
    }
}
