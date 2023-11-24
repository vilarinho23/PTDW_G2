<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Docente;
use App\Models\KeyValue;
use App\Models\Laboratorio;
use App\Models\RestricaoHorario;
use App\Models\UnidadeCurricular;

use Database\Seeders\CursoSeeder;
use Database\Seeders\LaboratorioSeeder;

class TesteController extends Controller
{
    private function cursos()
    {
        $cursos = Curso::with('unidadesCurriculares')->get();
        if ($cursos->isEmpty())
        {
            // Criar cursos se não existirem (seeder)
            $seeder = new CursoSeeder();
            $seeder->run();

            $cursos = Curso::with('unidadesCurriculares')->get();
        }

        return $cursos;
    }

    private function laboratorios()
    {
        $laboratorios = Laboratorio::with('unidadesCurriculares')->get();
        if ($laboratorios->isEmpty())
        {
            // Criar laboratorios se não existirem (seeder)
            $seeder = new LaboratorioSeeder();
            $seeder->run();

            $laboratorios = Laboratorio::with('unidadesCurriculares')->get();
        }

        return $laboratorios;
    }

    private function docentes()
    {
        $docentes = Docente::with('restricoes', 'respUnidadesCurriculares', 'unidadesCurriculares')->get();
        if ($docentes->isEmpty())
        {
            // Criar docentes se não existirem
            $modelsMade = Docente::factory(5)->make();
            foreach ($modelsMade as $model) Docente::firstOrCreate($model->toArray());

            $docentes = Docente::with('restricoes', 'respUnidadesCurriculares', 'unidadesCurriculares')->get();
        }

        return $docentes;
    }

    private function restricoes($docentes)
    {
        $restricoes = RestricaoHorario::with('docente')->get();
        if ($restricoes->isEmpty())
        {
            // Criar restrições se não existirem e associar a docentes
            $modelsMade = RestricaoHorario::factory(10)
                ->recycle($docentes)
                ->make();
            foreach ($modelsMade as $model) RestricaoHorario::firstOrCreate($model->toArray());

            $restricoes = RestricaoHorario::with('docente')->get();
        }

        return $restricoes;
    }

    private function ucs($cursos, $laboratorios, $docentes)
    {
        $ucs = UnidadeCurricular::with('cursos', 'laboratorios', 'responsavel', 'docentes')->get();
        if ($ucs->isEmpty())
        {
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

            $ucs = UnidadeCurricular::with('cursos', 'laboratorios', 'responsavel', 'docentes')->get();
        }

        return $ucs;
    }


    public function testarModels()
    {
        // Buscar/criar dados
        $cursos = $this->cursos();
        $laboratorios = $this->laboratorios();
        $docentes = $this->docentes();
        $restricoes = $this->restricoes($docentes);
        $ucs = $this->ucs($cursos, $laboratorios, $docentes);

        // Retornar JSON
        return response()->json([
            'cursos' => $cursos,
            'laboratorios' => $laboratorios,
            'docentes' => $docentes,
            'restricoes' => $restricoes,
            'ucs' => $ucs
        ]);
    }


    public function testarKV()
    {
        // Flush keys
        KeyValue::set('flush', 'flush');
        KeyValue::flush();

        // Set keys
        KeyValue::set('key', 'value');
        KeyValue::set('key', 'newvalue');

        KeyValue::set('key1', 'value1');
        KeyValue::set('key2', 'value2');
        KeyValue::set('key3', 'value3');

        KeyValue::set('key_null', 'null');
        KeyValue::set('key_null', null);

        // Copy key
        KeyValue::copy('key', 'key_copy');

        // Del key
        KeyValue::del('key1');


        // Return JSON
        return response()->json([
            'key' => KeyValue::val('key'),
            'key1' => KeyValue::val('key1'),
            'key_null' => KeyValue::val('key_null'),

            'exists_key_e_key1' => KeyValue::exists('key', 'key1'),
            'exists_key_null' => KeyValue::exists('key_null'),

            'size' => KeyValue::size(),
            'all' => KeyValue::all(),
            'all_keys' => KeyValue::keys()
        ]);
    }
}
