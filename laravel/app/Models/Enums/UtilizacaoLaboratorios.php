<?php

namespace App\Models\Enums;

enum UtilizacaoLaboratorios: string
{
    case obrigatorio = 'obrigatorio';
    case preferencial = 'preferencial';
}
