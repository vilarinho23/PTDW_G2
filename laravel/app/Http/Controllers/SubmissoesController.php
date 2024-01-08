<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\Enums\DiaSemana;
use App\Models\Enums\ParteDia;
use App\Models\Enums\SalaAvaliacoes;
use App\Models\Enums\UtilizacaoLaboratorios;
use App\Models\KeyValue;
use App\Models\Laboratorio;
use Illuminate\Http\Request;

class SubmissoesController extends Controller
{
    private function getAll(){
        $data = Docente::all();
        return $data;
    }

    private function getSubmissoes(){
        $docentes = $this->getAll();

        $data = $docentes->filter(function ($item) {
            return isset($item->data_submissao) && !empty($item->data_submissao);
        });

        return $data;
    }
    private function getDataConclusao(){
        $data = KeyValue::val('data_conclusao');
        return $data;
    }

    public function submissoes(){
        $data = [
            'submissoes' => $this->getSubmissoes(),
            'nrSubmissoes' => count($this->getSubmissoes()),
            'nrPorSubmeter' => count($this->getAll()) - count($this->getSubmissoes()),
            'dataConclusao' => $this->getDataConclusao(),
        ];

        return view('submissoes', $data);
    }

    public function submeterData(Request $request)
    {
        $data = $request->json()->all();

        KeyValue::set('data_conclusao', $data['chosenDate']);
        return response()->json(['status' => 'success', 'newDate' => $data['chosenDate']], 200);
    }

    public function restricoes($id)
    {
        $docente = Docente::find($id);
        if ($docente == null) return redirect()->route('submissoes');

        $dados = $this->getDadosDocente($docente);
        if ($docente->unidadesCurriculares->isEmpty()) return redirect()->route('submissoes');

        $dados['laboratorios'] = Laboratorio::all();
        $dados['salaAvaliacoes'] = SalaAvaliacoes::cases();
        $dados['utilizacaoLab'] = UtilizacaoLaboratorios::cases();
        $dados['diasSemana'] = DiaSemana::cases();
        $dados['partesDia'] = ParteDia::cases();

        return view('restricoesComissao', $dados);
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

    private function getSemestre(): ?int
    {
        // Obter semestre
        $semestre = KeyValue::val('semestre');
        if ($semestre == null) return null;

        return intval($semestre);
    }
}
