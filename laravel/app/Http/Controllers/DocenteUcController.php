<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DocenteUC;

class DocenteUcController extends Controller
{
    public function index()
    {
        $dados = DocenteUC::all();

        $funcionarios = DocenteUC::select('num_func')->distinct()->get();
        $ucs = DocenteUC::select('cod_uc')->distinct()->get();

        return view('atribuicaoUcs', ['dados' => $dados], compact('funcionarios', 'ucs'));
    }
}
