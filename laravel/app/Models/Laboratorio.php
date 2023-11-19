<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UnidadeCurricular;

class Laboratorio extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'laboratorio';


    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'designacao_lab';

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
        'designacao_lab'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];



    /**
     * Get the UnidadeCurricular's for the Laboratorio.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function unidadesCurriculares()
    {
        return $this->belongsToMany(
            UnidadeCurricular::class,
            'laboratorio_uc',

            'designacao_lab',
            'cod_uc'
        )->withTimestamps();
    }
}
