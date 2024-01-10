<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Docente;
use App\Models\UnidadeCurricular;

class DocenteUcController extends Controller
{
    public function index()
    {
        // Obtém todas as unidades curriculares que possuem docentes atribuídos
        $ucsDocentesCursos = UnidadeCurricular::has('docentes')->with(['docentes', 'cursos'])->get();

        // Obtém todos os docentes e unidades curriculares (para os combos)
        $funcionarios = Docente::select('num_func', 'nome_docente')->distinct()->get();
        $ucs = UnidadeCurricular::select('cod_uc', 'nome_uc')->distinct()->get();

        // Cria uma coleção com os dados necessários para a tabela
        $dados = $ucsDocentesCursos->map(function ($ucDocenteCurso) {
            return $ucDocenteCurso->docentes->map(function ($docente) use ($ucDocenteCurso) {
                $pivot = $docente->pivot;
                $item = new \stdClass();

                $item->docente = $docente;
                $item->unidadeCurricular = $ucDocenteCurso;
                $item->num_func = $pivot->num_func;
                $item->cod_uc = $pivot->cod_uc;
                $item->perc_horas = $pivot->perc_horas;

                return $item;
            });
        })->flatten();

        return view('atribuicaoUcs', compact('funcionarios', 'ucs', 'dados'));
    }

    public function store(Request $request)
    {
        // Valida os dados do formulário
        $request->validate([
            'dropdownAtribuirNFuncionario' => 'required',
            'dropdownAtribuirCodUc' => 'required',
            'inputAtribuirPerc' => 'required|numeric',
        ]);

        // Obtém os dados do formulário
        $num_func = $request->input('dropdownAtribuirNFuncionario');
        $cod_uc = $request->input('dropdownAtribuirCodUc');
        $perc_horas = $request->input('inputAtribuirPerc');

        // Obtém o docente e a unidade curricular
        $docente = Docente::find($num_func);
        $uc = UnidadeCurricular::find($cod_uc);

        // Verifica se o docente e a unidade curricular existem
        if ($docente == null || $uc == null) return redirect()->route('atribuicaoUcs')->with('error', 'Erro ao criar registro. Docente ou UC não encontrados.');

        // Cria a atribuição (se já existir, atualiza)
        $docente->unidadesCurriculares()->syncWithoutDetaching([$cod_uc => ['perc_horas' => $perc_horas]]);
        return redirect()->route('atribuicaoUcs')->with('success', 'Registro criado com sucesso.');
    }

    public function update(Request $request, $num_func, $cod_uc)
    {
        // Valida os dados do formulário
        $request->validate([
            'inputEditarPerc' => 'required|numeric',
        ]);

        // Obtém os dados do formulário
        $perc_horas = $request->input('inputEditarPerc');

        // Obtém o docente e a unidade curricular
        $docente = Docente::find($num_func);
        $uc = UnidadeCurricular::find($cod_uc);

        // Verifica se o docente e a unidade curricular existem
        if ($docente == null || $uc == null) return redirect()->route('atribuicaoUcs')->with('error', 'Erro ao atualizar registro. Docente ou UC não encontrados.');

        // Atualiza a atribuição (se não existir, cria)
        $docente->unidadesCurriculares()->syncWithoutDetaching([$cod_uc => ['perc_horas' => $perc_horas]]);
        return redirect()->route('atribuicaoUcs')->with('success', 'Atribuição atualizada com sucesso.');
    }

    public function destroy($num_func, $cod_uc)
    {
        // Obtém o docente
        $docente = Docente::find($num_func);

        // Verifica se o docente existe
        if ($docente == null) return redirect()->route('atribuicaoUcs')->with('error', 'Erro ao excluir registro. Docente não encontrado.');

        // Exclui a atribuição (se não existir, não faz nada)
        $docente->unidadesCurriculares()->detach($cod_uc);
        return redirect()->route('atribuicaoUcs')->with('success', 'Atribuição excluída com sucesso.');
    }
}
