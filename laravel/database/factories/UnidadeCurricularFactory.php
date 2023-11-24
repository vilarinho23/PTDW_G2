<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Docente;
use App\Models\Enums\SalaAvaliacoes;
use App\Models\Enums\UtilizacaoLaboratorios;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UnidadeCurricular>
 */
class UnidadeCurricularFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cod_uc' => $this->faker->unique()->numberBetween(1, 999999),
            'nome_uc' => $this->faker->unique()->word(),
            'horas_uc' => $this->faker->numberBetween(1, 10),
            'acn_uc' => $this->faker->word(),
            'num_func_resp' => Docente::factory(),
            'sala_avaliacoes' => $this->faker->randomElement(SalaAvaliacoes::cases()),
            'utilizacao_laboratorios' => $this->faker->randomElement(UtilizacaoLaboratorios::cases()),
            'software_necessario' => $this->faker->text(100)
        ];
    }
}
