<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Docente>
 */
class DocenteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'num_func' => $this->faker->unique()->numberBetween(1, 999999),
            'nome_docente' => $this->faker->unique()->name(),
            'acn_docente' => $this->faker->word(),
            'submetido' => $this->faker->boolean(),
            'observacoes' => $this->faker->text(),
        ];
    }
}
