<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\KeyValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SubmissoesController extends Controller
{
    private function getAll(){
        $data = Docente::all()->toArray();
        return $data;
    }

    private function getSubmissoes(){
        $docentes = $this->getAll();

        $data = array_filter($docentes, function ($item) {
            return isset($item['data_submissao']) && !empty($item['data_submissao']);
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
}
