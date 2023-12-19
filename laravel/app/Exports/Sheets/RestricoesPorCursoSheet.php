<?php

namespace App\Exports\Sheets;

use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;

class RestricoesPorCursoSheet implements FromArray, WithTitle
{
    private $docentes;
    public function __construct(Collection $docentes)
    {
        $this->docentes = $docentes;
    }

    public function title(): string
    {
        return 'porCurso';
    }


    public function array(): array
    {
        // n.º Func | nome docente | cód   | ACN | R | nome UC         | curso | h | n.º | subT
        // 7892     | Exemplo nome | 11000 | I   | X | Exemplo nome UC | TI    | 4 | 1   | 4
        $atrib = [
            // Header row
            ['n.º Func', 'nome docente', 'cód', 'ACN', 'R', 'nome UC', 'curso', 'h', 'n.º', 'subT']
        ];

        // TODO RestricoesPorCursoSheet content

        return $atrib;
    }
}
