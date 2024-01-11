<?php

namespace App\Http\Controllers;

use App\Models\UnidadeCurricular;
use App\Models\Curso;
use App\Models\Docente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

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
            'cod_uc' => 'required|integer',
            'nome_uc' => 'required|string',
            'horas_uc' => 'required|integer',
            'acn_uc' => 'required|string',
            'num_func_resp' => 'required|integer',
            'curso_uc' => 'required|array',
        ]);

        if ($dataValidator->fails()) {
            Log::error($dataValidator->errors()->first());
            return response()->json(['message' => 'Não foi possível adicionar a Unidade Curricular.'], 500);
        }

        $existingUnidadeCurricular = UnidadeCurricular::find($data['cod_uc']);

        if ($existingUnidadeCurricular) {
            Log::error("Unidade Curricular com o código já existe.");
            return response()->json(['message' => 'Já existe uma Unidade Curricular com esse código.'], 404);
        }

        try {
            $ucModel = UnidadeCurricular::updateOrCreate(
                ['cod_uc' => $data['cod_uc']],
                [
                    'nome_uc' => $data['nome_uc'],
                    'horas_uc' => $data['horas_uc'],
                    'acn_uc' => $data['acn_uc'],
                    'num_func_resp' => $data['num_func_resp'],
                ]
            );

            foreach ($data['curso_uc'] as $cursoAcron) {
                $curso = Curso::find($cursoAcron);

                if ($curso) {
                    $ucModel->cursos()->attach($curso->acron_curso);
                }
            }

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
            $uc = UnidadeCurricular::find($id);

            if (!$uc) {
                Log::error("Unidade Curricular não encontrada.");
                return response()->json(['message' => 'Não existe uma Unidade Curricular com esse código.'], 404);
            }

            $request->validate([
                'cod_uc' => 'required|integer',
                'nome_uc' => 'required|string',
                'horas_uc' => 'required|integer',
                'acn_uc' => 'required|string',
                'num_func_resp' => 'required|integer',
                'curso_uc' => 'required|array',
            ]);

            $uc->update([
                'nome_uc' => $request->input('nome_uc'),
                'horas_uc' => $request->input('horas_uc'),
                'acn_uc' => $request->input('acn_uc'),
                'num_func_resp' => $request->input('num_func_resp'),
            ]);

            $uc->cursos()->detach();

            foreach ($request->input('curso_uc') as $cursoAcron) {
                $curso = Curso::find($cursoAcron);

                if ($curso) {
                    $uc->cursos()->attach($curso->acron_curso);
                }
            }

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
        $unidadeCurricular = UnidadeCurricular::find($id);
        $cursos = $unidadeCurricular->cursos;
        return response()->json(['uc' => $unidadeCurricular, 'cursos' => $cursos]);
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