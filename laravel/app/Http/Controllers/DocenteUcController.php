<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Docente;
use App\Models\KeyValue;
use App\Models\UnidadeCurricular;

class DocenteUcController extends Controller
{
    private function getAtribuicoes()
    {
        // Obtém todas as unidades curriculares que possuem docentes atribuídos
        $ucsDocentesCursos = UnidadeCurricular::has('docentes')->with(['docentes', 'cursos'])->get();

        // Cria uma coleção com os dados necessários para a tabela
        $atribuicoes = $ucsDocentesCursos->map(function ($ucDocenteCurso) {
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

        // Ordena a coleção por número do docente e código da uc
        return $atribuicoes->sortBy(function ($item) {
            return $item->num_func . "_" . $item->cod_uc;
        });
    }

    private function getDadosImport()
    {
        $filename = KeyValue::val('last_import:filename');
        if ($filename == null) return null;

        $uploader = KeyValue::val('last_import:uploader');
        $timestamp = KeyValue::val('last_import:timestamp');
        $lineErrors = KeyValue::val('last_import:line_errors');

        $importDados = new \stdClass();
        $importDados->filename = $filename;
        $importDados->uploader = $uploader;
        $importDados->timestamp = $timestamp;
        $importDados->lineErrors = $lineErrors;
        return $importDados;
    }

    public function index()
    {
        // Obtém todos os docentes e unidades curriculares (para os combos)
        $funcionarios = Docente::select('num_func', 'nome_docente')->get();
        $ucs = UnidadeCurricular::select('cod_uc', 'nome_uc')->get();

        // Cria uma coleção com os dados necessários para a tabela
        $dados = $this->getAtribuicoes();

        // Obtém os dados sobre o último ficheiro importado
        $dadosImportacao = $this->getDadosImport();

        return view('atribuicaoUcs', compact('funcionarios', 'ucs', 'dados', 'dadosImportacao'));
    }

    public function store(Request $request)
    {
        // Valida os dados do formulário
        $request->validate([
            'num_func' => 'required|numeric',
            'cod_uc' => 'required|numeric',
            'perc_horas' => 'required|numeric',
        ]);

        // Obtém os dados do formulário
        $num_func = $request->input('num_func');
        $cod_uc = $request->input('cod_uc');
        $perc_horas = $request->input('perc_horas');

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
            'perc_horas' => 'required|numeric',
        ]);

        // Obtém os dados do formulário
        $perc_horas = $request->input('perc_horas');

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


    public function destroyAll()
    {
        // For each UnidadeCurricular:
        // detach all docentes
        UnidadeCurricular::all()->each(function ($uc) {
            $uc->docentes()->detach();
        });
    }
}
