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
        try{
            // Valida os dados do formulário
            $request->validate([
                'num_func' => 'required|integer|exists:docente,num_func',
                'cod_uc' => 'required|integer|exists:unidade_curricular,cod_uc',
                'perc_horas' => 'required|numeric|min:0',
            ],[
                'num_func.required' => 'A escolha de um docente é obrigatória',
                'num_func.integer' => 'O número do docente deve ser um número inteiro',
                'num_func.exists' => 'O docente não existe',
                'cod_uc.required' => 'A escolha de uma UC é obrigatória',
                'cod_uc.integer' => 'O código da UC deve ser um número inteiro',
                'cod_uc.exists' => 'A UC não existe',
                'perc_horas.required' => 'O campo percentual de horas é obrigatório',
                'perc_horas.numeric' => 'O campo percentual apenas aceita números',
                'perc_horas.min' => 'O campo percentual deve ser um número positivo ou zero'
            ]);

            // Obtém os dados do formulário
            $num_func = $request->input('num_func');
            $cod_uc = $request->input('cod_uc');
            $perc_horas = $request->input('perc_horas');

            // Obtém o docente e a unidade curricular
            $docente = Docente::find($num_func);
            $uc = UnidadeCurricular::find($cod_uc);

            // Verifica se o docente e a unidade curricular existem
            if ($docente == null || $uc == null) {
                return response()->json(['error' => 'Erro ao criar registo. Docente ou UC não encontrados']);
            }

            $atribuicaoExistente = $docente->unidadesCurriculares()->where('docente_uc.cod_uc', $cod_uc)->exists();

            if ($atribuicaoExistente) {
                return response()->json(['error' => 'Já existe uma atribuição para este docente e UC']);
            }

            // Cria a atribuição (se já existir, atualiza)
            $docente->unidadesCurriculares()->syncWithoutDetaching([$cod_uc => ['perc_horas' => $perc_horas]]);
            return response()->json(['message' => 'Registo criado com sucesso'],201);
        } catch (\Exception $e) {
            // Captura a exceção e retorna um JSON com detalhes do erro
            return response()->json(['error' => $e->getMessage()],500);
        }
    }

    public function update(Request $request, $num_func, $cod_uc)
    {
        try{
            // Valida os dados do formulário
            $request->validate([
                'perc_horas' => 'required|numeric|min:0',
            ],[
                'perc_horas.required' => 'O campo percentual de horas é obrigatório',
                'perc_horas.numeric' => 'O campo percentual apenas aceita números',
                'perc_horas.min' => 'O campo percentual deve ser um número positivo ou zero'
            ]);

            // Obtém os dados do formulário
            $perc_horas = $request->input('perc_horas');

            // Obtém o docente e a unidade curricular
            $docente = Docente::find($num_func);
            $uc = UnidadeCurricular::find($cod_uc);

            // Verifica se o docente e a unidade curricular existem
            if ($docente == null || $uc == null) {
                return response()->json(['error'=> 'Erro ao atualizar registro. Docente ou UC não encontrados.']);
            }

            // Atualiza a atribuição (se não existir, cria)
            $docente->unidadesCurriculares()->syncWithoutDetaching([$cod_uc => ['perc_horas' => $perc_horas]]);
            return response()->json(['message'=> 'Atribuição atualizada com sucesso'],201);
        }catch(\Exception $e){
            // Captura a exceção e retorna um JSON com detalhes do erro
            return response()->json(['error' => $e->getMessage()],500);
        }
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
