<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Docente;
use App\Models\Laboratorio;
use App\Models\RestricaoHorario;
use App\Models\UnidadeCurricular;

class TesteController extends Controller
{
    public function testarModels()
    {
        // Buscar/criar dados
        $cursos = Curso::with('unidadesCurriculares')->get();
        $laboratorios = Laboratorio::with('unidadesCurriculares')->get();
        $docentes = Docente::with('restricoes', 'respUnidadesCurriculares', 'unidadesCurriculares')->get();
        $restricoes = RestricaoHorario::with('docente')->get();
        $ucs = UnidadeCurricular::with('cursos', 'laboratorios', 'responsavel', 'docentes')->get();

        // Retornar JSON
        return response()->json([
            'cursos' => $cursos,
            'laboratorios' => $laboratorios,
            'docentes' => $docentes,
            'restricoes' => $restricoes,
            'ucs' => $ucs
        ]);
    }
}
