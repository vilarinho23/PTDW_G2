<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use App\Exports\Sheets\RestricoesPorCursoSheet;
use App\Exports\Sheets\RestricoesPorDocenteSheet;
use App\Exports\Sheets\RestricoesPorUCSheet;
use App\Models\Docente;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class RestricoesExport implements WithMultipleSheets
{
    private $docentes;
    public function __construct(Collection $docentes = null)
    {
        // If docentes are provided
        if ($docentes != null)
        {
            $this->docentes = $docentes;
            return;
        }


        // If docentes are not provided, get all docentes with restricoes and ucs
        $docentes = Docente::with('restricoes', 'respUnidadesCurriculares', 'unidadesCurriculares')->get();

        // Remove docentes without data_submissao and without ucs
        $docentes = $docentes->filter(function ($docente) {
            return $docente->data_submissao != null && !$docente->unidadesCurriculares->isEmpty();
        });

        $this->docentes = $docentes;
    }

    /**
     * Sheets: https://docs.laravel-excel.com/3.1/exports/multiple-sheets.html
     * @return array
     */
    public function sheets() : array
    {
        return [
            new RestricoesPorUCSheet($this->docentes),
            new RestricoesPorDocenteSheet($this->docentes),
            new RestricoesPorCursoSheet($this->docentes)
        ];
    }
}
