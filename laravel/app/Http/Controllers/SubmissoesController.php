<?php

namespace App\Http\Controllers;

use App\AppUtilities;
use App\Models\Docente;
use App\Models\Enums\DiaSemana;
use App\Models\Enums\ParteDia;
use App\Models\KeyValue;
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

        $data = [
            'pendentes' => $getPendentes,
            'submissoes' => $getSubmissoes,
            'nrSubmissoes' => count($getSubmissoes),
            'nrPorSubmeter' => count($getPendentes),
            'dataConclusao' => AppUtilities::getDataConclusao(),
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
}
