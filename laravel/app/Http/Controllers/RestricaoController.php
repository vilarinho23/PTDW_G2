<?php

namespace App\Http\Controllers;

use App\AppUtilities;
use App\Http\Requests\RestricoesRequest;
use App\Models\Enums\DiaSemana;
use App\Models\Enums\ParteDia;
use App\Models\Enums\SalaAvaliacoes;
use App\Models\Enums\UtilizacaoLaboratorios;
use App\Models\Laboratorio;
use App\Models\UnidadeCurricular;
use Carbon\Carbon;

class RestricaoController extends Controller
{
    public function docente()
    {
        // Obter docente
        $docente = AppUtilities::getDocente();

        // Obter dados do docente
        $dados = AppUtilities::getDadosDocente($docente);

        // Obter data de conclusao
        $dados['dataConclusao'] = AppUtilities::getDataConclusao();

        // Retornar informações para a view
        return view('docente', $dados);
    }


    public function restricoes()
    {
        // Obter docente
        $docente = AppUtilities::getDocente();

        // Obter data de conclusao
        $dataConclusao = AppUtilities::getDataConclusao();
        if ($dataConclusao == null) return redirect()->route('docente');

        // Obter dados do docente
        $dados = AppUtilities::getDadosDocente($docente);
        if ($dados['ucs']->isEmpty()) return redirect()->route('docente');

        // Retornar informações para a view
        $dados['dataConclusao'] = $dataConclusao;
        $dados['laboratorios'] = Laboratorio::all();
        $dados['salaAvaliacoes'] = SalaAvaliacoes::cases();
        $dados['utilizacaoLab'] = UtilizacaoLaboratorios::cases();
        $dados['diasSemana'] = DiaSemana::cases();
        $dados['partesDia'] = ParteDia::cases();

        return view('restricoes', $dados);
    }

    public function submeter(RestricoesRequest $request)
    {
        // Obter docente
        $docente = AppUtilities::getDocente();

        // Obter data de conclusao
        $dataConclusao = AppUtilities::getDataConclusao();
        if ($dataConclusao == null) return redirect()->route('docente');

        // Validar dados
        $safe = $request->safe();

        // Salvar UCs com as restrições submetidas
        foreach ($safe['ucs'] as $cod_uc => $uc)
        {
            $ucModel = UnidadeCurricular::find($cod_uc);
            if ($ucModel == null) continue;

            $ucModel->sala_avaliacoes = $uc['sala_avaliacoes'] ?? null;
            $ucModel->utilizacao_laboratorios = $uc['utilizacao_laboratorios'] ?? null;
            $ucModel->software_necessario = $uc['software_necessario'] ?? null;

            // Salvar laboratórios
            $ucModel->laboratorios()->detach();
            foreach ($uc['laboratorios'] ?? [] as $laboratorio)
            {
                $labModel = Laboratorio::find($laboratorio);
                if ($labModel == null) continue;

                $ucModel->laboratorios()->attach($labModel);
            }
            $ucModel->save();
        }

        // Salvar impedimentos
        $docente->restricoes()->delete();
        foreach ($safe['impedimentos'] ?? [] as $impedimento)
        {
            $docente->restricoes()->create([
                'dia_semana' => $impedimento['dia'],
                'parte_dia' => $impedimento['parte']
            ]);
        }

        // Atualizar data de submissao
        $docente->data_submissao = Carbon::now();
        $docente->save();

        return redirect()->route('docente');
    }
}
