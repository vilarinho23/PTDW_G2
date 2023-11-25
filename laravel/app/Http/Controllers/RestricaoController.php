<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Docente;
use App\Models\Enums\DiaSemana;
use App\Models\Enums\ParteDia;
use App\Models\Enums\SalaAvaliacoes;
use App\Models\Enums\UtilizacaoLaboratorios;
use App\Models\KeyValue;
use App\Models\Laboratorio;
use Carbon\Carbon;

class RestricaoController extends Controller
{
    private function getDocente(): Docente
    {
        // Obter docente
        $docenteNrFunc = 2;
        $docente = Docente::find($docenteNrFunc);

        return $docente;
    }

    private function getDadosDocente(Docente $docente): array
    {
        // Unidades Curriculares
        $ucs = $docente->unidadesCurriculares;
        $respUCs = $docente->respUnidadesCurriculares;

        $ucs = $ucs->merge($respUCs);
        foreach ($ucs as $uc) $uc->isresponsavel = $respUCs->contains($uc);

        // Restrições, data de submissao e nome
        $restricoes = $docente->restricoes;
        $dataSubmissao = $docente->data_submissao;
        $nomeDocente = $docente->nome_docente;

        return [
            'nomeDocente' => $nomeDocente,
            'ucs' => $ucs,
            'restricoes' => $restricoes,
            'dataSubmissao' => $dataSubmissao
        ];
    }

    private function getDataConclusao(): Carbon|null
    {
        // Obter data de conclusao
        $dataConclusao = KeyValue::val('data_conclusao');
        if ($dataConclusao == null) return null;

        return Carbon::createFromFormat('d/m/Y', $dataConclusao);
    }


    public function docente()
    {
        // Obter docente
        $docente = self::getDocente();
        if ($docente == null) return redirect()->route('home');

        // Obter dados do docente
        $dados = self::getDadosDocente($docente);

        // Obter data de conclusao
        $dados['dataConclusao'] = self::getDataConclusao();

        // Retornar informações para a view
        return view('docente', $dados);
    }


    public function restricoes()
    {
        // Obter docente
        $docente = self::getDocente();
        if ($docente == null) return redirect()->route('home');

        // Obter data de conclusao
        $dataConclusao = self::getDataConclusao();
        if ($dataConclusao == null) return redirect()->route('docente');

        // Obter dados do docente
        $dados = self::getDadosDocente($docente);
        if ($docente->unidadesCurriculares->isEmpty()) return redirect()->route('docente');

        // Retornar informações para a view
        $dados['dataConclusao'] = $dataConclusao;
        $dados['laboratorios'] = Laboratorio::all();
        $dados['salaAvaliacoes'] = SalaAvaliacoes::cases();
        $dados['utilizacaoLab'] = UtilizacaoLaboratorios::cases();
        $dados['diasSemana'] = DiaSemana::cases();
        $dados['partesDia'] = ParteDia::cases();

        return view('restricoes', $dados);
    }

    public function submeter(Request $request)
    {
        return response()->json($request->all());
    }
}
