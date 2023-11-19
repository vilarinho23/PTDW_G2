<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\CursoSeeder;
use Database\Seeders\LaboratorioSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CursoSeeder::class);
        $this->call(LaboratorioSeeder::class);
    }
}
