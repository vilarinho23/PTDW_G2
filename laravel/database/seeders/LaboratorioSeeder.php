<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Laboratorio;

class LaboratorioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $designacoes_laboratorios = [
            'qualquer lab. de informática',
            '05.01.10',
            '05.01.11',
            '05.01.12',
            '05.01.27',
            '05.01.28',
            '05.01.29'
        ];


        foreach ($designacoes_laboratorios as $dl)
        {
            Laboratorio::firstOrCreate([
                'designacao_lab' => $dl,
            ]);
        }
    }
}
