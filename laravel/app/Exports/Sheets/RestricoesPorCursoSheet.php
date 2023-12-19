<?php

namespace App\Exports\Sheets;

use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;

class RestricoesPorCursoSheet implements FromArray, WithTitle
{
    private $docentes;
    public function __construct(Collection $docentes)
    {
        $this->docentes = $docentes;
    }

    public function title(): string
    {
        return 'porCurso';
    }


    public function array(): array
    {
        // n.º Func | nome docente | cód   | ACN | R | nome UC         | curso | h | n.º | subT
        // 7892     | Exemplo nome | 11000 | I   | X | Exemplo nome UC | TI    | 4 | 1   | 4
        $atrib = [
            // Header row
            ['n.º Func', 'nome docente', 'cód', 'ACN', 'R', 'nome UC', 'curso', 'h', 'n.º', 'subT']
        ];

        // For each docente
        foreach ($this->docentes as $docente)
        {
            // Docente properties
            $numFunc = $docente->num_func;
            $nomeDocente = $docente->nome_docente;


            // Unidades Curriculares
            foreach ($docente->unidadesCurriculares as $uc)
            {
                // UC properties
                $codUC = $uc->cod_uc;
                $nomeUC = $uc->nome_uc;
                $horasUC = $uc->horas_uc;
                $acnUC = $uc->acn_uc;
                $resp = $uc->num_func_resp == $numFunc ? 'X' : '';

                // Cursos
                $cursos = $uc->cursos->map(function ($curso) {
                    return $curso->acron_curso;
                })->join(',') ?? '';

                // Docente-UC properties
                $perc = $uc->pivot->perc_horas / 100;
                $subT = $perc * $horasUC;


                // Add to array (export data)
                $atrib[] = [
                    $numFunc, $nomeDocente,
                    $codUC, $acnUC,
                    $resp, $nomeUC,
                    $cursos, $horasUC,
                    $perc, $subT
                ];
            }
        }

        return $atrib;
    }
}
