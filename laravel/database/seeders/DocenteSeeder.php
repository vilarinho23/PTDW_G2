<?php

namespace Database\Seeders;

use App\Models\Docente;
use Illuminate\Database\Seeder;

class DocenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Criar docentes se não existirem
        $modelsMade = Docente::factory(5)->make();

        foreach ($modelsMade as $model) Docente::firstOrCreate($model->toArray());
    }
}
