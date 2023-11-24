<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Docente;
use App\Models\KeyValue;

class RestricaoController extends Controller
{
    public function docente()
    {
        // Docente
        $docenteNrFunc = 2;
        $docente = Docente::find($docenteNrFunc);
        if ($docente == null) abort(404);

        // Unidades Curriculares
        $ucs = $docente->unidadesCurriculares;
        $respUCs = $docente->respUnidadesCurriculares;

        $ucs = $ucs->merge($respUCs);
        foreach ($ucs as $uc) $uc->responsavel = $respUCs->contains($uc);

        // Restrições, data de submissao e nome
        $restricoes = $docente->restricoes;
        $dataSubmissao = $docente->data_submissao;
        $nomeDocente = $docente->nome_docente;

        // Obter data de conclusao
        $dataConclusao = KeyValue::val('data_conclusao');


        // Retornar informações para a view
        return view('docente', [
            'nomeDocente' => $nomeDocente,
            'ucs' => $ucs,
            'restricoes' => $restricoes,
            'dataSubmissao' => $dataSubmissao,
            'dataConclusao' => $dataConclusao
        ]);
    }
}
