<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DocenteUC;

class DocenteUcController extends Controller
{
    public function index()
    {
        $dados = DocenteUC::all();
        return view('atribuicaoUcs', ['dados' => $dados]);
    }
}
