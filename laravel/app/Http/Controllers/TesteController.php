<?php

namespace App\Http\Controllers;

use App\Imports\DSDImport;
use App\Models\Curso;
use App\Models\Docente;
use App\Models\KeyValue;
use App\Models\Laboratorio;
use App\Models\RestricaoHorario;
use App\Models\UnidadeCurricular;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class TesteController extends Controller
{
    public function testarModels()
    {
        // Buscar dados
        $cursos = Curso::with('unidadesCurriculares')->get();
        $laboratorios = Laboratorio::with('unidadesCurriculares')->get();
        $docentes = Docente::with('restricoes', 'respUnidadesCurriculares', 'unidadesCurriculares')->get();
        $restricoes = RestricaoHorario::with('docente')->get();
        $ucs = UnidadeCurricular::with('cursos', 'laboratorios', 'responsavel', 'docentes')->get();
        $kvs = KeyValue::all();

        // Retornar JSON
        return response()->json([
            'cursos' => $cursos,
            'laboratorios' => $laboratorios,
            'docentes' => $docentes,
            'restricoes' => $restricoes,
            'ucs' => $ucs,
            'kvs' => $kvs
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

        // Set last import filename, uploader and timestamp
        KeyValue::set('last_import:filename', $filename);
        KeyValue::set('last_import:uploader', 'TesteController@testarImport');
        KeyValue::set('last_import:timestamp', Carbon::now()->format('d/m/Y H:i:s'));

        // Set last import errors (line numbers)
        $errorLines = array_keys($import->getErrors());
        $errorLines = $errorLines == [] ? null : implode(',', $errorLines);
        KeyValue::set('last_import:line_errors', $errorLines);

        // Return response
        return response()->json([
            'message' => "Importação do ficheiro $filename concluída",
            'errors' => $import->getErrors()
        ]);
    }
}
