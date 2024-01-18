<?php

namespace App;

use App\Models\Docente;
use App\Models\KeyValue;
use Carbon\Carbon;

class AppUtilities
{
    public static function getDocente(): ?Docente
    {
        return auth()->user()?->docente;
    }

    public static function getDadosDocente(Docente $docente): array
    {
        $semestre = AppUtilities::getSemestre();
        // Unidades Curriculares
        $ucs = $docente->unidadesCurriculares;
        $respUCs = $docente->respUnidadesCurriculares;
        // Filtrar UCs por semestre
        $ucs = $ucs->where('semestre_uc', $semestre);
        $respUCs = $respUCs->where('semestre_uc', $semestre);
        // Merge das UCs e das UCs que o docente é responsável (sem repetições)
        $ucs = $respUCs->merge($ucs);

        // Adicionar campo isresponsavel para as UCs que o docente é responsável
        foreach ($ucs as $uc) $uc->isresponsavel = $respUCs->contains($uc);

        // Ordenar UCs por isresponsavel e cod_uc
        $ucs->sortBy('isresponsavel')->sortBy('cod_uc');

        // Restrições, data de submissao, nome e num_func
        $restricoes = $docente->restricoes;
        $dataSubmissao = $docente->data_submissao;
        $nomeDocente = $docente->nome_docente;
        $numFunc = $docente->num_func;

        return [
            'numFunc' => $numFunc,
            'nomeDocente' => $nomeDocente,
            'ucs' => $ucs,
            'restricoes' => $restricoes,
            'dataSubmissao' => $dataSubmissao
        ];
    }

    public static function getDataConclusao(): ?Carbon
    {
        // Obter data de conclusao
        $dataConclusao = KeyValue::val('data_conclusao');
        if ($dataConclusao == null) return null;

        return Carbon::createFromFormat('d/m/Y', $dataConclusao);
    }


    // Retorna o semestre a partir de uma data
    public static function getSemestreFromDate(Carbon $date): int
    {
        // Comissão de Horários starts earlier
        // 1º semestre: setembro-fevereiro (early: maio-outubro)
        // 2º semestre: fevereiro-julho (early: novembro-abril)
        $semestre = $date->isBetween(
            Carbon::createFromDate($date->year, 5, 1),
            Carbon::createFromDate($date->year, 10, 31)
        ) ? 1 : 2;

        return $semestre;
    }

    // Retorna o semestre atual
    public static function getSemestreAtual(): int
    {
        $now = Carbon::now();
        return self::getSemestreFromDate($now);
    }

    // Retorna o semestre da data de conclusão (se definida) ou o semestre atual
    public static function getSemestre(): int
    {
        // Obtem a data de conclusão
        $dataConclusao = self::getDataConclusao();
        if ($dataConclusao == null) return self::getSemestreAtual();

        // Obtem o semestre da data de conclusão
        return self::getSemestreFromDate($dataConclusao);
    }
}
