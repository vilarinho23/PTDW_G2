<?php

namespace App\Models\Enums;

enum SalaAvaliacoes: string
{
    case sala_aula = 'sala de aula';
    case laboratorio = 'laboratório';
    case ambos = 'ambos';
}
