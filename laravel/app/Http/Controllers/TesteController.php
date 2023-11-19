<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Docente;
use App\Models\Laboratorio;
use App\Models\RestricaoHorario;
use App\Models\UnidadeCurricular;

use Database\Seeders\CursoSeeder;
use Database\Seeders\LaboratorioSeeder;

class TesteController extends Controller
{
    private function cursos()
    {
        $cursos = Curso::all();
        if ($cursos->isEmpty())
        {
            // Criar cursos se não existirem (seeder)
            $seeder = new CursoSeeder();
            $seeder->run();

            $cursos = Curso::all();
        }

        return $cursos;
    }

    private function laboratorios()
    {
        $laboratorios = Laboratorio::all();
        if ($laboratorios->isEmpty())
        {
            // Criar laboratorios se não existirem (seeder)
            $seeder = new LaboratorioSeeder();
            $seeder->run();

            $laboratorios = Laboratorio::all();
        }

        return $laboratorios;
    }

    private function docentes()
    {
        $docentes = Docente::all();
        if ($docentes->isEmpty())
        {
            // Criar docentes se não existirem
            $modelsMade = Docente::factory(5)->make();
            foreach ($modelsMade as $model) $model->save();

            $docentes = Docente::all();
        }

        return $docentes;
    }

    private function restricoes($docentes)
    {
        $restricoes = RestricaoHorario::all();
        if ($restricoes->isEmpty())
        {
            // Criar restrições se não existirem e associar a docentes
            $modelsMade = RestricaoHorario::factory(10)
                ->recycle($docentes)
                ->make();
            foreach ($modelsMade as $model) $model->save();

            $restricoes = RestricaoHorario::all();
        }

        return $restricoes;
    }

    private function ucs($cursos, $laboratorios, $docentes)
    {
        $ucs = UnidadeCurricular::all();
        if ($ucs->isEmpty())
        {
            // Criar UCs se não existirem e associar a docentes (responsável)
            $uc_results = UnidadeCurricular::factory(10)
                ->recycle($docentes)
                ->make();
            foreach ($uc_results as $model) $model->save();

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
                foreach ($uc_cursos as $curso) $uc->cursos()->attach($curso->nome_curso);

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

            $ucs = UnidadeCurricular::all();
        }

        return $ucs;
    }


    public function index()
    {
        // Buscar/criar dados
        $cursos = $this->cursos();
        $laboratorios = $this->laboratorios();
        $docentes = $this->docentes();
        $restricoes = $this->restricoes($docentes);
        $ucs = $this->ucs($cursos, $laboratorios, $docentes);


        // Obter exemplos de relações
        $cursoId = -1;
        $curso = null;
        do
        {
            $cursoId++;
            $curso = $cursos[$cursoId];
        } while ($curso->unidadesCurriculares == []);

        $laboratorioId = -1;
        $laboratorio = null;
        do
        {
            $laboratorioId++;
            $laboratorio = $laboratorios[$laboratorioId];
        } while ($laboratorio->unidadesCurriculares == []);

        $docenteId = -1;
        $docente = null;
        do
        {
            $docenteId++;
            $docente = $docentes[$docenteId];
        } while ($docente->respUnidadesCurriculares == []);

        $restricaoId = 0;
        $restricao = $restricoes[$restricaoId];

        $ucId = -1;
        $uc = null;
        do
        {
            $ucId++;
            $uc = $ucs[$ucId];
        } while ($uc->laboratorios == []);


        // Retornar JSON
        return response()->json([
            'cursos' => $cursos,
            'laboratorios' => $laboratorios,
            'docentes' => $docentes,
            'restricoes' => $restricoes,
            'ucs' => $ucs,


            "curso_{$cursoId}_ucs" => $curso->unidadesCurriculares,
            "laboratorio_{$laboratorioId}_ucs" => $laboratorio->unidadesCurriculares,
            "docente_{$docenteId}_ucs" => $docente->unidadesCurriculares,
            "docente_{$docenteId}_restricoes" => $docente->restricoes,
            "docente_{$docenteId}_resp_ucs" => $docente->respUnidadesCurriculares,
            "restricao_{$restricaoId}_docente" => $restricao->docente,
            "uc_{$ucId}_cursos" => $uc->cursos,
            "uc_{$ucId}_laboratorios" => $uc->laboratorios,
            "uc_{$ucId}_resp" => $uc->responsavel,
            "uc_{$ucId}_docentes" => $uc->docentes
        ]);
    }
}
