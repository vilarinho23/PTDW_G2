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

        $funcionarios = Docente::select('num_func')->distinct()->get();
        $ucs = UnidadeCurricular::select('cod_uc')->distinct()->get();

        return view('atribuicaoUcs', ['dados' => $dados], compact('funcionarios', 'ucs'));
    }
}
