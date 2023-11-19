<?php

namespace App\Models\Enums;

enum ParteDia: string
{
    case manha = 'manha';
    case tarde = 'tarde';
    case noite = 'noite';
}
