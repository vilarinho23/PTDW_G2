<?php

namespace App\Imports;

use App\AppUtilities;
use App\Models\Docente;
use App\Models\UnidadeCurricular;
use Illuminate\Contracts\Support\MessageBag;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DSDImport implements ToCollection, WithHeadingRow
{
    private static function clearData()
    {
        // For each Docente:
        // delete all RestricaoHorario
        // detach all UnidadeCurricular
        // set data_submissao and observacoes to null
        Docente::all()->each(function ($docente) {
            $docente->restricoes()->delete();
            $docente->unidadesCurriculares()->detach();

            $docente->data_submissao = null;
            $docente->observacoes = null;

            $docente->save();
        });

        // For each UnidadeCurricular:
        // detach all docentes (done by last step)
        // detach all Laboratorio
        // detach all Curso
        // set sala_avaliacoes, utilizacao_laboratorios and software_necessario to null
        UnidadeCurricular::all()->each(function ($uc) {
            $uc->laboratorios()->detach();
            $uc->cursos()->detach();

            $uc->sala_avaliacoes = null;
            $uc->utilizacao_laboratorios = null;
            $uc->software_necessario = null;

            $uc->save();
        });
    }


    private static function docente($row)
    {
        // Get data from row (or other sources)
        $num_func = intval($row['n.º Func']);
        $nome_docente = $row['nome'];
        $acn_docente = $row['ACN Doc'];


        // Create Docente if not exists
        $docente = Docente::firstOrNew([
            'num_func' => $num_func,
        ]);

        // Set Docente data
        $docente->nome_docente = $nome_docente;
        $docente->acn_docente = $acn_docente;
        $docente->save();

        return $docente;
    }

    private static function unidadeCurricular($row, $docente)
    {
        // Get data from row (or other sources)
        $cod_uc = intval($row['cód UC']);
        $horas_uc = intval($row['Horas']);
        $nome_uc = $row['nome UC'];
        $acn_uc = $row['ACN UC'];
        $semestre_uc = AppUtilities::getSemestreAtual();
        $num_func_resp = $docente->num_func;
        $cursos = explode(',', $row['curso']);


        // Create UnidadeCurricular if not exists
        $uc = UnidadeCurricular::firstOrNew([
            'cod_uc' => $cod_uc,
        ]);

        // Set UnidadeCurricular data
        $uc->horas_uc = $horas_uc;
        $uc->nome_uc = $nome_uc;
        $uc->acn_uc = $acn_uc;
        $uc->semestre_uc = $semestre_uc;

        // Check if is a new UC and Set resp to Docente (cannot be null)
        if (!$uc->exists) $uc->num_func_resp = $num_func_resp;

        $uc->save();

        // Attach Cursos to UnidadeCurricular
        foreach ($cursos as $curso)
        {
            $cursoOnUC = $uc->cursos->contains($curso);
            if ($cursoOnUC) continue;

            $uc->cursos()->attach($curso);
        }
        $uc->save();

        return $uc;
    }


    private $importErrors = [];

    private function addErrors(MessageBag $errors, int $rowNumber)
    {
        $this->importErrors[$rowNumber] = $errors;
    }

    public function getErrors(): array
    {
        return $this->importErrors;
    }


    /**
     * Collection: https://docs.laravel-excel.com/3.1/imports/collection.html
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        // Clear data before importing
        self::clearData();

        $rowNr = 0;
        foreach ($collection as $row)
        {
            // n.º Func | nome           | ACN Doc | cód UC | ACN UC | Responsavel | nome UC   | curso | Horas | Perc
            // 0000     | Nome Docente 1 | I       | 1111   | I      | X           | nome UC 1 | TI    | h1    | p1

            // Validate row
            $rowNr++;
            $valid = $this->validateRow($row, $rowNr);
            if (!$valid) continue;

            // Get data from row (or other sources)
            $isResponsavel = $row['Responsavel'] == 'X';
            $perc_horas = floatval($row['Perc']) * 100;

            // Docente and UnidadeCurricular
            $docente = self::docente($row);
            $uc = self::unidadeCurricular($row, $docente);

            // Check if Docente is Responsavel
            if ($isResponsavel) $docente->respUnidadesCurriculares()->save($uc);

            // Attach Docente to UnidadeCurricular
            $docente->unidadesCurriculares()->attach(
                $uc->cod_uc,
                ['perc_horas' => $perc_horas]
            );
        }
    }


    private function validateRow($row, int $rowNumber): bool
    {
        // n.º Func -> nFunc
        $row['nFunc'] = $row['n.º Func'];

        // Create validator
        $validator = validator(
            $row->toArray(),
            $this->rules(),
            $this->customValidationMessages()
        );

        // Check if validator fails
        if ($validator->fails())
        {
            // Add errors to importErrors
            $this->addErrors($validator->errors(), $rowNumber);
            return false;
        }

        return true;
    }

    private function rules(): array
    {
        return [
            'nFunc' => 'required|integer',
            'nome' => 'required|string',
            'ACN Doc' => 'required|string',
            'cód UC' => 'required|integer',
            'ACN UC' => 'required|string',
            'Responsavel' => Rule::in(['X', '']),
            'nome UC' => 'required|string',
            'curso' => 'required|string',
            'Horas' => 'required|integer',
            'Perc' => 'required|numeric',
        ];
    }

    private function customValidationMessages()
    {
        return [
            'nFunc.required' => 'O número de funcionário é obrigatório',
            'nFunc.integer' => 'O número de funcionário tem de ser um número inteiro',
            'nome.required' => 'O nome do docente é obrigatório',
            'nome.string' => 'O nome do docente tem de ser uma string',
            'ACN Doc.required' => 'O ACN do docente é obrigatório',
            'ACN Doc.string' => 'O ACN do docente tem de ser uma string',
            'cód UC.required' => 'O código da UC é obrigatório',
            'cód UC.integer' => 'O código da UC tem de ser um número inteiro',
            'ACN UC.required' => 'O ACN da UC é obrigatório',
            'ACN UC.string' => 'O ACN da UC tem de ser uma string',
            'Responsavel.in' => 'O campo Responsável tem de ser X ou vazio',
            'nome UC.required' => 'O nome da UC é obrigatório',
            'nome UC.string' => 'O nome da UC tem de ser uma string',
            'curso.required' => 'Os cursos são obrigatórios',
            'curso.string' => 'Os cursos têm de ser uma string',
            'Horas.required' => 'As horas da UC são obrigatórias',
            'Horas.integer' => 'As horas da UC têm de ser um número inteiro',
            'Perc.required' => 'A percentagem de horas é obrigatória',
            'Perc.numeric' => 'A percentagem de horas tem de ser um número',
        ];
    }
}
