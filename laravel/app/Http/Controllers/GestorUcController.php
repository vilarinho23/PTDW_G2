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

    

    //Edita uma UC e guarda na BD
    public function updateUnidadeCurricular(Request $request, $id)
    {
        try {
            $curso = Curso::where('acron_curso', $request->input('curso_uc'))->first();

            if (!$curso) {
                return response()->json(['message' => 'Curso não encontrado.'], 404);
            }

            $uc = UnidadeCurricular::where('cod_uc', $id)->first();

            if (!$uc) {
                return response()->json(['message' => 'Unidade Curricular não encontrada.'], 404);
            }

            $request->validate([
                'cod_uc' => 'required|unique:unidade_curricular,cod_uc,' . $uc->cod_uc,
                'nome_uc' => 'required|string',
                'horas_uc' => 'required|integer',
                'acn_uc' => 'required|string',
                'num_func_resp' => 'required|integer',
                'curso_uc' => 'required|string',
            ], [
                'nome_uc.required' => 'O nome da Unidade Curricular é obrigatório.',
                'nome_uc.string' => 'O nome da Unidade Curricular deve ser constituídos por letras.',
                'horas_uc.required' => 'As horas da Unidade Curricular são obrigatórias.',
                'horas_uc.integer' => 'O nome da Unidade Curricular deve ser um número.',
                'acn_uc.required' => 'O ACN da Unidade Curricular é obrigatório.',
                'acn_uc.string' => 'O nome da Unidade Curricular deve ser constituídos por letras.',
                'num_func_resp.required' => 'O número de funcionário responsável é obrigatório.',
                'num_func_resp.integer' => 'O nome da Unidade Curricular deve ser um número.',
                'curso_uc.required' => 'O curso da Unidade Curricular é obrigatório.',
                'curso_uc.string' => 'O curso da Unidade Curricular deve ser constituídos por letras.',
            ]);

            $uc->update([
                'nome_uc' => $request->input('nome_uc'),
                'horas_uc' => $request->input('horas_uc'),
                'acn_uc' => $request->input('acn_uc'),
                'num_func_resp' => $request->input('num_func_resp'),
                'curso_uc' => $curso->acron_curso,
            ]);

            Log::info($request);
            Log::info('Response Data: ' . json_encode(['message' => 'Unidade Curricular atualizada com sucesso']));
            return response()->json(['message' => 'Unidade Curricular atualizada com sucesso!'], 200);
        } catch (\Exception $e) {
            Log::error('Exception: ' . $e->getMessage());
            return response()->json(['message' => 'Não foi possível editar a Unidade Curricular.'], 500);
        }
    }

    //Pesquisa uma UC
    public function pesquisarUnidadeCurricular($id)
    {
        $unidadesCurriculares = UnidadeCurricular::find($id);
        return response()->json($unidadesCurriculares);
    }

    //Elimina uma UC e guarda na BD
    public function eliminarUnidadeCurricular($id){
        try {
            $unidadesCurriculares = UnidadeCurricular::findOrFail($id);
            $unidadesCurriculares->delete();
    
            Log::info('Response Data: ' . json_encode(['message' => 'Unidade Curricular eliminada com sucesso']));
            return response()->json(['message' => 'Unidade Curricular eliminada com sucesso!'], 200);
        } catch (\Exception $e) {
            Log::error('Exception: ' . $e->getMessage());
            return response()->json(['message' => 'Não foi possível eliminar a Unidade Curricular.'], 500);
        }
    }
}