<?php

namespace App\Http\Requests;

use App\AppUtilities;
use App\Models\Enums\DiaSemana;
use App\Models\Enums\ParteDia;
use App\Models\Enums\SalaAvaliacoes;
use App\Models\Enums\UtilizacaoLaboratorios;
use App\Models\Laboratorio;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RestricoesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // O docente tem de estar autenticado para aceder a esta página
        $docente = AppUtilities::getDocente();
        if ($docente == null) return false;

        // A data de submissão tem de estar definida (não importa o valor)
        $dataSubmissao = AppUtilities::getDataConclusao();
        if ($dataSubmissao == null) return false;

        return true;
    }


    private function getUCs()
    {
        $ucRegex = '/^uc(\d+)_(.*)$/';
        $ucs = [];

        foreach ($this->all() as $key => $value)
        {
            $res = preg_match($ucRegex, $key, $matches);
            if (!$res) continue;

            $codUC = $matches[1];
            $field = $matches[2];
            if ($value == 'null') $value = null;

            if (!isset($ucs[$codUC])) $ucs[$codUC] = [];
            $ucs[$codUC][$field] = $value;
        }

        $this->merge(['ucs' => $ucs]);
    }

    private function getImpedimentos()
    {
        $impRegex = '/^([\wãáàâéêíóôõúç]+)_([\wãáàâéêíóôõúç]+)$/';
        $impedimentos = [];

        foreach ($this->input('impedimentos', []) as $imp)
        {
            $res = preg_match($impRegex, $imp, $matches);
            if (!$res) continue;

            $impedimentos[] = [
                'dia' => $matches[1],
                'parte' => $matches[2]
            ];
        }
        // $impedimentos = array_unique($impedimentos, SORT_REGULAR);

        $this->merge(['impedimentos' => $impedimentos]);
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        $this->getUCs();
        $this->getImpedimentos();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $utilizacaoLabs = UtilizacaoLaboratorios::cases();
        $salasAvaliacoes = SalaAvaliacoes::cases();
        $diaSemana = DiaSemana::cases();
        $parteDia = ParteDia::cases();

        return [
            'ucs' => 'nullable|array',
            'ucs.*.utilizacao_laboratorios' => [
                'nullable',
                Rule::in($utilizacaoLabs)
            ],
            'ucs.*.laboratorios' => 'array|required_with:ucs.*.utilizacao_laboratorios',
            'ucs.*.laboratorios.*' => [
                'required',
                'string',
                Rule::exists(Laboratorio::class, 'designacao_lab')
            ],
            'ucs.*.sala_avaliacoes' => [
                'required',
                Rule::in($salasAvaliacoes)
            ],
            'ucs.*.software_necessario' => 'nullable|string',

            'impedimentos' => 'nullable|array',
            'impedimentos.*.dia' => [
                'required',
                Rule::in($diaSemana)
            ],
            'impedimentos.*.parte' => [
                'required',
                Rule::in($parteDia)
            ]
        ];
    }


    protected function withValidator($validator)
    {
        // Verificar se o docente é responsável por todas as UCs
        $validator->after(function ($validator) {
            $ucs = $this->input('ucs', []);
            $docente = AppUtilities::getDocente();

            $ucsSubmetidas = array_keys($ucs);
            $ucsDocente = $docente->respUnidadesCurriculares->pluck('cod_uc')->toArray();

            // Verificar se foram submetidas apenas UCs para as quais o docente é responsável
            $diff = array_diff($ucsSubmetidas, $ucsDocente);
            if (!empty($diff)) $validator->errors()->add('ucs', 'O docente não é responsável por todas as UCs submetidas');

            // Verificar se foram submetidas TODAS as UCs pelas quais o docente é responsável
            $diff = array_diff($ucsDocente, $ucsSubmetidas);
            if (!empty($diff)) $validator->errors()->add('ucs', 'O docente não submeteu todas as UCs pelas quais é responsável');
        });
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'ucs.*.utilizacao_laboratorios.in' => 'A utilização de laboratórios da UC :index é inválida',
            'ucs.*.laboratorios.required_with' => 'É necessário selecionar pelo menos um laboratório para a UC :index',
            'ucs.*.laboratorios.*.exists' => 'Um dos laboratórios selecionados para a UC :index não existe (:attribute)',
            'ucs.*.sala_avaliacoes.required' => 'É necessário selecionar uma sala de avaliações para a UC :index',

            'impedimentos.*.dia.required' => 'É necessário selecionar um dia da semana para cada impedimento',
            'impedimentos.*.parte.required' => 'É necessário selecionar uma parte do dia para cada impedimento'
        ];
    }
}
