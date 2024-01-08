<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CursoSeeder::class);
        $this->call(LaboratorioSeeder::class);

        $this->call(DocenteSeeder::class);
        $this->call(RestricoesSeeder::class);
        $this->call(UCSeeder::class);

        $this->call(DocenteTesteSeeder::class);
        $this->call(KeyValueSeeder::class);

        $this->call(UserSeeder::class);
        $this->call(UserTesteSeeder::class);
    }
}
