<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DocenteUC;
use App\Models\Docente;
use App\Models\UnidadeCurricular;

class DocenteUcController extends Controller
{
    public function index()
    {
        $dados = DocenteUC::all();

        $funcionarios = Docente::select('num_func', 'nome_docente')->distinct()->get();
        $ucs = UnidadeCurricular::select('cod_uc', 'nome_uc')->distinct()->get();

        return view('atribuicaoUcs', ['dados' => $dados], compact('funcionarios', 'ucs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dropdownAtribuirNFuncionario' => 'required',
            'dropdownAtribuirCodUc' => 'required',
            'inputAtribuirPerc' => 'required|numeric',
        ]);

        DocenteUC::create([
            'num_func' => $request->input('dropdownAtribuirNFuncionario'),
            'cod_uc' => $request->input('dropdownAtribuirCodUc'),
            'perc_horas' => $request->input('inputAtribuirPerc'),
        ]);

        return redirect()->route('atribuicaoUcs')->with('success', 'Registro criado com sucesso.');
    }
}
