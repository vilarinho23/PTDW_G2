<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RestricaoHorario;
use App\Models\UnidadeCurricular;

class Docente extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'docente';


    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'num_func';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;


    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'num_func',
        'nome_docente',
        'acn_docente',
        'data_submissao',
        'observacoes'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'data_submissao' => 'datetime'
    ];



    /**
     * Get the RestricaoHorario's for the Docente.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function restricoes()
    {
        return $this->hasMany(
            RestricaoHorario::class,

            'num_func'
        );
    }

    /**
     * Get the UnidadeCurricular's for the Docente (Responsavel).
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function respUnidadesCurriculares()
    {
        return $this->hasMany(
            UnidadeCurricular::class,

            'num_func_resp'
        );
    }

    /**
     * Get the UnidadeCurricular's for the Docente.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function unidadesCurriculares()
    {
        return $this->belongsToMany(
            UnidadeCurricular::class,
            'docente_uc',

            'num_func',
            'cod_uc'
        )->withTimestamps()->withPivot('perc_horas');
    }
}
