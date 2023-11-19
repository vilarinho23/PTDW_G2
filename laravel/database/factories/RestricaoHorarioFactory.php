<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Docente;
use App\Models\Enums\DiaSemana;
use App\Models\Enums\ParteDia;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RestricaoHorario>
 */
class RestricaoHorarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'num_func' => Docente::factory(),
            'dia_semana' => $this->faker->randomElement(DiaSemana::cases()),
            'parte_dia' => $this->faker->randomElement(ParteDia::cases()),
        ];
    }
}
