<?php

namespace Database\Seeders;

use App\Models\Docente;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obter docentes
        $docentes = Docente::all();

        // Criar docentes se não existirem
        if ($docentes->isEmpty())
        {
            $this->call(DocenteSeeder::class);
            $docentes = Docente::all();
        }

        // Criar utilizadores se não existirem e associar a docentes
        foreach ($docentes as $docente)
        {
            // email = d<num_func>@ua.pt
            $email = "d{$docente->num_func}@ua.pt";

            // Criar utilizador se não existir (ou obtem o utilizador existente)
            $user = User::firstOrCreate(
                [ 'email' => $email ],
                [
                    'name' => $docente->nome_docente,
                    'password' => bcrypt("password"),
                    'email_verified_at' => now()
                ]
            );

            // Se o utilizador estiver associado a um docente, desassociar
            $user->docente()->dissociate();

            // Associar o utilizador ao docente
            $user->docente()->associate($docente);

            // Definir o utilizador como membro da comissão, aleatoriamente
            $user->comissao = fake()->boolean();

            // Guardar alterações
            $user->save();
        }
    }
}
