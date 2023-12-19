<?php

namespace App\Exports;

use App\Exports\Sheets\RestricoesPorCursoSheet;
use App\Exports\Sheets\RestricoesPorDocenteSheet;
use App\Exports\Sheets\RestricoesPorUCSheet;
use App\Models\Docente;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class RestricoesExport implements WithMultipleSheets
{
    /**
     * Sheets: https://docs.laravel-excel.com/3.1/exports/multiple-sheets.html
     * @return array
     */
    public function sheets() : array
    {
        // Get all docentes with restricoes and ucs
        $docentes = Docente::with('restricoes', 'respUnidadesCurriculares', 'unidadesCurriculares')->get();

        // Remove docentes without data_submissao and without ucs
        $docentes = $docentes->filter(function ($docente) {
            return $docente->data_submissao != null && !$docente->unidadesCurriculares->isEmpty();
        });

        return [
            new RestricoesPorUCSheet($docentes),
            new RestricoesPorDocenteSheet($docentes),
            new RestricoesPorCursoSheet($docentes)
        ];
    }
}
