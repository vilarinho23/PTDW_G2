<?php

namespace App\Http\Controllers;

use App\AppUtilities;
use App\Models\Docente;
use App\Models\Enums\DiaSemana;
use App\Models\Enums\ParteDia;
use App\Models\KeyValue;
use App\Models\UnidadeCurricular;
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

    private function getPendentes(){
        $docentes = $this->getAll();

        $filteredDocentes = $docentes->filter(function ($docente) {
            $dadosDocente = AppUtilities::getDadosDocente($docente);
            $areUCsNotEmptyOrNull = $dadosDocente['ucs']->isNotEmpty();
            $isDataSubmissaoNotDefined = empty($dadosDocente['dataSubmissao']);

            return $areUCsNotEmptyOrNull && $isDataSubmissaoNotDefined;
        });
        return $filteredDocentes;
    }

    public function submissoes(){
        $getSubmissoes = $this->getSubmissoes();
        $getPendentes = $this->getPendentes();

        $dataConclusao = AppUtilities::getDataConclusao();
        $dataConclusaoStr = ($dataConclusao != null) ? $dataConclusao->format('d/m/Y') : "Sem Data Definida";

        $data = [
            'pendentes' => $getPendentes,
            'submissoes' => $getSubmissoes,
            'nrSubmissoes' => count($getSubmissoes),
            'nrPorSubmeter' => count($getPendentes),
            'dataConclusao' => $dataConclusaoStr
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
        // Obter docente
        $docente = Docente::find($id);
        if ($docente == null) return redirect()->route('submissoes');

        // Obter dados do docente - se não tiver sido submetido, redirecionar para a página de submissões
        $dados = AppUtilities::getDadosDocente($docente);
        if ($dados['dataSubmissao'] == null) return redirect()->route('submissoes');

        $dados['diasSemana'] = DiaSemana::cases();
        $dados['partesDia'] = ParteDia::cases();

        return view('restricoesComissao', $dados);
    }

    public function limparSubmissoes()
    {
        // For each Docente:
        // delete all RestricaoHorario
        // set data_submissao and observacoes to null
        Docente::all()->each(function ($docente) {
            $docente->restricoes()->delete();
            $docente->data_submissao = null;
            $docente->observacoes = null;

            $docente->save();
        });

        // For each UnidadeCurricular:
        // detach all Laboratorio
        // set sala_avaliacoes, utilizacao_laboratorios and software_necessario to null
        UnidadeCurricular::all()->each(function ($uc) {
            $uc->laboratorios()->detach();

            $uc->sala_avaliacoes = null;
            $uc->utilizacao_laboratorios = null;
            $uc->software_necessario = null;

            $uc->save();
        });
    }
}
