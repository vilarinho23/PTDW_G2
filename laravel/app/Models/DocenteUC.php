<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocenteUC extends Model
{
    use HasFactory;
    protected $table = 'docente_uc'; // nome da tabela no banco de dados

    // Campos que podem ser preenchidos em massa
    protected $fillable = ['num_func', 'cod_uc', 'perc_horas'];

    // Relação com a tabela docente
    public function docente()
    {
        return $this->belongsTo(Docente::class, 'num_func', 'num_func');
    }

    // Relação com a tabela unidade_curricular
    public function unidadeCurricular()
    {
        return $this->belongsTo(UnidadeCurricular::class, 'cod_uc', 'cod_uc');
    }
}
