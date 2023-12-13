<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Docente;

class GestorDocenteController extends Controller
{
    public function listarDocentes(){
        $docentes = Docente::all();
        return view('gestorDocentes', compact('docentes'));
    }

    public function pesquisarDocente($id){
        $docente = Docente::find($id); 
        return response()->json($docente); 
    }

    public function adicionarDocente(Request $request)
    {
        // Valide os dados do formulário conforme necessário
        $request->validate([
            'inputAdicionarNFuncionario' => 'required',
            'inputAdicionarNome' => 'required',
            'inputAdicionarAcn' => 'required',
        ]);

        $novoDocente = Docente::create([
            'num_func' => $request->input('inputAdicionarNFuncionario'),
            'nome_docente' => $request->input('inputAdicionarNome'),
            'acn_docente' => $request->input('inputAdicionarAcn'),
        ]);

        // Faça algo com o novo docente, se necessário

        return redirect()->route('adicionar.docente')->with('success', 'Docente adicionado com sucesso!');
    }

    public function editarDocente(Request $request, $id)
    {
        $request->validate([
            'inputEditarNFuncionario' => 'required',
            'inputEditarNome' => 'required',
            'inputEditarAcn' => 'required',
        ]);

        $docente = Docente::find($id);

        $docente->update([
            'num_func' => $request->input('inputEditarNFuncionario'),
            'nome_docente' => $request->input('inputEditarNome'),
            'acn_docente' => $request->input('inputEditarAcn'),
        ]);


        return redirect()->route('editar.docente')->with('success', 'Docente editado com sucesso!');
    }
}

