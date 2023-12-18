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
            'data_submissao' => $this->faker->dateTime(),
            'observacoes' => $this->faker->text(),
            'email_docente' => $this->faker->unique()->safeEmail(),
            'telef_docente' => $this->faker->numerify('#########'),
        ];
    }
}
