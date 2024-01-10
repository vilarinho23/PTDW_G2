<?php

namespace Database\Seeders;

use App\Models\Curso;
use App\Models\Docente;
use App\Models\Laboratorio;
use App\Models\UnidadeCurricular;
use Illuminate\Database\Seeder;

class UCSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obter cursos, laboratórios e docentes
        $cursos = Curso::all();
        $laboratorios = Laboratorio::all();
        $docentes = Docente::all();

        // Criar cursos, laboratórios e docentes se não existirem
        if ($cursos->isEmpty())
        {
            $this->call(CursoSeeder::class);
            $cursos = Curso::all();
        }
        if ($laboratorios->isEmpty())
        {
            $this->call(LaboratorioSeeder::class);
            $laboratorios = Laboratorio::all();
        }
        if ($docentes->isEmpty())
        {
            $this->call(DocenteSeeder::class);
            $docentes = Docente::all();
        }


        // Criar UCs se não existirem e associar a docentes (responsável)
        $uc_results = UnidadeCurricular::factory(10)
            ->recycle($docentes)
            ->make();
        foreach ($uc_results as $model) UnidadeCurricular::firstOrCreate($model->toArray());

        // Fake instance
        $fake = fake();

        // Para cada UC, associar laboratórios, docentes e cursos
        foreach ($uc_results as $uc)
        {
            // Numero de laboratórios, docentes (não responsáveis) e cursos
            $number_of_labs = $fake->numberBetween(0, 2);
            $number_of_courses = $fake->numberBetween(1, 2);
            $number_of_docentes = $fake->numberBetween(0, 2);


            // Associar laboratórios
            $uc_labs = $fake->randomElements($laboratorios, $number_of_labs);
            foreach ($uc_labs as $lab) $uc->laboratorios()->attach($lab->designacao_lab);

            // Associar cursos
            $uc_cursos = $fake->randomElements($cursos, $number_of_courses);
            foreach ($uc_cursos as $curso) $uc->cursos()->attach($curso->acron_curso);

            // Associar docentes (responsável)
            $uc->docentes()->attach(
                $uc->responsavel->num_func,
                ['perc_horas' => $fake->numberBetween(0, 100)]
            );

            // Associar docentes (não responsáveis)
            $uc_docentes = $docentes->diff([$uc->responsavel]);
            $uc_docentes = $fake->randomElements($uc_docentes, $number_of_docentes);
            foreach ($uc_docentes as $docente)
                $uc->docentes()->attach(
                    $docente->num_func,
                    ['perc_horas' => fake()->numberBetween(0, 100)]
                );
        }
    }
}
