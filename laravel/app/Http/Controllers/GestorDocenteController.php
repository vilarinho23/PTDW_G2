<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Docente;
use Illuminate\Support\Facades\Log;


class GestorDocenteController extends Controller
{
    public function listarDocentes()
    {
        $docentes = Docente::orderBy('num_func', 'asc')->get();
        
        return view('gestorDocentes', compact('docentes'));
    }

    public function pesquisarDocente($id)
    {
        $docente = Docente::find($id);
        return response()->json($docente);
    }

    public function adicionarDocente(Request $request)
    {
        try {
            $request->validate([
                'num_func' => 'required|integer',
                'nome_docente' => 'required|string',
                'acn_docente' => 'required|string',
                'telef_docente' => 'required|integer',
                'email_docente' => 'required|email',
            ], [
                'num_func.required' => 'O número de funcionário é obrigatório.',
                'num_func.integer' => 'O número de funcionário deve ser um número.',
                'nome_docente.required' => 'O nome do docente é obrigatório.',
                'acn_docente.required' => 'A ACN do docente é obrigatório.',
                'telef_docente.required' => 'O telefone do docente é obrigatório.',
                'telef_docente.integer' => 'O telefone do docente deve ser um número.',
                'email_docente.required' => 'O email do docente é obrigatório.',
                'email_docente.email' => 'Por favor, insira um endereço de email válido.',
            ]);

            Log::info($request);

            $novoDocente = new Docente([
                'num_func' => $request->input('num_func'),
                'nome_docente' => $request->input('nome_docente'),
                'acn_docente' => $request->input('acn_docente'),
                'telef_docente' => $request->input('telef_docente'),
                'email_docente' => $request->input('email_docente'),

            ]);


            $novoDocente->save();
            Log::info('Response Data: ' . json_encode(['message' => 'Docente adicionado com sucesso']));

            return response()->json(['message' => 'Docente adicionado com sucesso'], 201);
        } catch (\Exception $e) {
            Log::error('Exception: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function editarDocente(Request $request, $id)
    {
        $docente = Docente::findOrFail($id);
        try{
            $request->validate([
                'num_func' => 'required|integer',
                'nome_docente' => 'required|string',
                'acn_docente' => 'required|string',
                'telef_docente' => 'required|integer',
                'email_docente' => 'required|email',
            ], [
                'num_func.required' => 'O número de funcionário é obrigatório.',
                'num_func.integer' => 'O número de funcionário deve ser um número.',
                'nome_docente.required' => 'O nome do docente é obrigatório.',
                'acn_docente.required' => 'A ACN do docente é obrigatório.',
                'telef_docente.required' => 'O telefone do docente é obrigatório.',
                'telef_docente.integer' => 'O telefone do docente deve ser um número.',
                'email_docente.required' => 'O email do docente é obrigatório.',
                'email_docente.email' => 'Por favor, insira um endereço de email válido.',
            ]);

            $docente->update([
                'num_func' => $request->input('num_func'),
                'nome_docente' => $request->input('nome_docente'),
                'acn_docente' => $request->input('acn_docente'),
                'telef_docente' => $request->input('telef_docente'),
                'email_docente' => $request->input('email_docente'),
                
            ]);

            Log::info($request);
            Log::info('Response Data: ' . json_encode(['message' => 'Docente atualizado com sucesso']));
            return response()->json(['message' => 'Docente atualizado com sucesso'], 201);
        } catch (\Exception $e) {
            Log::error('Exception: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function eliminarDocente($id)
    {
        $docente = Docente::findOrFail($id);
        $docente->delete();

        return response()->json(['message' => 'Docente excluído com sucesso']);
    }
}
