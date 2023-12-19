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
                'num_func' => 'required',
                'nome_docente' => 'required',
                'acn_docente' => 'required',
            ]);

            Log::info($request);

            $novoDocente = new Docente([
                'num_func' => $request->input('num_func'),
                'nome_docente' => $request->input('nome_docente'),
                'acn_docente' => $request->input('acn_docente'),

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

        $docente->update([
            'num_func' => $request->input('num_func'),
            'nome_docente' => $request->input('nome_docente'),
            'acn_docente' => $request->input('acn_docente'),
            
        ]);

        Log::info($request);
        Log::info('Response Data: ' . json_encode(['message' => 'Docente atualizado com sucesso']));
        return response()->json(['message' => 'Docente atualizado com sucesso']);
    }
}
