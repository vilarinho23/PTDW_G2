<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Curso;
use App\Models\Laboratorio;
use App\Models\Docente;
use App\Models\Enums\SalaAvaliacoes;
use App\Models\Enums\UtilizacaoLaboratorios;

class UnidadeCurricular extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'unidade_curricular';


    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'cod_uc';

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
        'cod_uc',
        'nome_uc',
        'acron_uc',
        'horas_uc',
        'acn_uc',
        'semestre_uc',
        'num_func_resp',
        'sala_avaliacoes',
        'utilizacao_laboratorios',
        'software_necessario'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'horas_uc' => 'integer',
        'semestre_uc' => 'integer',
        'num_func_resp' => 'integer',
        'sala_avaliacoes' => SalaAvaliacoes::class,
        'utilizacao_laboratorios' => UtilizacaoLaboratorios::class
    ];



    /**
     * Get the Curso's for the UnidadeCurricular.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function cursos()
    {
        return $this->belongsToMany(
            Curso::class,
            'curso_uc',

            'cod_uc',
            'acron_curso'
        )->withTimestamps();
    }

    /**
     * Get the Laboratorio's for the UnidadeCurricular.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function laboratorios()
    {
        return $this->belongsToMany(
            Laboratorio::class,
            'laboratorio_uc',

            'cod_uc',
            'designacao_lab'
        )->withTimestamps();
    }

    /**
     * Get the Docente (Responsavel) that has the UnidadeCurricular.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function responsavel()
    {
        return $this->belongsTo(
            Docente::class,

            'num_func_resp'
        );
    }

    /**
     * Get the Docente's for the UnidadeCurricular.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function docentes()
    {
        return $this->belongsToMany(
            Docente::class,
            'docente_uc',

            'cod_uc',
            'num_func'
        )->withTimestamps()->withPivot('perc_horas');
    }
}
