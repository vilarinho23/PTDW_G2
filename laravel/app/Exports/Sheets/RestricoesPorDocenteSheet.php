<?php

namespace App\Exports\Sheets;

use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RestricoesPorDocenteSheet implements FromArray, WithTitle, WithHeadings
{
    private $docentes;
    public function __construct(Collection $docentes)
    {
        $this->docentes = $docentes;
    }

    /**
     * Title: https://docs.laravel-excel.com/3.1/exports/multiple-sheets.html#sheet-classes
     * @return string
     */
    public function title(): string
    {
        return 'porDocente';
    }


    /**
     * Headings: https://docs.laravel-excel.com/3.1/exports/mapping.html#adding-a-heading-row
     * @return array
     */
    public function headings(): array
    {
        // n.º Func | nome docente | cód   | ACN | R | nome UC         | curso | lab | restrições    | software | email         | telefone  | h | % | subT
        // 7892     | Exemplo nome | 11000 | I   | X | Exemplo nome UC | TI    | x   | Apenas manhãs | Software | exemplo@ua.pt | 555555555 | 4 | 1 | 4
        return ['n.º Func', 'nome docente', 'cód', 'ACN', 'R', 'nome UC', 'curso', 'lab', 'restrições', 'software', 'email', 'telefone', 'h', '%', 'subT'];
    }

    /**
     * Array: https://docs.laravel-excel.com/3.1/exports/collection.html#using-arrays
     * @return array
     */
    public function array(): array
    {
        $content = [];

        // For each docente
        foreach ($this->docentes as $docente)
        {
            // Docente properties
            $numFunc = $docente->num_func;
            $nomeDocente = $docente->nome_docente;
            $emailDocente = $docente->email_docente;
            $telefoneDocente = $docente->telef_docente;


            // Docente restricoes
            $restricoes = $docente->restricoes->map(function ($restricao) {
                return $restricao->dia_semana->value . '_' . $restricao->parte_dia->value;
            })->join(',') ?? '';


            // Unidades Curriculares
            foreach ($docente->unidadesCurriculares as $uc)
            {
                // UC properties
                $codUC = $uc->cod_uc;
                $nomeUC = $uc->nome_uc;
                $horasUC = $uc->horas_uc;
                $acnUC = $uc->acn_uc;
                $resp = $uc->num_func_resp == $numFunc ? 'X' : '';
                $softwareUC = $uc->software_necessario ?? '';

                // Cursos
                $cursos = $uc->cursos->map(function ($curso) {
                    return $curso->acron_curso;
                })->join(',') ?? '';

                // Labs
                $labUC = $uc->utilizacao_laboratorios != null ? 'X' : '';

                // Docente-UC properties
                $perc = $uc->pivot->perc_horas / 100;
                $subT = $perc * $horasUC;


                // Add to array (export data)
                $content[] = [
                    $numFunc, $nomeDocente,
                    $codUC, $acnUC,
                    $resp, $nomeUC,
                    $cursos, $labUC,
                    $restricoes, $softwareUC,
                    $emailDocente, $telefoneDocente,
                    $horasUC, $perc,
                    $subT
                ];
            }
        }

        return $content;
    }
}
