<?php

namespace App\Http\Controllers;

use App\Models\UnidadeCurricular;
use App\Models\Curso;
use App\Models\Docente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Validator;

class GestorUcController extends Controller
{
    //Lista todas as UC's
    public function getAllUnidadesCurriculares()
{
    $unidadesCurriculares = UnidadeCurricular::all();
    $cursos = Curso::all();
    $docentesResponsaveis = Docente::all();

    return view('gestorUcs', compact('unidadesCurriculares', 'cursos', 'docentesResponsaveis'));
}



    //Adiciona uma UC e guarda na BD
    public function adicionarUnidadeCurricular(Request $request)
    {
        $data = $request->json()->all();

        $dataValidator = Validator::make($data, [
            'cod_uc' => 'required|unique:unidade_curricular,cod_uc',
            'nome_uc' => 'required|string',
            'horas_uc' => 'required|integer',
            'acn_uc' => 'required|string',
            'num_func_resp' => 'required|integer',
            'curso_uc' => 'required|string',
        ]);

        if ($dataValidator->fails()) {
            Log::error($dataValidator->errors()->first());
            return response()->json(['message' => 'Não foi possível adicionar a Unidade Curricular.'], 500);
        }

        try {
            $curso = Curso::where('acron_curso', $data['curso_uc'])->first();

            if (!$curso) {
                return response()->json(['message' => 'Curso não encontrado.'], 404);
            }

            UnidadeCurricular::updateOrCreate(
                ['cod_uc' => $data['cod_uc']],
                [
                    'nome_uc' => $data['nome_uc'],
                    'horas_uc' => $data['horas_uc'],
                    'acn_uc' => $data['acn_uc'],
                    'num_func_resp' => $data['num_func_resp'],
                    'curso_uc' => $curso->acron_curso,
                ]
            );

            Log::info('Response Data: ' . json_encode(['message' => 'Unidade Curricular adicionada/atualizada com sucesso']));
            return response()->json(['message' => 'Unidade Curricular adicionada/atualizada com sucesso!'], 200);
        } catch (\Exception $e) {
            Log::error('Exception: ' . $e->getMessage());
            return response()->json(['message' => 'Não foi possível adicionar/atualizar a Unidade Curricular.'], 500);
        }
    }

/*
    public function editUnidadeCurricular($id)
    {
        $unidadesCurriculares = UnidadeCurricular::find($id);
        $cursos = Curso::all();
        $docentesResponsaveis = Docente::all();

        return view('editUnidadeCurricular', compact('unidadesCurriculares', 'cursos', 'docentesResponsaveis'));
    }

    // Processar atualização dos dados
    public function updateUnidadeCurricular(Request $request, $id)
    {
        // Validação dos dados
        $request->validate([
            'curso_uc' => 'required|string|max:255',
            'nome_uc' => 'required|string|max:255',
            'horas_uc' => 'required|integer',
            'acn_uc' => 'required|string|max:255',
            'num_func_resp' => 'required|string|max:255',
        ]);
    
        try {
            // Obtém o curso
            $curso = Curso::where('acron_curso', $request->input('curso_uc'))->first();
    
            if (!$curso) {
                return response()->json(['message' => 'Curso não encontrado.'], 404);
            }
    
            // Use o método findOrFail para obter a instância do modelo para atualização
            $unidadesCurriculares = UnidadeCurricular::findOrFail($id);
    
            // Atualiza os atributos conforme necessário
            $unidadesCurriculares->nome_uc = $request->input('nome_uc');
            $unidadesCurriculares->horas_uc = $request->input('horas_uc');
            $unidadesCurriculares->acn_uc = $request->input('acn_uc');
            $unidadesCurriculares->num_func_resp = $request->input('num_func_resp');
            $unidadesCurriculares->curso_uc = $curso->acron_curso;
    
            $unidadesCurriculares->save();
    
            return response()->json(['message' => 'Unidade Curricular atualizada com sucesso!'], 200);
        } catch (\Exception $e) {
            Log::error('Exception: ' . $e->getMessage());
            return response()->json(['message' => 'Não foi possível atualizar a Unidade Curricular.'], 500);
        }
    } */

}
