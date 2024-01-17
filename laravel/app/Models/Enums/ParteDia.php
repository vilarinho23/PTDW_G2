<?php

namespace App\Models\Enums;

enum ParteDia: string
{
    case manha = 'manhã';
    case tarde = 'tarde';
    case noite = 'noite';
}
