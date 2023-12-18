<?php

namespace App\Http\Controllers;

use App\Imports\DSDImport;
use App\Models\Curso;
use App\Models\Docente;
use App\Models\Laboratorio;
use App\Models\RestricaoHorario;
use App\Models\UnidadeCurricular;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

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


    public function testarImport()
    {
        $filename = 'Output_DSD.xlsx';
        $haveFileDSD = Storage::exists($filename);
        if (!$haveFileDSD)
        {
            return response()->json([
                'message' => "Ficheiro $filename não encontrado"
            ]);
        }

        $import = new DSDImport;
        Excel::import($import, $filename);

        return response()->json([
            'message' => "Importação do ficheiro $filename concluída",
            'errors' => $import->getErrors()
        ]);
    }
}
