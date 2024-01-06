<?php

namespace App\Http\Controllers;

use App\Http\Requests\RestricoesRequest;
use App\Models\Docente;
use App\Models\Enums\DiaSemana;
use App\Models\Enums\ParteDia;
use App\Models\Enums\SalaAvaliacoes;
use App\Models\Enums\UtilizacaoLaboratorios;
use App\Models\KeyValue;
use App\Models\Laboratorio;
use App\Models\UnidadeCurricular;
use Carbon\Carbon;

class RestricaoController extends Controller
{
    private function getDocente(): Docente
    {
        return auth()->user()->docente;
    }

    private function getDadosDocente(Docente $docente): array
    {
        $semestre = $this->getSemestre();

        // Unidades Curriculares
        $ucs = $docente->unidadesCurriculares;
        $respUCs = $docente->respUnidadesCurriculares;

        // Filtrar UCs por semestre (se definido)
        if ($semestre != null)
        {
            $ucs = $ucs->where('semestre_uc', $semestre);
            $respUCs = $respUCs->where('semestre_uc', $semestre);
        }

        // Merge das UCs e das UCs que o docente é responsável (sem repetições)
        $ucs = $respUCs->merge($ucs);

        // Adicionar campo isresponsavel para as UCs que o docente é responsável
        foreach ($ucs as $uc) $uc->isresponsavel = $respUCs->contains($uc);

        // Restrições, data de submissao e nome
        $restricoes = $docente->restricoes;
        $dataSubmissao = $docente->data_submissao;

        return [
            'ucs' => $ucs,
            'restricoes' => $restricoes,
            'dataSubmissao' => $dataSubmissao
        ];
    }

    private function getDataConclusao(): ?Carbon
    {
        // Obter data de conclusao
        $dataConclusao = KeyValue::val('data_conclusao');
        if ($dataConclusao == null) return null;

        return Carbon::createFromFormat('d/m/Y', $dataConclusao);
    }

    private function getSemestre(): ?int
    {
        // Obter semestre
        $semestre = KeyValue::val('semestre');
        if ($semestre == null) return null;

        return intval($semestre);
    }


    public function docente()
    {
        // Obter docente
        $docente = $this->getDocente();

        // Obter dados do docente
        $dados = $this->getDadosDocente($docente);

        // Obter data de conclusao
        $dados['dataConclusao'] = $this->getDataConclusao();

        // Retornar informações para a view
        return view('docente', $dados);
    }


    public function restricoes()
    {
        // Obter docente
        $docente = $this->getDocente();

        // Obter data de conclusao
        $dataConclusao = $this->getDataConclusao();
        if ($dataConclusao == null) return redirect()->route('docente');

        // Obter dados do docente
        $dados = $this->getDadosDocente($docente);
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

    public function submeter(RestricoesRequest $request)
    {
        // Obter docente
        $docente = $this->getDocente();

        // Obter data de conclusao
        $dataConclusao = $this->getDataConclusao();
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
