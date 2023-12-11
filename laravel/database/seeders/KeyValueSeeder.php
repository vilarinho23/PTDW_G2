<?php

namespace Database\Seeders;

use App\Models\KeyValue;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class KeyValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataConclusao = Carbon::now()->addDays(10)->format('d/m/Y');
        $semestre = null;

        KeyValue::set('data_conclusao', $dataConclusao);
        KeyValue::set('semestre', $semestre);
    }
}
