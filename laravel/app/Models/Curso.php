<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UnidadeCurricular;

class Curso extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'curso';


    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'nome_curso';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

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
        'nome_curso'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];



    /**
     * Get the UnidadeCurricular's for the Curso.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function unidadesCurriculares()
    {
        return $this->belongsToMany(
            UnidadeCurricular::class,
            'curso_uc',

            'nome_curso',
            'cod_uc'
        )->withTimestamps();
    }
}
