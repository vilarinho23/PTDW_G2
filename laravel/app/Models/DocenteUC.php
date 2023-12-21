<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocenteUC extends Model
{
    use HasFactory;
    protected $table = 'docente_uc';

    protected $fillable = ['num_func', 'cod_uc', 'perc_horas'];
    protected $primaryKey = ['num_func', 'cod_uc'];


    
    public function docente()
    {
        return $this->belongsTo(Docente::class, 'num_func', 'num_func');
    }

    
    public function unidadeCurricular()
    {
        return $this->belongsTo(UnidadeCurricular::class, 'cod_uc', 'cod_uc');
    }
}
