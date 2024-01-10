<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTesteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Criar comissão user se não existir
        User::firstOrCreate(
            [ 'email' => 'teste@ua.pt' ],
            [
                'name' => 'Teste Comissão',
                'password' => bcrypt("password"),
                'email_verified_at' => now(),
                'comissao' => true
            ]
        );

        // Criar dummy user se não existir
        User::firstOrCreate(
            [ 'email' => 'dummy@ua.pt' ],
            [
                'name' => 'Dummy User',
                'password' => bcrypt("password"),
                'email_verified_at' => now(),
                'comissao' => false
            ]
        );
    }
}
