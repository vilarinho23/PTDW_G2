<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Docente;
use App\Models\KeyValue;
use App\Models\Laboratorio;
use App\Models\RestricaoHorario;
use App\Models\UnidadeCurricular;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

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
        $users = User::with('docente')->get();
        $kvs = KeyValue::all();

        // Retornar JSON
        return response()->json([
            'cursos' => $cursos,
            'laboratorios' => $laboratorios,
            'docentes' => $docentes,
            'restricoes' => $restricoes,
            'ucs' => $ucs,
            'users' => $users,
            'kvs' => $kvs
        ]);
    }


    public function testarImport()
    {
        // Get file from storage
        $filename = 'Output_DSD.xlsx';
        $uploadedFile = new UploadedFile(
            Storage::path($filename),
            $filename,
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            null,
            true
        );

        // Put file on request object
        $request = new Request();
        $request->files->set('file', $uploadedFile);

        // Import file
        $controller = new ImportExportController();
        return $controller->import($request);
    }
}
