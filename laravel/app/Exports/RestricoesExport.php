<?php

namespace App\Exports;

use App\Models\Docente;
use Maatwebsite\Excel\Concerns\FromArray;

class RestricoesExport implements FromArray
{
    /**
     * Array: https://docs.laravel-excel.com/3.1/exports/collection.html#using-arrays
     * @return array
     */
    public function array(): array
    {
        // n.º Func | nome docente | cód   | ACN | R | nome UC         | curso | lab | restrições    | sofware | email         | telefone  | h | % | subT
        // 7892     | Exemplo nome | 11000 | I   | X | Exemplo nome UC | TI    | x   | Apenas manhãs | Sofware | exemplo@ua.pt | 555555555 | 4 | 1 | 4
        $atrib = [
            // Header row
            ['n.º Func', 'nome docente', 'cód', 'ACN', 'R', 'nome UC', 'curso', 'lab', 'restrições', 'sofware', 'email', 'telefone', 'h', '%', 'subT']
        ];

        // Get all docentes with restricoes and ucs
        $docentes = Docente::with('restricoes', 'respUnidadesCurriculares', 'unidadesCurriculares')->get();

        // For each docente
        foreach ($docentes as $docente)
        {
            // Skip docentes without submissao or without ucs
            if ($docente->data_submissao == null) continue;
            if ($docente->unidadesCurriculares->isEmpty()) continue;


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
                $atrib[] = [
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

        return $atrib;
    }
}
