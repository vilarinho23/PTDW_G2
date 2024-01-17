<?php

namespace App\Models\Enums;

enum UtilizacaoLaboratorios: string
{
    case obrigatorio = 'obrigatório';
    case preferencial = 'preferencial';
}
